<?php

namespace Tests\Feature;

use App\Mail\ContactRequestReceived;
use App\Providers\AppServiceProvider;
use Illuminate\Cache\FileStore;
use Illuminate\Cache\RateLimiter;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Session\EncryptedStore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('contact.recipient.address', 'owner@example.com');
        config()->set('contact.recipient.name', 'Portfolio Owner');
        config()->set('mail.from.address', 'sender@example.com');
        config()->set('mail.from.name', 'Portfolio Website');

        $this->withServerVariables([
            'REMOTE_ADDR' => sprintf(
                '2001:db8:%x:%x:%x:%x::1',
                random_int(0, 65535),
                random_int(0, 65535),
                random_int(0, 65535),
                random_int(0, 65535),
            ),
        ]);
    }

    public function test_valid_request_sends_an_email_with_the_visitor_as_reply_to(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.store'), $this->validPayload());

        $response
            ->assertRedirect(route('home').'#contact')
            ->assertSessionHas('contact_success');

        Mail::assertSent(ContactRequestReceived::class, function (ContactRequestReceived $mail): bool {
            return $mail->hasTo('owner@example.com')
                && $mail->hasFrom('sender@example.com', 'Portfolio Website')
                && $mail->hasReplyTo('visitor@example.com', 'Marie Martin')
                && ! $mail->hasFrom('visitor@example.com');
        });
    }

    public function test_invalid_fields_are_rejected_strictly(): void
    {
        Mail::fake();

        $payload = $this->validPayload([
            'name' => 'M',
            'email' => 'not-an-email',
            'organization' => str_repeat('a', 151),
            'category' => 'not-allowed',
            'message' => 'Too short',
        ]);

        $this->from(route('home'))->post(route('contact.store'), $payload)
            ->assertRedirect(route('home'))
            ->assertSessionHasErrors(['name', 'email', 'organization', 'category', 'message'], null, 'contact');

        Mail::assertNothingSent();
    }

    public function test_consent_is_required(): void
    {
        Mail::fake();

        $payload = $this->validPayload();
        unset($payload['consent']);

        $this->from(route('home'))->post(route('contact.store'), $payload)
            ->assertSessionHasErrors(['consent'], null, 'contact');

        Mail::assertNothingSent();
    }

    public function test_filled_honeypot_is_rejected(): void
    {
        Mail::fake();

        $this->from(route('home'))->post(route('contact.store'), $this->validPayload([
            'website' => 'https://spam.example',
        ]))
            ->assertSessionHasErrors(['website'], null, 'contact')
            ->assertSessionMissing('_old_input.website');

        Mail::assertNothingSent();
    }

    public function test_honeypot_only_error_has_visible_generic_feedback_without_an_empty_list(): void
    {
        Mail::fake();

        $response = $this->followingRedirects()
            ->from(route('home'))
            ->post(route('contact.store'), $this->validPayload([
                'website' => 'https://spam.example',
            ]));

        $response
            ->assertOk()
            ->assertSee('Vérifiez les informations du formulaire.')
            ->assertSee('La demande n’a pas pu être envoyée. Vérifiez le formulaire et réessayez.')
            ->assertSee('data-contact-hidden-error', false)
            ->assertDontSee('data-contact-error-list', false)
            ->assertDontSee('href="#website"', false)
            ->assertDontSee('https://spam.example')
            ->assertSee('id="website" type="text" name="website" value=""', false);

        Mail::assertNothingSent();
    }

    public function test_contact_requests_are_rate_limited(): void
    {
        Mail::fake();

        foreach (range(1, 5) as $attempt) {
            $this->post(route('contact.store'), $this->validPayload())
                ->assertSessionHas('contact_success');
        }

        $this->post(route('contact.store'), $this->validPayload())
            ->assertRedirect(route('home').'#contact')
            ->assertSessionHas('contact_error', 'Trop de tentatives ont été effectuées. Veuillez réessayer plus tard.');

        Mail::assertSentCount(5);
    }

    public function test_rate_limiter_uses_its_dedicated_file_store_by_default(): void
    {
        $this->assertSame('file', config('cache.limiter'));
        $this->assertInstanceOf(
            FileStore::class,
            app('cache')->store(config('cache.limiter'))->getStore(),
        );
    }

    public function test_request_does_not_write_to_the_database(): void
    {
        Mail::fake();
        $this->configureDatabaseFreeContactState();
        $mutatingQueries = [];

        DB::listen(function (QueryExecuted $query) use (&$mutatingQueries): void {
            if (preg_match('/^\s*(insert|update|delete)\b/i', $query->sql)) {
                $mutatingQueries[] = $query->sql;
            }
        });

        $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.10'])
            ->post(route('contact.store'), $this->validPayload())
            ->assertSessionHas('contact_success');

        $this->assertSame([], $mutatingQueries);
    }

    public function test_validation_error_uses_encrypted_file_state_without_database_writes(): void
    {
        Mail::fake();
        $this->configureDatabaseFreeContactState();
        $mutatingQueries = [];

        $this->assertSame('file', config('session.driver'));
        $this->assertTrue(config('session.encrypt'));
        $this->assertInstanceOf(EncryptedStore::class, app('session')->driver());
        $this->assertSame('file', config('cache.limiter'));
        $this->assertInstanceOf(
            FileStore::class,
            app('cache')->store(config('cache.limiter'))->getStore(),
        );

        DB::listen(function (QueryExecuted $query) use (&$mutatingQueries): void {
            if (preg_match('/^\s*(insert|update|delete)\b/i', $query->sql)) {
                $mutatingQueries[] = $query->sql;
            }
        });

        $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.11'])
            ->from(route('home'))
            ->post(route('contact.store'), $this->validPayload(['email' => 'invalid']))
            ->assertSessionHasErrors(['email'], null, 'contact')
            ->assertSessionHasInput('name', 'Marie Martin');

        $this->assertSame([], $mutatingQueries);
        Mail::assertNothingSent();
    }

    public function test_success_state_is_displayed(): void
    {
        Mail::fake();

        $this->followingRedirects()
            ->post(route('contact.store'), $this->validPayload())
            ->assertOk()
            ->assertSee('Votre demande a bien été envoyée. Merci pour votre message.');
    }

    public function test_validation_errors_and_valid_values_are_displayed(): void
    {
        Mail::fake();

        $this->followingRedirects()
            ->from(route('home'))
            ->post(route('contact.store'), $this->validPayload(['email' => 'invalid']))
            ->assertOk()
            ->assertSee('Vérifiez les informations du formulaire.')
            ->assertSee('Indiquez une adresse e-mail valide.')
            ->assertSee('Marie Martin');
    }

    public function test_technical_error_is_generic_and_preserves_useful_input(): void
    {
        Mail::shouldReceive('to')->once()->andThrow(new RuntimeException('Private transport detail'));

        $this->post(route('contact.store'), $this->validPayload())
            ->assertRedirect(route('home').'#contact')
            ->assertSessionHas('contact_error', 'Votre demande n’a pas pu être envoyée pour le moment. Veuillez réessayer.')
            ->assertSessionHasInput('name', 'Marie Martin')
            ->assertSessionMissing('_old_input.consent')
            ->assertSessionMissing('_old_input.website');
    }

    public function test_form_contains_csrf_protection_and_accessible_error_targets(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('name="_token"', false)
            ->assertSee('id="name"', false)
            ->assertSee('id="email"', false)
            ->assertSee('type="submit"', false)
            ->assertDontSee('onsubmit="return false"', false);
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Marie Martin',
            'email' => 'visitor@example.com',
            'organization' => 'Example Organisation',
            'category' => 'automation',
            'message' => 'Je souhaite automatiser un processus métier répétitif.',
            'consent' => '1',
            'website' => '',
        ], $overrides);
    }

    private function configureDatabaseFreeContactState(): void
    {
        config()->set([
            'session.driver' => 'file',
            'session.encrypt' => true,
            'cache.limiter' => 'file',
        ]);

        $this->app->forgetInstance(RateLimiter::class);
        Facade::clearResolvedInstance(RateLimiter::class);
        (new AppServiceProvider($this->app))->boot();
    }
}
