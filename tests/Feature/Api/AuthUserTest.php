<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetching_authenticated_user(): void
    {
        $requestUser = User::factory()->create();

        $response = $this->actingAs($requestUser)->getJson('/api/user');
        $response->assertStatus(200);

        $this->assertEquals($response->json(), [
            'id' => $requestUser->id,
            'first_name' => $requestUser->first_name,
            'last_name' => $requestUser->last_name,
            'name' => $requestUser->name,
            'email' => $requestUser->email,
            'email_verified_at' => $requestUser->email_verified_at->toJson(),
            'created_at' => $requestUser->created_at->toJson(),
            'updated_at' => $requestUser->updated_at->toJson()
        ]);
    }
}
