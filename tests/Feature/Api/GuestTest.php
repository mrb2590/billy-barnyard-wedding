<?php

namespace Tests\Feature\Api;

use App\Models\Guest;
use App\Models\Party;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetching_guests(): void
    {
        $requestUser = User::factory()->create();

        Party::factory()
            ->count(5)
            ->withGuests()
            ->create();

        $response = $this->actingAs($requestUser)->getJson('/api/guests');
        $response->assertStatus(200)->assertJson([
            'data' => [],
            'meta' => [
                'current_page' => 1,
                'total' => Guest::count()
            ]
        ]);
    }

    public function test_fetching_guest(): void
    {
        $requestUser = User::factory()->create();

        $guest = Guest::factory()
            ->for(Party::factory())
            ->create();

        $response = $this->actingAs($requestUser)->getJson('/api/guests/' . $guest->id);
        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => $guest->id
            ]
        ]);
    }

    public function test_creating_guest(): void
    {
        $requestUser = User::factory()->create();
        $party = Party::factory()->create();

        $data = [
            'first_name' => 'Billy',
            'last_name' => 'Bob',
            'email' => 'billy@example.com',
            'is_child' => true,
            'is_guest' => false,
            'has_rehearsal_invite' => false,
            'side' => 'his',
            'relation' => 'self',
            'is_attending' => true,
            'is_attending_rehearsal' => false,
            'message_to_guest' => 'Hey how ya doin.',
            'message_from_guest' => 'Good, thanks.',
            'notes' => 'This guy\'s lame.',
            'party_id' => $party->id
        ];

        $response = $this->actingAs($requestUser)->postJson('/api/guests', $data);
        $response->assertStatus(201)->assertJson([
            'data' => $data
        ]);
    }

    public function test_updating_guest(): void
    {
        $requestUser = User::factory()->create();
        $party = Party::factory()->create();
        $guest = Guest::factory()
            ->for(Party::factory())
            ->create();

        $data = [
            'first_name' => 'Billy',
            'last_name' => 'Bob',
            'email' => 'billy@example.com',
            'is_child' => true,
            'is_guest' => false,
            'has_rehearsal_invite' => false,
            'side' => 'his',
            'relation' => 'self',
            'is_attending' => true,
            'is_attending_rehearsal' => false,
            'message_to_guest' => 'Hey how ya doin.',
            'message_from_guest' => 'Good, thanks.',
            'notes' => 'This guy\'s lame.',
            'party_id' => $party->id
        ];

        $response = $this->actingAs($requestUser)->patchJson('/api/guests/' . $guest->id, $data);
        $response->assertStatus(200)->assertJson([
            'data' => $data
        ]);
    }

    public function test_deleting_guest(): void
    {
        $requestUser = User::factory()->create();

        $guest = Guest::factory()
            ->for(Party::factory())
            ->create();

        $response = $this->actingAs($requestUser)->deleteJson('/api/guests/' . $guest->id);
        $response->assertStatus(204);
    }
}
