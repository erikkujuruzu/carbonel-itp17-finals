<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </x-slot>
    <div class="p-6 max-w-md mx-auto">
        <div class="card p-6">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select name="is_admin" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="0" @if(!$user->is_admin) selected @endif>User</option>
                        <option value="1" @if($user->is_admin) selected @endif>Admin</option>
                    </select>
                    @error('is_admin')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.users') }}" class="btn-secondary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#fff;color:#2563eb;font-weight:500;font-size:1rem;border:1px solid #2563eb;text-decoration:none;transition:background 0.15s;">Cancel</a>
                    <button type="submit" class="btn-primary" style="display:inline-block;padding:0.5rem 1.25rem;border-radius:0.375rem;background:#2563eb;color:#fff;font-weight:500;font-size:1rem;text-decoration:none;transition:background 0.15s;">Update User</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 