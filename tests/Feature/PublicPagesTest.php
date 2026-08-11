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

    public function test_home_excludes_unpublished_work(): void
    {
        $this->get(route('home'))
            ->assertDontSee('LeadOps')
            ->assertDontSee('Medmk Portfolio')
            ->assertDontSee('Réalisations');
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
