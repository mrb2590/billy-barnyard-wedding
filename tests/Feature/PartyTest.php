<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\Party;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartyTest extends TestCase
{
    use RefreshDatabase;

    public function test_party_edit_page_is_displayed(): void
    {
        $party = Party::factory()->create();

        $response = $this->withSession(['party' => $party])->get('/parties/' . $party->id);

        $response->assertOk();
    }

    public function test_party_edit_page_is_forbidden_without_rsvp_session(): void
    {
        $party = Party::factory()->create();

        $response = $this->get('/parties/' . $party->id);

        $response->assertForbidden();
    }

    public function test_editing_party_response(): void
    {
        $time = now();
        $party = Party::factory()
            ->withGuests()
            ->create();
        $guest = $party->guests()->first();

        $body = [
            'rsvp_code' => $party->rsvp_code,
            'guests' => $party
                ->guests()
                ->get()
                ->map(
                    fn(Guest $guest) => [
                        'id' => $guest->id,
                        'is_attending' => true,
                        'is_attending_rehearsal' => false
                    ]
                )
                ->all()
        ];

        $response = $this->withSession(['party' => $party])->patch('/parties/' . $party->id, $body);

        $response->assertSessionHasNoErrors();

        $party->guests()->each(function (Guest $guest) use ($time) {
            $this->assertTrue($guest->is_attending);
            $this->assertFalse($guest->is_attending_rehearsal);
            $this->assertGreaterThanOrEqual($time->timestamp, $guest->updated_at->timestamp);
        });
    }
}
