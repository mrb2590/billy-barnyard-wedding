<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Vite;

class FaviconController extends Controller
{
    /**
     * Redirect to the favicon.
     */
    public function show(): RedirectResponse
    {
        return redirect(Vite::asset('resources/favicon/favicon.ico'));
    }
}
