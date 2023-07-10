<?php

namespace Tests\Feature;

use Tests\TestCase;

class PlayTest extends TestCase
{
    public function test_play_page_is_displayed(): void
    {
        $response = $this->get('/play');

        $response->assertOk();
    }
}
