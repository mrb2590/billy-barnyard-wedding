<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Party;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Party::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'The ' . Str::ucfirst(fake()->lastName()) . ' Family',
            'address' => fake()
                ->unique()
                ->address(),
            'message_to_party' => fake()
                ->optional(weight: 0.2)
                ->paragraphs(nb: 1, asText: true),
            'message_from_party' => null,
            'notes' => fake()
                ->optional(weight: 0.2)
                ->paragraphs(nb: 1, asText: true)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function withGuests(): static
    {
        $hasResponded = fake()->boolean(chanceOfGettingTrue: 50);

        return $this->has(
            Guest::factory()
                ->count(fake()->numberBetween(1, 8))
                ->responded(hasResponded: $hasResponded)
        )->state(
            fn() => $hasResponded
                ? [
                    'message_from_party' => fake()
                        ->optional(weight: 0.4)
                        ->paragraphs(nb: 1, asText: true)
                ]
                : []
        );
    }
}
