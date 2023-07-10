<?php

namespace Tests\Feature;

use App\Models\Party;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RSVPTest extends TestCase
{
    use RefreshDatabase;

    public function test_rsvp_page_is_displayed(): void
    {
        $response = $this->get('/rsvp');

        $response->assertOk();
    }

    public function test_searching_parties(): void
    {
        $party = Party::factory()
            ->withGuests()
            ->create();
        $guest = $party->guests()->first();

        $response = $this->post('/rsvp', [
            'last_name' => $guest->last_name,
            'rsvp_code' => $party->rsvp_code
        ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/parties/' . $party->id);
    }

    public function test_correct_rsvp_code_must_be_provided_to_rsvp(): void
    {
        $party = Party::factory()
            ->withGuests()
            ->create();
        $guest = $party->guests()->first();

        $response = $this->post('/rsvp', [
            'last_name' => $guest->last_name,
            'rsvp_code' => 'WORNG1'
        ]);

        $response->assertSessionHasErrors('rsvp_code');
    }
}
