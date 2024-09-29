<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
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
                                    <div class="w-1/2 mr-2">
                                        <div class="relative">
                                        <select name="bulan" class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                                            <option value="">Pilih Bulan</option>
                                            <option value="1" {{ $bulan == '1' ? 'selected' : '' }}>Januari</option>
                                            <option value="2" {{ $bulan == '2' ? 'selected' : '' }}>Februari</option>
                                            <option value="3" {{ $bulan == '3' ? 'selected' : '' }}>Maret</option>
                                            <option value="4" {{ $bulan == '4' ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ $bulan == '5' ? 'selected' : '' }}>Mei</option>
                                            <option value="6" {{ $bulan == '6' ? 'selected' : '' }}>Juni</option>
                                            <option value="7" {{ $bulan == '7' ? 'selected' : '' }}>Juli</option>
                                            <option value="8" {{ $bulan == '8' ? 'selected' : '' }}>Agustus</option>
                                            <option value="9" {{ $bulan == '9' ? 'selected' : '' }}>September</option>
                                            <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                                            <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                                            <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                                        </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M0 0h20v20H0z" fill="none"/>
                                                    <path d="M8 7v6l4-3z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-1/2 ml-2 mr-2">
                                        <select name="tahun" class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                                            <option value="">Semua Tahun</option>
                                            @php
                                            $currentYear = date('Y');
                                            $startYear = 2022; // Tahun awal yang ingin ditampilkan
                                            $endYear = $currentYear; // Tahun akhir yang ingin ditampilkan
                                            @endphp

                                            @for ($year = $endYear; $year >= $startYear; $year--)
                                                <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                        <!-- Tombol Cari -->
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded-md">
                                        Cari
                                    </button>
                                </div>
                            </form>

                            <table class="w-full whitespace-no-wrap inline-block">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-white uppercase border-b border-gray-700 bg-gray-800" >
                                <th class="px-4 py-3 w-1">No</th>
                                <th class="px-4 py-3 w-4">Nomor Pengaduan</th>
                                <th class="px-4 py-3">No.Hp</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Deskripsi</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3"></th>
                                <!-- <th class="px-4 py-3">Cetak</th> -->
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-400">
                                @php 
                                    $nomor = 1 + (( $data->currentPage() - 1) * $data->perPage());
                                @endphp
                                @foreach ($data as $item)
                                <tr class="text-neutral-950 border">
                                    <td class="px-4 py-3 text-sm w-1">
                                        {{ $nomor++ }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->nomor }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->kontak }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ Str::limit($item->deskripsi, 80) }}
                                        <hr class="w-full border-gray-300 my-4">
                                        <strong class="text-green-500">Lokasi: </strong>{{ $item->lokasi }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                    @switch($item->status)
                                            @case('waiting')
                                                <span class="px-2 py-1 font-semibold leading-tight  rounded-full bg-yellow-500 text-blue-100">
                                                    Waiting
                                                </span>
                                                @break
                                            @case('approved')
                                                <span class="px-2 py-1 font-semibold leading-tight  rounded-full bg-blue-700 text-green-100">
                                                    Approved
                                                </span>
                                                @break
                                            @case('rejected')
                                                <span class="px-2 py-1 font-semibold leading-tight  rounded-full bg-red-700 text-red-100">
                                                    Rejected
                                                </span>
                                                @break
                                            @case('process')
                                                <span class="px-2 py-1 font-semibold leading-tight  rounded-full bg-blue-400 text-yellow-100">
                                                    Process
                                                </span>
                                                @break
                                            @case('pending')
                                                <span class="px-2 py-1 font-semibold leading-tight  rounded-full bg-gray-700 text-gray-100">
                                                    Pending
                                                </span>
                                                @break
                                            @case('finished')
                                                <span class="px-2 py-1 font-semibold leading-tight  rounded-full bg-green-600 text-purple-100">
                                                    Finished
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a href="{{ route('pengaduan.edit', $item->id) }}" class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 transition duration-300 ease-in-out hover:text-blue-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('pengaduan.show', $item->id) }}" target="_blank" class="inline-flex items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 transition duration-300 ease-in-out hover:text-blue-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            Cetak
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            <!-- {{ $data->links() }} -->
                            {!! $data->appends(Request::except('page'))->render() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>