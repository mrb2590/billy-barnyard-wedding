<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Guest as GuestResource;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $guests = Guest::with(['party'])->paginate(
            perPage: $request->query('per_page') ?? 25,
            page: $request->query('page') ?? 1
        );

        return GuestResource::collection($guests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'is_child' => ['required', 'boolean'],
            'is_guest' => ['required', 'boolean'],
            'is_attending' => ['sometimes', 'nullable', 'boolean'],
            'is_attending_rehearsal' => ['sometimes', 'nullable', 'boolean'],
            'is_guest' => ['required', 'boolean'],
            'has_rehearsal_invite' => ['required', 'boolean'],
            'side' => ['sometimes', 'nullable', 'string', 'in:his,hers,both'],
            'relation' => ['sometimes', 'nullable', 'string'],
            'message_to_guest' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'message_from_guest' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'notes' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'party_id' => ['required', 'string', 'uuid', 'exists:parties,id']
        ]);

        $guest = new Guest();
        $guest->fill($validated);
        $guest->rsvp_responded_at =
            $request->has('is_attending') || $request->has('is_attending_rehearsal') ? now() : null;
        $guest->save();

        return new GuestResource($guest);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest): GuestResource
    {
        $guest->load(['party']);

        return new GuestResource($guest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'is_child' => ['sometimes', 'boolean'],
            'is_guest' => ['sometimes', 'boolean'],
            'is_attending' => ['sometimes', 'nullable', 'boolean'],
            'is_attending_rehearsal' => ['sometimes', 'nullable', 'boolean'],
            'has_rehearsal_invite' => ['sometimes', 'boolean'],
            'side' => ['sometimes', 'nullable', 'string', 'in:his,hers,both'],
            'relation' => ['sometimes', 'nullable', 'string'],
            'message_to_guest' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'message_from_guest' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'notes' => ['sometimes', 'nullable', 'string', 'max:10000'],
            'party_id' => ['required', 'string', 'uuid', 'exists:parties,id']
        ]);

        $guest->fill($validated);
        $guest->rsvp_responded_at =
            ($request->has('is_attending') && $request->is_attending !== null) ||
            ($request->has('is_attending_rehearsal') && $request->is_attending_rehearsal !== null)
                ? now()
                : null;
        $guest->save();

        return new GuestResource($guest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest): Response
    {
        $guest->delete();

        return response(null, 204);
    }
}
