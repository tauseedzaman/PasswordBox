<x-app-layout>
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


            @livewire('password-modal')

            @push('scripts')
            <script>
                function viewPassword(id) {
                    // Show loading screen
                    Swal.fire({
                        title: 'Loading...'
                        , allowOutsideClick: false
                        , didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        Swal.close();
                        window.Livewire.dispatch('showPasswordModal', {
                            id: id
                        });
                    }, 1500); // Adjust the delay as needed
                }

                function closeModal() {
                    document.getElementById('passwordModal').classList.add('hidden');
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
    </div>
</x-app-layout>
