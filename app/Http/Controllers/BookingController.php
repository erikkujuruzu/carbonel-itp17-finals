<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        if ($user->is_admin) {
            $totalBookings = Booking::count();
            $totalUsers = User::count();
            $bookings = Booking::with('user')->latest()->get();
        } else {
            $totalBookings = $user->bookings()->count();
            $totalUsers = null;
            $bookings = $user->bookings()->latest()->get();
        }
        
        return view('dashboard', compact('totalBookings', 'totalUsers', 'bookings'));
    }

    public function create()
    {
        $bookings = Booking::with('user')->get();
        return view('bookings.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:bookings,date',
            'note' => 'nullable|string',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'note' => $request->note,
        ]);

        Auth::user()->notify(new BookingCreated($booking));

        return redirect()->route('dashboard')->with('success', 'Booking created successfully!');
    }

    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        $bookings = Booking::with('user')->get();
        return view('bookings.edit', compact('booking', 'bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);
        
        $request->validate([
            'date' => 'required|date|unique:bookings,date,' . $booking->id,
            'note' => 'nullable|string',
        ]);

        $booking->update($request->only('date', 'note'));
        return redirect()->route('dashboard')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();
        return redirect()->route('dashboard')->with('success', 'Booking deleted successfully!');
    }
}
