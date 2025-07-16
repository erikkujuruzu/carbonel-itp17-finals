<aside class="h-full flex flex-col">
    <!-- Sidebar Header -->
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-base font-semibold text-gray-900 tracking-tight">Notifications</h3>
        <p class="text-xs text-gray-500 mt-1">Recent bookings</p>
    </div>
    <!-- Notifications List -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4 sidebar-scroll bg-white">
        @if(isset($bookings) && $bookings->count() > 0)
            @foreach($bookings->sortByDesc('created_at')->take(10) as $booking)
                <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded-r-lg shadow-sm">
                    <div class="text-xs text-gray-500 mb-1">{{ $booking->created_at->diffForHumans() }}</div>
                    <div class="font-medium text-blue-900 text-sm truncate">{{ $booking->user->name }} booked</div>
                    <div class="text-xs text-blue-700 font-medium">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->date)->format('M d, Y') }}</div>
                    @if($booking->note)
                        <div class="text-xs text-gray-600 mt-1 italic truncate">"{{ Str::limit($booking->note, 50) }}"</div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="text-center py-8">
                <div class="text-gray-400 text-sm mb-2">No recent bookings</div>
                <div class="text-xs text-gray-500">Bookings will appear here</div>
            </div>
        @endif
    </div>
</aside> 