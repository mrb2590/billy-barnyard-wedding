<?php

namespace App\Rules;

use App\Models\Guest;
use App\Models\Party;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;

class VerifyRSVPCodeToGuest implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($attribute === 'rsvp_code') {
            $exists = Party::where('rsvp_code', $value)
                ->whereHas('guests', fn(Builder $query) => $query->where('last_name', $this->data['last_name'] ?? null))
                ->exists();
        } else {
            $exists = Guest::where('id', $value)
                ->whereHas('party', fn(Builder $query) => $query->where('rsvp_code', $this->data['rsvp_code'] ?? null))
                ->exists();
        }

        if (!$exists) {
            $fail('The RSVP code and last name do not match.');
        }
    }
}
