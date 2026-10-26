<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public static function publicPages(): array
    {
        return [
            'home' => ['home', 'J’automatise vos processus'],
            'privacy' => ['privacy', 'Politique de confidentialité'],
            'legal notice' => ['legal', 'Mentions légales'],
        ];
    }

    #[DataProvider('publicPages')]
    public function test_public_pages_are_available(string $route, string $content): void
    {
        $this->get(route($route))
            ->assertOk()
            ->assertSee($content);
    }

    public function test_home_publishes_only_validated_public_projects(): void
    {
        $this->get(route('home'))
            ->assertSee('Projets publics')
            ->assertSee('DeskOps')
            ->assertSee('LeadOps')
            ->assertSee('SyncOps')
            ->assertSee('https://deskops.mkirchel.com', false)
            ->assertSee('https://leadops.mkirchel.com', false)
            ->assertSee('https://syncops.mkirchel.com', false)
            ->assertSee('images/projects/deskops.png', false)
            ->assertSee('images/projects/leadops.png', false)
            ->assertSee('images/projects/syncops.png', false)
            ->assertDontSee('Medmk Portfolio')
            ->assertDontSee('projet en préparation');

        $this->assertFileExists(public_path('images/projects/deskops.png'));
        $this->assertFileExists(public_path('images/projects/leadops.png'));
        $this->assertFileExists(public_path('images/projects/syncops.png'));
    }

    public function test_home_has_accessible_landmarks_and_form_associations(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('<header', false)
            ->assertSee('<main id="contenu">', false)
            ->assertSee('<footer', false)
            ->assertSee('href="#contenu"', false)
            ->assertSee('aria-label="Navigation principale"', false)
            ->assertSee('for="name"', false)
            ->assertSee('for="email"', false)
            ->assertSee('for="category"', false)
            ->assertSee('for="message"', false)
            ->assertSee('for="consent"', false);
    }

    public function test_validation_summary_links_to_invalid_fields(): void
    {
        $this->from(route('home'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'invalid',
            'category' => '',
            'message' => '',
        ]);

        $this->get(route('home'))
            ->assertSee('data-contact-error-list', false)
            ->assertSee('href="#name"', false)
            ->assertSee('href="#email"', false)
            ->assertSee('href="#category"', false)
            ->assertSee('href="#message"', false)
            ->assertSee('href="#consent"', false)
            ->assertSee('aria-errormessage="email-error"', false);
    }
}
