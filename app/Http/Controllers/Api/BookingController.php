<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Notifications\BookingCreated;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->is_admin) {
            $bookings = Booking::with('user')->get();
        } else {
            $bookings = $user->bookings()->with('user')->get();
        }
        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:bookings,date',
            'note' => 'nullable|string',
        ]);
        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'date' => $request->date,
            'note' => $request->note,
        ]);
        $request->user()->notify(new BookingCreated($booking));
        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $booking = Booking::with('user')->findOrFail($id);
        $this->authorize('view', $booking);
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);
        $request->validate([
            'date' => 'required|date|unique:bookings,date,' . $booking->id,
            'note' => 'nullable|string',
        ]);
        $booking->update($request->only('date', 'note'));
        return response()->json($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('delete', $booking);
        $booking->delete();
        return response()->json(['message' => 'Booking deleted']);
    }
}
