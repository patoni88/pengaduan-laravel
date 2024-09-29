<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <div class="flex justify-end mb-4">
                    <button data-modal-target="add-user-modal" data-modal-toggle="add-user-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Add User
                    </button>
                </div>


                    <!-- With actions -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-white uppercase border-b border-gray-700 bg-gray-800" >
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role User</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-400">
                                @php 
                                    $nomor = 1;
                                @endphp
                                @foreach ($data as $item)
                                <tr class="text-neutral-950 border">
                                    <td class="px-4 py-3 text-sm w-1">
                                        {{ $nomor++ }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->email }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->role }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        @if ($item->role !== 'Administrator')
                                        <form action="{{ route('users.update', $item->id) }}" method="POST">
                                            @csrf
                                            @if ($item->status == 'active')
                                                <button class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" onclick="confirmStatusChange()">
                                                    Active
                                                </button>
                                            @else
                                                <button class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100" onclick="confirmStatusChange()">
                                                    Inactive
                                                </button>
                                            @endif
                                        </form>

                                        <!-- Script JavaScript -->
                                        <script>
                                            function confirmStatusChange() {
                                                var confirmation = window.confirm("Apakah Anda yakin ingin mengubah status?");
                                                if (confirmation) {
                                                    document.getElementById("statusForm").submit();
                                                }
                                            }
                                        </script>
                                        @endif
                                    </td>
                                    <td class="px-6 py-1">
                                        @if ($item->role !== 'Administrator')
                                        <form action="{{ route('users.destroy', $item->id) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Apakah Anda Yakin untuk Menghapus Data ini?')" data-te-ripple-init data-te-ripple-color="light" class="bg-red-700 inline-block rounded-full bg-primary p-2 uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="h-4 w-4 fill-current text-white">
                                                    <path fill="#222" d="M45.59,61H18.41A6.4,6.4,0,0,1,12,54.61V14.2a2,2,0,0,1,2-2H50a2,2,0,0,1,2,2V54.61A6.4,6.4,0,0,1,45.59,61ZM16,16.2V54.61A2.4,2.4,0,0,0,18.41,57H45.59A2.4,2.4,0,0,0,48,54.61V16.2Z"></path>
                                                    <path fill="#222" d="M54.16,16.2H9.84a2,2,0,0,1,0-4H54.16a2,2,0,0,1,0,4Z"></path>
                                                    <path fill="#222" d="M24.33,16.2a2,2,0,0,1-2-2V8.29A5.3,5.3,0,0,1,27.62,3H32a2,2,0,0,1,0,4H27.62a1.29,1.29,0,0,0-1.29,1.29V14.2A2,2,0,0,1,24.33,16.2Z"></path>
                                                    <path fill="#222" d="M39.67 16.2a2 2 0 0 1-2-2V8.29A1.29 1.29 0 0 0 36.38 7H32a2 2 0 0 1 0-4h4.38a5.3 5.3 0 0 1 5.29 5.29V14.2A2 2 0 0 1 39.67 16.2zM38.28 44.88a2 2 0 0 1-1.41-.58L24.3 31.73a2 2 0 1 1 2.83-2.83L39.7 41.47a2 2 0 0 1-1.42 3.41z"></path>
                                                    <path fill="#222" d="M25.72,44.88a2,2,0,0,1-1.42-3.41L36.87,28.9a2,2,0,0,1,2.83,2.83L27.13,44.3A2,2,0,0,1,25.72,44.88Z"></path>
                                                </svg>
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




                    <!-- Modal -->
                    <div id="add-user-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-2/5">
                            <!-- Konten Modal -->
                            <h3 class="mb-4 text-xl font-medium text-gray-900">Add User</h3>
                            <!-- Form atau konten lainnya -->
                            <!-- Form Tambah User -->
                            <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Kepala Desa -->
                            <div class="mt-4">
                                <x-input-label for="kepala_desa" :value="__('Role')" />
                                <span class="block mt-1 w-full inline-block px-4 py-2 font-medium text-white bg-red-500 rounded-lg cursor-default">
                                    Kepala Desa
                                </span>
                            </div>

                            <div class="flex items-center justify-end mt-4">


                                <x-primary-button class="ml-4">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </form>

                            <!-- Tombol Close Modal -->
                            <button type="button" class="absolute top-4 right-4 text-white hover:text-gray-900" data-modal-hide="add-user-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-center">Close</p>
                            </button>
                        </div>
                    </div>


                
                </div>
            </div>
        </div>
    </div>

</x-app-layout>