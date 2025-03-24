<div class="p-4">
    <!-- Modal Title -->
    <h2 class="text-xl font-semibold mb-3">{{ Str::title($password->title) }} Credentails</h2>
    <!-- Link Section -->
    <div class="mb-3">
        <label class="font-medium text-gray-700">Website:</label>
        <a href="{{ $password->url }}" target="_blank" class="block w-full pb-2 text-blue-900 hover:underline overflow-hidden whitespace-nowrap overflow-ellipsis">
            {{ $password->url }}
        </a>
    </div>

    <!-- Username Section -->
    <div class="mb-3">
        <label class="font-medium text-gray-700">Username:</label>
        <div class="relative">
            <input type="text" value="{{ $password->username }}" readonly class="w-full border border-gray-300 rounded p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button onclick="copyToClipboard('{{ $password->username }}')" class="absolute top-1/2 right-2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" style="    right: 10px;
                top: 10px;
                font-size: 20px;">
                <i class="fas fa-copy"></i>
            </button>
        </div>
    </div>

    <!-- Password Section -->
    <div class="mb-3">
        <label class="font-medium text-gray-700">Password:</label>
        <div class="relative">
            <input type="text" value="{{ $password->password }}" readonly class="w-full border border-gray-300 rounded p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button onclick="copyToClipboard('{{ $password->password }}')" class="absolute top-1/2 right-2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" style="    right: 10px;
                top: 10px;
                font-size: 20px;">
                <i class="fas fa-copy"></i>
            </button>
        </div>
    </div>



    <!-- Note Section -->
    <div class="mb-3">
        <label class="font-medium text-gray-700">Note:</label>
        <textarea readonly class="w-full border border-gray-300 rounded p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4">{{ $password->note }}</textarea>
    </div>
</div>
