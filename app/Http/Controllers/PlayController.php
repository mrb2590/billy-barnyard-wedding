<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PlayController extends Controller
{
    /**
     * Show the Flippy Bill game play page.
     */
    public function show(): Response
    {
        return Inertia::render('Play/Show');
    }
}
