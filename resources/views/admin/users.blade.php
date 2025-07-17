<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">All Users</h2>
    </x-slot>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-sm text-gray-100 rounded shadow">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-700 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_admin)
                                <span class="inline-block px-2 py-1 text-xs bg-blue-600 text-white rounded">Admin</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs bg-gray-600 text-gray-100 rounded">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-block px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition mr-2">
                                Edit
                            </a>

                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        class="inline-block px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition">
                                    Delete
                                </button>
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
