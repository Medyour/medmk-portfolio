<?php

namespace Tests\Feature;

use Symfony\Component\Yaml\Yaml;
use Tests\TestCase;

class AppSpecTest extends TestCase
{
    /** @return array<string, mixed> */
    private function spec(): array
    {
        return Yaml::parseFile(base_path('.do/app.yaml'));
    }

    public function test_spec_uses_one_fixed_php_service_in_london_without_a_database(): void
    {
        $spec = $this->spec();

        $this->assertSame('medmk-portfolio', $spec['name']);
        $this->assertSame('lon', $spec['region']);
        $this->assertSame(['buildpack-stack=ubuntu-22'], $spec['features']);
        $this->assertSame([
            ['rule' => 'DEPLOYMENT_FAILED'],
            ['rule' => 'DOMAIN_FAILED'],
        ], $spec['alerts']);
        $this->assertCount(1, $spec['services']);
        $this->assertArrayNotHasKey('databases', $spec);
        $this->assertArrayNotHasKey('jobs', $spec);
        $this->assertArrayNotHasKey('workers', $spec);

        $web = $spec['services'][0];
        $this->assertSame('php', $web['environment_slug']);
        $this->assertSame(['repo' => 'Medyour/medmk-portfolio', 'branch' => 'main', 'deploy_on_push' => false], $web['github']);
        $this->assertSame(1, $web['instance_count']);
        $this->assertSame('apps-s-1vcpu-0.5gb', $web['instance_size_slug']);
        $this->assertSame(8080, $web['http_port']);
        $this->assertSame('/health', $web['health_check']['http_path']);
        $this->assertArrayNotHasKey('autoscaling', $web);
    }

    public function test_primary_domain_and_starter_redirect_preserve_the_request_uri(): void
    {
        $spec = $this->spec();

        $this->assertSame([['domain' => 'mkirchel.com', 'type' => 'PRIMARY']], $spec['domains']);
        $this->assertArrayNotHasKey('zone', $spec['domains'][0]);
        $this->assertCount(2, $spec['ingress']['rules']);

        [$redirect, $webRoute] = $spec['ingress']['rules'];
        $this->assertSame([
            'authority' => ['exact' => '${STARTER_DOMAIN}'],
            'path' => ['prefix' => '/'],
        ], $redirect['match']);
        $this->assertSame([
            'authority' => 'mkirchel.com',
            'scheme' => 'https',
            'redirect_code' => 301,
        ], $redirect['redirect']);
        $this->assertArrayNotHasKey('uri', $redirect['redirect']);
        $this->assertSame('mkirchel.com', $webRoute['match']['authority']['exact']);
        $this->assertSame('/', $webRoute['match']['path']['prefix']);
        $this->assertSame('web', $webRoute['component']['name']);
    }

    public function test_runtime_configuration_is_database_free_and_contains_no_secret_value(): void
    {
        $web = $this->spec()['services'][0];
        $variables = array_column($web['envs'], null, 'key');
        $expected = [
            'APP_NAME' => 'Medmk Portfolio',
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'false',
            'APP_URL' => '${APP_URL}',
            'APP_LOCALE' => 'fr',
            'APP_FALLBACK_LOCALE' => 'fr',
            'SESSION_DRIVER' => 'file',
            'SESSION_ENCRYPT' => 'true',
            'SESSION_SECURE_COOKIE' => 'true',
            'SESSION_HTTP_ONLY' => 'true',
            'SESSION_SAME_SITE' => 'lax',
            'CACHE_STORE' => 'file',
            'CACHE_LIMITER_STORE' => 'file',
            'QUEUE_CONNECTION' => 'sync',
            'LOG_CHANNEL' => 'stderr',
            'LOG_LEVEL' => 'warning',
            'MAIL_MAILER' => 'smtp',
            'TRUSTED_PROXIES' => '*',
        ];

        $this->assertSame(array_keys($expected), array_keys($variables));
        foreach ($expected as $key => $value) {
            $this->assertSame($value, $variables[$key]['value']);
            $this->assertSame('GENERAL', $variables[$key]['type']);
        }

        $this->assertSame('RUN_AND_BUILD_TIME', $variables['APP_NAME']['scope']);
        $this->assertSame('RUN_AND_BUILD_TIME', $variables['APP_ENV']['scope']);
        $this->assertSame('RUN_AND_BUILD_TIME', $variables['APP_DEBUG']['scope']);
        foreach (array_diff(array_keys($expected), ['APP_NAME', 'APP_ENV', 'APP_DEBUG']) as $key) {
            $this->assertSame('RUN_TIME', $variables[$key]['scope']);
        }

        $this->assertArrayNotHasKey('APP_KEY', $variables);
        $this->assertArrayNotHasKey('MAIL_PASSWORD', $variables);
        $this->assertArrayNotHasKey('DATABASE_URL', $variables);

        $source = file_get_contents(base_path('.do/app.yaml'));
        $this->assertDoesNotMatchRegularExpression('/\b[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}\b/i', $source);
        $this->assertDoesNotMatchRegularExpression('/(?:postgres(?:ql)?|mysql|mariadb|redis):\/\/[^$\s]+/i', $source);
        $this->assertDoesNotMatchRegularExpression('/(?:dop_v1_[A-Za-z0-9]{40,}|github_pat_[A-Za-z0-9_]{20,}|gh[oprsu]_[A-Za-z0-9]{20,}|-----BEGIN [A-Z ]*PRIVATE KEY-----)/', $source);
    }

    public function test_build_and_run_commands_fail_closed_without_generating_credentials(): void
    {
        $web = $this->spec()['services'][0];
        $script = file_get_contents(base_path('scripts/prepare-production.sh'));

        $this->assertSame('bash scripts/prepare-production.sh', $web['build_command']);
        $this->assertSame('php artisan config:cache && exec heroku-php-apache2 public/', $web['run_command']);
        $this->assertStringContainsString('set -euo pipefail', $script);
        $this->assertStringContainsString('composer audit --locked', $script);
        $this->assertStringContainsString('test -s public/build/manifest.json', $script);
        $this->assertStringContainsString('route:cache', $script);
        $this->assertStringContainsString('event:cache', $script);
        $this->assertStringContainsString('view:cache', $script);
        $this->assertStringNotContainsString('key:generate', $script);
        $this->assertStringNotContainsString('migrate', $script);
        $this->assertStringNotContainsString('config:cache', $script);
    }
}
