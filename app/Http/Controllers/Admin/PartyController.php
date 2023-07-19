<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Party;
use Inertia\Inertia;
use Inertia\Response;

class PartyController extends Controller
{
    /**
     * Show the parties page.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Parties/Index');
    }

    /**
     * Show the single party page.
     */
    public function show(Party $party): Response
    {
        return Inertia::render('Admin/Parties/Show', [
            'party' => function () use ($party) {
                $party->load(['guests']);

                return $party;
            }
        ]);
    }

    /**
     * Show the create party page.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Parties/Create');
    }
}
