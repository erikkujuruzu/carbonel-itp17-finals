<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Users</h2>
    </x-slot>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_admin)
                                <span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Admin</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.users.edit', $user) }}" style="display:inline-block;padding:0.4rem 1rem;border-radius:0.375rem;background:#fff;color:#2563eb;font-weight:500;font-size:0.95rem;border:1px solid #2563eb;text-decoration:none;transition:background 0.15s;margin-right:0.5rem;">Edit</a>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" style="display:inline-block;padding:0.4rem 1rem;border-radius:0.375rem;background:#fff;color:#dc2626;font-weight:500;font-size:0.95rem;border:1px solid #fecaca;text-decoration:none;transition:background 0.15s;">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout> 