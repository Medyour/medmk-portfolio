<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    public static function publicResources(): array
    {
        return [
            'home' => ['home'],
            'privacy' => ['privacy'],
            'legal notice' => ['legal'],
            'robots' => ['robots'],
            'sitemap' => ['sitemap'],
        ];
    }

    #[DataProvider('publicResources')]
    public function test_public_responses_include_safe_baseline_headers(string $route): void
    {
        $this->get(route($route))
            ->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow, noarchive')
            ->assertHeaderMissing('Strict-Transport-Security')
            ->assertHeaderMissing('Content-Security-Policy');
    }

    #[DataProvider('publicResources')]
    public function test_x_robots_tag_is_absent_in_production(string $route): void
    {
        $this->app['env'] = 'production';

        $this->get(route($route))
            ->assertOk()
            ->assertHeaderMissing('X-Robots-Tag');
    }
}
