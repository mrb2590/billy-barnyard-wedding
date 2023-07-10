<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_page_is_displayed(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }
}
