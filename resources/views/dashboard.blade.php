<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <a href="{{ route('bookings.create') }}" class="btn-primary flex items-center" style="display:inline-flex;align-items:center;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#2563eb;color:#fff;font-weight:500;font-size:1rem;text-decoration:none;transition:background 0.15s;gap:0.5rem;">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Create Booking
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="card flex items-center p-4">
                <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded bg-blue-100 mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500">Total Bookings</div>
                    <div class="text-lg font-bold text-gray-900">{{ $totalBookings }}</div>
                </div>
            </div>
            @if(Auth::user()->is_admin && $totalUsers)
            <a href="{{ route('admin.users') }}" class="card flex items-center p-4 hover:bg-gray-50 transition cursor-pointer" style="text-decoration: none;">
                <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded bg-green-100 mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500">Total Users</div>
                    <div class="text-lg font-bold text-gray-900">{{ $totalUsers }}</div>
                </div>
            </a>
            @endif
        </div>

        <!-- Bookings Table -->
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-900">{{ Auth::user()->is_admin ? 'All Bookings' : 'My Bookings' }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full table-hover text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            @if(Auth::user()->is_admin)
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Note</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->date)->format('M d, Y') }}</td>
                            @if(Auth::user()->is_admin)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                            @endif
                            <td class="px-6 py-4">{{ $booking->note ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="btn-outline text-xs" style="display:inline-block;padding:0.4rem 1rem;border-radius:0.375rem;background:#fff;color:#2563eb;font-weight:500;font-size:0.95rem;border:1px solid #2563eb;text-decoration:none;transition:background 0.15s;">Edit</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline text-xs text-red-600 border-red-400 hover:bg-red-50 hover:border-red-600" style="display:inline-block;padding:0.4rem 1rem;border-radius:0.375rem;background:#fff;color:#dc2626;font-weight:500;font-size:0.95rem;border:1px solid #fecaca;text-decoration:none;transition:background 0.15s;" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->is_admin ? '4' : '3' }}" class="px-6 py-8 text-center text-gray-500">
                                <div class="text-sm">No bookings found</div>
                                <div class="mt-2">
                                    <a href="{{ route('bookings.create') }}" class="btn-primary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#2563eb;color:#fff;font-weight:500;font-size:1rem;text-decoration:none;transition:background 0.15s;">Create your first booking</a>
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
