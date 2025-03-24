<div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Modal Background -->
    <div class="fixed inset-0 bg-gray-900 opacity-75" x-on:click="show = false"></div>

    <!-- Modal Content -->
    <div class="bg-white w-full max-w-lg mx-auto p-6 rounded-lg shadow-lg z-10" x-on:keydown.escape.window="show = false">
        <h2 class="text-xl font-semibold mb-4">Password Details</h2>
        <div>
            {{ $passwordDetails }}
        </div>
        <button wire:click="closeModal" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
    </div>
</div>
