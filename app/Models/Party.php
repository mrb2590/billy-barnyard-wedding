<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Party extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<integer, string>
     */
    protected $fillable = ['name', 'address', 'message_to_party', 'message_from_party', 'notes', 'rsvp_code'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Party $party) {
            if ($party->rsvp_code === null) {
                do {
                    $party->rsvp_code = Party::generateRSVPCode();
                } while (Party::where('rsvp_code', $party->rsvp_code)->exists());
            }
        });
    }

    /**
     * Generate an RSVP code for a guest.
     */
    public static function generateRSVPCode(): string
    {
        return Str::upper(Str::random(6));
    }

    /**
     * Get the guests in this party.
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
