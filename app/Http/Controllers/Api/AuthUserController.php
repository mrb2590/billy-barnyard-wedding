<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    /**
     * Return the currently authenticated user.
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }
}
