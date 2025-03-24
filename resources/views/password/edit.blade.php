<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Password') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Password</h1>

                <form method="POST" action="{{ route('password.update', $password->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="url" class="block text-gray-700 font-semibold mb-2">URL *</label>
                        <input type="text" name="url" id="url" value="{{ $password->url }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-semibold mb-2">Username or Email *</label>
                        <input type="text" name="username" id="username" value="{{ $password->username }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Password *</label>
                        <input type="password" name="password" id="password" value="{{ $password->password }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700 font-semibold mb-2">Notes</label>
                        <textarea name="notes" id="notes" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">{{ $password->notes }}</textarea>
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700">Update Password</button>
                    <a href="{{ route('dashboard') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
