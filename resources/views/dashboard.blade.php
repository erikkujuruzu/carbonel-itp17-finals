<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">Dashboard</h2>
            <a href="{{ route('bookings.create') }}" class="btn-primary flex items-center" style="display:inline-flex;align-items:center;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#3b82f6;color:#fff;font-weight:500;font-size:1rem;text-decoration:none;transition:background 0.15s;gap:0.5rem;">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Create Booking
            </a>
        </div>
    </x-slot>

    <div class="p-6 bg-gray-900 min-h-screen text-gray-100">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="card flex items-center p-4 bg-gray-800 rounded shadow">
                <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded bg-blue-600 mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-400">Total Bookings</div>
                    <div class="text-lg font-bold">{{ $totalBookings }}</div>
                </div>
            </div>

            @if(Auth::user()->is_admin && $totalUsers)
            <a href="{{ route('admin.users') }}" class="card flex items-center p-4 bg-gray-800 rounded shadow hover:bg-gray-700 transition cursor-pointer" style="text-decoration: none;">
                <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded bg-green-600 mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-400">Total Users</div>
                    <div class="text-lg font-bold">{{ $totalUsers }}</div>
                </div>
            </a>
            @endif
        </div>

        <!-- Bookings Table -->
        <div class="card bg-gray-800 rounded shadow">
            <div class="px-6 py-4 border-b border-gray-700">
                <h3 class="text-base font-semibold">{{ Auth::user()->is_admin ? 'All Bookings' : 'My Bookings' }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-100">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Date</th>
                            @if(Auth::user()->is_admin)
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">User</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Note</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->date)->format('M d, Y') }}</td>
                            @if(Auth::user()->is_admin)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                            @endif
                            <td class="px-6 py-4">{{ $booking->note ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="text-xs" style="display:inline-block;padding:0.4rem 1rem;border-radius:0.375rem;background:#1e40af;color:#fff;font-weight:500;font-size:0.95rem;text-decoration:none;">Edit</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs" style="display:inline-block;padding:0.4rem 1rem;border-radius:0.375rem;background:#dc2626;color:#fff;font-weight:500;font-size:0.95rem;border:none;text-decoration:none;" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->is_admin ? '4' : '3' }}" class="px-6 py-8 text-center text-gray-400">
                                <div class="text-sm">No bookings found</div>
                                <div class="mt-2">
                                    <a href="{{ route('bookings.create') }}" class="btn-primary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#3b82f6;color:#fff;font-weight:500;font-size:1rem;text-decoration:none;">Create your first booking</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
