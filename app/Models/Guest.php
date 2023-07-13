<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<integer, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'is_child',
        'is_guest',
        'is_attending',
        'is_attending_rehearsal',
        'has_rehearsal_invite',
        'rsvp_responded_at',
        'side',
        'relation',
        'message_to_guest',
        'message_from_guest',
        'notes',
        'party_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_attending' => 'boolean',
        'is_attending_rehearsal' => 'boolean',
        'is_child' => 'boolean',
        'is_guest' => 'boolean',
        'has_rehearsal_invite' => 'boolean',
        'rsvp_responded_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<integer, string>
     */
    protected $appends = ['name'];

    /**
     * Get the user's full name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(get: fn() => $this->first_name . ' ' . $this->last_name);
    }

    /**
     * Get the party this guest is a member of.
     */
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
}
