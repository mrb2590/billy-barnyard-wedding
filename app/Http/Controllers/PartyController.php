<?php

namespace App\Http\Controllers;

use App\Mail\RSVPThankYou;
use App\Models\Party;
use App\Models\User;
use App\Notifications\PartyRSVP;
use App\Rules\VerifyRSVPCodeToGuest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PartyController extends Controller
{
    /**
     * Show the RSVP respond page.
     */
    public function edit(Party $party): Response
    {
        return Inertia::render('RSVP/EditParty', [
            'party' => function () use ($party) {
                $party->load(['guests']);

                return $party;
            }
        ]);
    }

    /**
     * Update an RSVP.
     */
    public function update(Request $request, Party $party): RedirectResponse
    {
        $request->validate([
            'guests' => ['required', 'array'],
            'guests.*.id' => ['required', 'uuid', new VerifyRSVPCodeToGuest()],
            'guests.*.email' => ['sometimes', 'nullable', 'email'],
            'guests.*.is_attending_rehearsal' => ['sometimes', 'nullable', 'boolean'],
            'guests.*.is_attending' => ['required', 'boolean']
        ]);

        foreach ($request->guests as $requestGuest) {
            $party
                ->guests()
                ->findOrFail($requestGuest['id'])
                ->update([
                    'rsvp_responded_at' => now(),
                    'email' => $requestGuest['email'] ?? null,
                    'is_attending_rehearsal' => (bool) $requestGuest['is_attending_rehearsal'],
                    'is_attending' => (bool) $requestGuest['is_attending']
                ]);
        }

        $party->load(['guests']);

        User::each(fn(User $user) => $user->notify(new PartyRSVP($party)));

        $party
            ->guests()
            ->whereNotNull('email')
            ->each(fn($guest) => Mail::to($guest->email)->send(new RSVPThankYou($guest)));

        return Redirect::back();
    }
}
