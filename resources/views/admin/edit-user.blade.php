<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">Edit User</h2>
    </x-slot>

    <div class="p-6 max-w-md mx-auto">
        <div class="card p-6 bg-gray-800 rounded-lg shadow">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                        class="block w-full bg-gray-900 text-gray-100 border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                        class="block w-full bg-gray-900 text-gray-100 border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-2">Role</label>
                    <select name="is_admin" 
                        class="block w-full bg-gray-900 text-gray-100 border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="0" @if(!$user->is_admin) selected @endif>User</option>
                        <option value="1" @if($user->is_admin) selected @endif>Admin</option>
                    </select>
                    @error('is_admin')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-700">
                    <a href="{{ route('admin.users') }}" 
                       class="inline-block px-5 py-2 rounded-md border border-blue-600 text-blue-400 hover:bg-blue-700 hover:text-white transition">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-block px-5 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
