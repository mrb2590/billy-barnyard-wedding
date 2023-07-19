<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Rules\VerifyRSVPCodeToGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PartySearchController extends Controller
{
    /**
     * Show the search RSVP page.
     */
    public function create(): Response
    {
        return Inertia::render('RSVP/SearchParty');
    }

    /**
     * Search RSVP invitations.
     */
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'rsvp_code' => ['required', 'string', 'size:6', new VerifyRSVPCodeToGuest()]
        ]);

        $party = Party::where('rsvp_code', $request->rsvp_code)->firstOrFail();

        $request->session()->put('party', $party);

        return Redirect::route('party.edit', [
            'party' => $party->id
        ]);
    }
}
