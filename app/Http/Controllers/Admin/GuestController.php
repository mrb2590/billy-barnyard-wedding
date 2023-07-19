<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Guest as GuestResource;
use App\Http\Resources\Party as PartyResource;
use App\Models\Guest;
use App\Models\Party;
use Inertia\Inertia;
use Inertia\Response;

class GuestController extends Controller
{
    /**
     * Show the guests page.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Guests/Index');
    }

    /**
     * Show the single guest page.
     */
    public function show(Guest $guest): Response
    {
        return Inertia::render('Admin/Guests/Show', [
            'guest' => function () use ($guest) {
                $guest->load(['party']);

                return new GuestResource($guest);
            }
        ]);
    }

    /**
     * Show the create guest page.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Guests/Create', [
            'parties' => fn() => PartyResource::collection(Party::get())
        ]);
    }

    /**
     * Show the edit guest page.
     */
    public function edit(Guest $guest): Response
    {
        $guest->load('party');

        return Inertia::render('Admin/Guests/Edit', [
            'guest' => fn() => new GuestResource($guest),
            'parties' => fn() => PartyResource::collection(Party::get())
        ]);
    }
}
