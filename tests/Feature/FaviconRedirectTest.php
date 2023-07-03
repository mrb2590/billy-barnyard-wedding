<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class FaviconRedirectTest extends TestCase
{
    public function test_favicon_redirects_to_vite_asset(): void
    {
        $response = $this->get('/favicon.ico');

        $response->assertRedirect(Vite::asset('resources/favicon/favicon.ico'));
    }
}
