<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">Dashboard</h2>
            <a href="{{ route('bookings.create') }}"
               class="flex items-center px-5 py-2.5 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-500 transition gap-2 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Create Booking
            </a>
        </div>
    </x-slot>

    <div class="p-6 bg-gray-900 min-h-screen text-gray-100">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="flex items-center p-4 bg-gray-800 rounded shadow">
                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 rounded mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-400">Total Bookings</div>
                    <div class="text-lg font-bold">{{ $totalBookings }}</div>
                </div>
            </div>

            @if(Auth::user()->is_admin && $totalUsers)
            <a href="{{ route('admin.users') }}"
               class="flex items-center p-4 bg-gray-800 rounded shadow hover:bg-gray-700 transition cursor-pointer text-white no-underline">
                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-600 rounded mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
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
        <div class="bg-gray-800 rounded shadow">
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
                                    <a href="{{ route('bookings.edit', $booking) }}"
                                       class="px-4 py-2 rounded bg-blue-800 text-white text-xs font-medium hover:bg-blue-700 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 rounded bg-red-600 text-white text-xs font-medium hover:bg-red-500 transition"
                                                onclick="return confirm('Are you sure you want to delete this booking?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->is_admin ? '4' : '3' }}" class="px-6 py-8 text-center text-gray-400">
                                <div class="text-sm">No bookings found</div>
                                <div class="mt-2">
                                    <a href="{{ route('bookings.create') }}"
                                       class="inline-block px-5 py-2.5 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-500 transition">
                                        Create your first booking
                                    </a>
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
