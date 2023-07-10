<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Guest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()
                ->optional()
                ->unique()
                ?->safeEmail(),
            'is_child' => fake()->boolean(chanceOfGettingTrue: 5),
            'is_guest' => fake()->boolean(chanceOfGettingTrue: 10),
            'is_attending' => null,
            'is_attending_rehearsal' => null,
            'has_rehearsal_invite' => fake()->boolean(chanceOfGettingTrue: 20),
            'rsvp_responded_at' => null,
            'side' => fake()->randomElement(['his', 'hers', 'both']),
            'relation' => fake()->randomElement(['bother', 'sister', 'mother', 'father', 'in-law', 'cousin', 'friend']),
            'message_to_guest' => fake()
                ->optional(weight: 0.2)
                ->paragraphs(nb: 1, asText: true),
            'message_from_guest' => null,
            'notes' => fake()
                ->optional(weight: 0.2)
                ->paragraphs(nb: 1, asText: true)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function responded($hasResponded = true): static
    {
        return $this->state(
            fn(array $attributes) => $hasResponded
                ? [
                    'is_attending' => fake()->boolean(chanceOfGettingTrue: 75),
                    'is_attending_rehearsal' => $attributes['has_rehearsal_invite']
                        ? fake()->boolean(chanceOfGettingTrue: 20)
                        : null,
                    'rsvp_responded_at' => fake()->dateTime(),
                    'message_from_guest' => fake()
                        ->optional(weight: 0.4)
                        ->paragraphs(nb: 1, asText: true)
                ]
                : []
        );
    }
}
