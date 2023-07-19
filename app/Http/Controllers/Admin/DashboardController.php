<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function show(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'receptionResponses' => fn() => [
                Guest::where('is_attending', true)->count(),
                Guest::where('is_attending', false)->count(),
                Guest::whereNull('is_attending')->count()
            ],
            'welcomeDinnerResponses' => fn() => [
                Guest::where('is_attending_rehearsal', true)->count(),
                Guest::where('is_attending_rehearsal', false)->count(),
                Guest::whereNull('is_attending_rehearsal')->count()
            ]
        ]);
    }
}
