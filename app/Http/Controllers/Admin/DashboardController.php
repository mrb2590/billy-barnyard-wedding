<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function show(): Response
    {
        return Inertia::render('Admin/Dashboard');
    }
}
