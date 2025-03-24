<x-app-layout>
    <style>
        <style>#password-modal {
            display: none;
        }

        #password-modal:not(.hidden) {
            display: flex;
        }

        .hidden {
            display: none;
        }

    </style>

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Password Manager</h1>
                    <a class="bg-indigo-600 text-white py-2 px-4 rounded mt-4 hover:bg-indigo-700" href="{{ route("password.create") }}">
                        <i class="fas fa-plus"></i> Create New Password
                    </a>
                </div>

                <div class="p-6 lg:p-8 bg-gray-100">
                    <input type="text" placeholder="Search by URL..." value="{{ request('search') }}" oninput="window.location.href = '/password-manager/' + this.value" class="w-full mb-4 p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" />

                    @foreach($passwords as $password)
                    <div class="bg-white shadow rounded-lg p-4 mb-4 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold">{{ Str::title($password->title) }}</h2>
                            <p class="text-gray-500">{{ $password->url }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fas fa-eye text-blue-500 cursor-pointer" onclick="viewPassword('{{ $password->id }}')"></i>
                            <i class="fas fa-edit text-green-500 cursor-pointer" onclick="window.location.href='{{route('password.edit',$password->id)}}'"></i>
                            <i class="fas fa-trash text-red-500 cursor-pointer" onclick="deletePassword('{{ route('password.delete',$password->id) }}')"></i>
                        </div>
                    </div>
                    @endforeach

                    @if($passwords->isEmpty())
                    <p class="text-gray-500">No passwords found for the given search.</p>
                    @endif
                </div>
            </div>


            @push('scripts')
            <!-- Custom Modal -->
            <div id="password-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white p-4 rounded-lg w-full max-w-4xl relative shadow-lg shadow-gray-500/50" style="box-shadow: 0px 0px 9px 9px gray;">
                    <!-- Close Button -->
                    <div class="flex justify-end">
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl" style="    font-size: 60px;
                        ">
                            &times;
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div id="modal-content" class="mb-3">
                        Loading...
                    </div>

                    <!-- Close Button -->
                    <button onclick="closeModal()" class="bg-gray-500 text-white px-3 py-1 rounded">Close</button>
                </div>
            </div>

            <script>
                function viewPassword(id) {
                    const modal = document.getElementById('password-modal');
                    const modalContent = document.getElementById('modal-content');

                    // Show loading indicator with SweetAlert
                    Swal.fire({
                        title: 'Loading...'
                        , allowOutsideClick: false
                        , didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Fetch the password details
                    fetch(`/passwords/${id}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Failed to load password details.');
                            return response.text(); // Expecting HTML content
                        })
                        .then(html => {
                            Swal.close(); // Close the loading screen
                            modalContent.innerHTML = html; // Set the modal content
                            modal.classList.remove('hidden'); // Show the modal
                        })
                        .catch(error => {
                            Swal.close();
                            alert('Error loading password details!');
                            console.error('Error:', error);
                        });
                }

                function copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(() => {
                        Swal.fire({
                            title: 'Copied!'
                            , icon: 'success'
                        });
                    });
                }

                // Close Modal Function
                function closeModal() {
                    document.getElementById('password-modal').classList.add('hidden');
                }

                function deletePassword(url) {
                    Swal.fire({
                        title: 'Are you sure?'
                        , text: 'You wont be able to revert this!'
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#3085d6'
                        , cancelButtonColor: '#d33'
                        , confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                }

            </script>
            @endpush
        </div>
    </div>
</x-app-layout>
