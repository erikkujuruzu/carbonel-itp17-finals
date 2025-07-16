<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Booking</h2>
            <a href="{{ route('dashboard') }}" class="btn-secondary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#fff;color:#2563eb;font-weight:500;font-size:1rem;border:1px solid #2563eb;text-decoration:none;transition:background 0.15s;">Back to Dashboard</a>
        </div>
    </x-slot>
    <div class="p-6">
        <div class="max-w-md mx-auto">
            <div class="card p-6">
                <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                    @csrf
                    <!-- Calendar Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                        <div class="bg-gray-50 p-4 rounded border border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <button type="button" id="prevMonth" style="padding:0.25rem 0.75rem;border-radius:0.375rem;background:#f3f4f6;color:#2563eb;font-weight:500;border:1px solid #e5e7eb;">&lt;</button>
                                <span id="calendarMonth" style="font-weight:600;font-size:1rem;"></span>
                                <button type="button" id="nextMonth" style="padding:0.25rem 0.75rem;border-radius:0.375rem;background:#f3f4f6;color:#2563eb;font-weight:500;border:1px solid #e5e7eb;">&gt;</button>
                            </div>
                            <div id="calendar" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem;"></div>
                        </div>
                        <input type="hidden" name="date" id="selected_date" required>
                        @error('date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Note Section -->
                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700 mb-2">Note (Optional)</label>
                        <textarea id="note" name="note" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Add any additional notes...">{{ old('note') }}</textarea>
                        @error('note')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}" class="btn-secondary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#fff;color:#2563eb;font-weight:500;font-size:1rem;border:1px solid #2563eb;text-decoration:none;transition:background 0.15s;">Cancel</a>
                        <button type="submit" class="btn-primary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#2563eb;color:#fff;font-weight:500;font-size:1rem;text-decoration:none;transition:background 0.15s;">Create Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Calendar with month navigation for create
        const bookedDates = JSON.parse('{!! addslashes(json_encode($bookings->pluck("date"))) !!}');
        let selectedDate = null;
        let today = new Date();
        let viewMonth = today.getMonth();
        let viewYear = today.getFullYear();
        function renderCalendar() {
            const calendar = document.getElementById('calendar');
            const monthLabel = document.getElementById('calendarMonth');
            calendar.innerHTML = '';
            const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
            days.forEach(d => {
                const el = document.createElement('div');
                el.style.textAlign = 'center';
                el.style.fontWeight = 'bold';
                el.style.fontSize = '12px';
                el.style.color = '#6b7280';
                el.textContent = d;
                calendar.appendChild(el);
            });
            const firstDay = new Date(viewYear, viewMonth, 1);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                const dateString = date.toISOString().split('T')[0];
                const isBooked = bookedDates.includes(dateString);
                const isCurrentMonth = date.getMonth() === viewMonth;
                const isToday = date.toDateString() === today.toDateString();
                const isSelected = dateString === selectedDate;
                const dayBtn = document.createElement('button');
                dayBtn.type = 'button';
                dayBtn.style.width = '2.5rem';
                dayBtn.style.height = '2.5rem';
                dayBtn.style.borderRadius = '0.375rem';
                dayBtn.style.border = '1px solid #e5e7eb';
                dayBtn.style.background = '#fff';
                dayBtn.style.fontWeight = '500';
                dayBtn.style.fontSize = '15px';
                dayBtn.style.transition = 'all 0.1s';
                dayBtn.textContent = date.getDate();
                if (!isCurrentMonth) {
                    dayBtn.style.background = '#f9fafb';
                    dayBtn.style.color = '#d1d5db';
                    dayBtn.disabled = true;
                } else if (isBooked) {
                    dayBtn.style.background = '#fee2e2';
                    dayBtn.style.color = '#b91c1c';
                    dayBtn.style.border = '1px solid #fecaca';
                    dayBtn.disabled = true;
                    dayBtn.title = 'Booked';
                } else if (date < today) {
                    dayBtn.style.background = '#f3f4f6';
                    dayBtn.style.color = '#9ca3af';
                    dayBtn.disabled = true;
                    dayBtn.title = 'Past date';
                } else {
                    dayBtn.style.cursor = 'pointer';
                    dayBtn.addEventListener('mouseenter', () => {
                        dayBtn.style.background = '#dbeafe';
                        dayBtn.style.border = '1px solid #60a5fa';
                        dayBtn.style.color = '#2563eb';
                    });
                    dayBtn.addEventListener('mouseleave', () => {
                        if (!dayBtn.classList.contains('selected')) {
                            dayBtn.style.background = '#fff';
                            dayBtn.style.border = '1px solid #e5e7eb';
                            dayBtn.style.color = '#111827';
                        }
                    });
                    dayBtn.addEventListener('click', () => selectDate(dateString, dayBtn));
                }
                if (isToday && isCurrentMonth && !isBooked && date >= today) {
                    dayBtn.style.boxShadow = '0 0 0 2px #93c5fd';
                }
                if (isSelected) {
                    dayBtn.classList.add('selected');
                    dayBtn.style.background = '#2563eb';
                    dayBtn.style.color = '#fff';
                    dayBtn.style.border = '1px solid #2563eb';
                }
                calendar.appendChild(dayBtn);
            }
            monthLabel.textContent = new Date(viewYear, viewMonth).toLocaleString('default', { month: 'long', year: 'numeric' });
        }
        function selectDate(dateString, element) {
            selectedDate = dateString;
            document.getElementById('selected_date').value = dateString;
            renderCalendar();
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('prevMonth').addEventListener('click', function() {
                if (viewMonth === 0) {
                    viewMonth = 11;
                    viewYear--;
                } else {
                    viewMonth--;
                }
                renderCalendar();
            });
            document.getElementById('nextMonth').addEventListener('click', function() {
                if (viewMonth === 11) {
                    viewMonth = 0;
                    viewYear++;
                } else {
                    viewMonth++;
                }
                renderCalendar();
            });
            renderCalendar();
        });
    </script>
</x-app-layout> 