<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SeoMetadataTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.url', 'https://portfolio.example.test');
    }

    public static function pageMetadata(): array
    {
        return [
            'home' => [
                'home',
                'Mohamed M’Kirchel — Automatisation, API et données',
                'Développeur senior spécialisé en automatisation de processus, intégration API, bases de données et applications web métier.',
            ],
            'privacy' => [
                'privacy',
                'Confidentialité — Mohamed M’Kirchel',
                'Informations relatives à la confidentialité et au traitement des données de contact.',
            ],
            'legal notice' => [
                'legal',
                'Mentions légales — Mohamed M’Kirchel',
                'Mentions légales du site professionnel de Mohamed M’Kirchel.',
            ],
        ];
    }

    #[DataProvider('pageMetadata')]
    public function test_each_public_page_has_specific_metadata(string $route, string $title, string $description): void
    {
        $canonical = route($route);

        $this->get($canonical)
            ->assertOk()
            ->assertSee("<title>{$title}</title>", false)
            ->assertSee('name="description" content="'.e($description).'"', false)
            ->assertSee('rel="canonical" href="'.$canonical.'"', false)
            ->assertSee('property="og:title" content="'.e($title).'"', false)
            ->assertSee('property="og:description" content="'.e($description).'"', false)
            ->assertSee('property="og:url" content="'.$canonical.'"', false)
            ->assertSee('name="twitter:card" content="summary"', false)
            ->assertDontSee('property="og:image"', false)
            ->assertDontSee('name="twitter:image"', false);
    }

    public function test_home_structured_data_contains_only_validated_public_profile_information(): void
    {
        $response = $this->get(route('home'))->assertOk();

        $response
            ->assertSee('type="application/ld+json"', false)
            ->assertSee('"@type":"Person"', false)
            ->assertSee('"name":"Mohamed M’Kirchel"', false)
            ->assertSee('"jobTitle":"Développeur senior"', false)
            ->assertDontSee('sameAs', false)
            ->assertDontSee('LeadOps', false)
            ->assertDontSee('Medmk Portfolio', false);
    }

    public function test_svg_favicon_is_declared_and_available(): void
    {
        $this->get(route('home'))
            ->assertSee('rel="icon" href="'.asset('favicon.svg').'" type="image/svg+xml"', false);

        $this->assertFileExists(public_path('favicon.svg'));
        $this->assertLessThan(1024, filesize(public_path('favicon.svg')));
    }

    public function test_robots_blocks_indexing_outside_production(): void
    {
        $this->get(route('robots'))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee("User-agent: *\nDisallow: /", false)
            ->assertDontSee('Sitemap:', false);
    }

    public function test_robots_allows_indexing_and_references_sitemap_in_production(): void
    {
        $this->app['env'] = 'production';

        $this->get(route('robots'))
            ->assertOk()
            ->assertSee("User-agent: *\nAllow: /", false)
            ->assertSee('Sitemap: '.route('sitemap'), false);
    }

    public function test_sitemap_contains_only_public_pages(): void
    {
        $response = $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        foreach (['home', 'privacy', 'legal'] as $route) {
            $response->assertSee('<loc>'.route($route).'</loc>', false);
        }

        $response
            ->assertDontSee(route('contact.store'), false)
            ->assertDontSee('/up', false);

        $this->assertSame(3, substr_count($response->getContent(), '<url>'));
    }
}
