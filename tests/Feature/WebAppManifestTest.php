<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class WebAppManifestTest extends TestCase
{
    public function test_web_app_manifest_is_displayed(): void
    {
        $response = $this->get('/site.webmanifest');

        $response->assertOk();
        $response->assertJson([
            'name' => config('app.name'),
            'short_name' => config('app.short_name'),
            'icons' => [
                [
                    'src' => Vite::asset('resources/favicon/android-chrome-192x192.png'),
                    'sizes' => '192x192',
                    'type' => 'image/png'
                ],
                [
                    'src' => Vite::asset('resources/favicon/android-chrome-512x512.png'),
                    'sizes' => '512x512',
                    'type' => 'image/png'
                ]
            ],
            'theme_color' => config('app.theme_color'),
            'background_color' => config('app.theme_color'),
            'display' => 'standalone',
            'start_url' => config('app.url')
        ]);
    }
}
