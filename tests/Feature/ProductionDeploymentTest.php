<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductionDeploymentTest extends TestCase
{
    public function test_compiled_frontend_assets_are_shipped_with_the_php_service(): void
    {
        $manifestPath = public_path('build/manifest.json');

        $this->assertFileExists($manifestPath);

        $manifest = json_decode(file_get_contents($manifestPath), true, flags: JSON_THROW_ON_ERROR);

        foreach (['resources/css/app.css', 'resources/js/app.js'] as $entrypoint) {
            $this->assertArrayHasKey($entrypoint, $manifest);
            $this->assertFileExists(public_path('build/'.$manifest[$entrypoint]['file']));
        }
    }

    public function test_health_route_is_available(): void
    {
        $this->get('/health')
            ->assertOk();
    }

    public function test_production_bootstrap_limits_trusted_forwarded_headers(): void
    {
        $source = file_get_contents(base_path('bootstrap/app.php'));

        $this->assertStringContainsString("health: '/health'", $source);
        $this->assertStringContainsString("env('TRUSTED_PROXIES')", $source);
        $this->assertStringContainsString('Request::HEADER_X_FORWARDED_FOR', $source);
        $this->assertStringContainsString('Request::HEADER_X_FORWARDED_PROTO', $source);
        $this->assertStringContainsString('Request::HEADER_X_FORWARDED_PORT', $source);
        $this->assertStringNotContainsString('Request::HEADER_X_FORWARDED_HOST', $source);
    }

    public function test_legal_notice_identifies_the_selected_host(): void
    {
        $this->get(route('legal'))
            ->assertOk()
            ->assertSee('DigitalOcean, LLC')
            ->assertSee('Broomfield, Colorado 80021')
            ->assertSee('https://www.digitalocean.com', false);
    }
}
