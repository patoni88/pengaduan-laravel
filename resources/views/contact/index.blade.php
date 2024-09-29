<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kontak di Blokir') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- With actions -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">

                            <form method="GET" action="">
                                <div class="flex justify-between">
                                    <div class="w-2/4">
                                        <!-- Tombol Search -->
                                        <input type="text" value="{{ $search }}" name="search" autofocus placeholder="Cari ... berdasarkan No.Hp dan Nama" class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                                    </div>
                                </div>
                            </form>

                            <table class="w-full whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-white uppercase border-b border-gray-700  bg-gray-800" >
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nomor WhatsApp</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Waktu Blokir</th>
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
                                        {{ str_replace('@c.us', '', $item->kontak) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-1">
                                        <form action="{{ route('contact.destroy', $item->id) }}" method="post" class="d-inline">
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


</x-app-layout>