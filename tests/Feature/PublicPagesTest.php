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
}
