<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaduan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <div class="flex items-center mb-4">
                                <strong class="mr-2">No. HP:</strong>
                                <p>{{ $data->kontak }}</p>
                                <form method="POST" action="{{ route('contact.store') }}" class="ml-2">
                                    @csrf
                                    <input type="hidden" name="kontak" value="{{ $data->kontak }}">
                                    <input type="hidden" name="nama" value="{{ $data->nama }}">
                                    @if($isBlocked)
                                        <svg class="h-6 w-6 text-red-500 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                    <span class="text-xs text-red-500 hover:text-red-700 focus:text-red-700">Ter-Blokir</span>
                                    @else
                                    <button type="submit" class="text-red-500 flex hover:text-red-700 focus:text-red-700" onclick="return confirm('Apakah Anda yakin ingin memblokir kontak ini?')">
                                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                        <span class="text-xs">Block</span>
                                    </button>
                                    @endif
                                </form>
                            </div>
                            <p class="mb-4"><strong>ID Pengaduan:</strong> {{ $data->nomor }}</p>
                            <p class="mb-4"><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i') }}</p>
                            <p class="mb-4"><strong>Nama:</strong> {{ $data->nama }}</p>
                            <p class="mb-4"><strong>Alamat Tinggal:</strong> {{ $data->alamatTinggal }}</p>
                            <p class="mb-4"><strong>Lokasi Pengaduan:</strong> {{ $data->lokasi }}</p>
                            <p class="mb-4"><strong>Deskripsi Pengaduan:</strong> {{ $data->deskripsi }}</p>
                        </div>
                        <div>
                            <p class="mb-4"><strong>Di Update Oleh: @if($data->update_user_by_id) {{ $user->name }} @endif</strong>
                            
                            <p class="mb-4"><strong>Status saat ini:</strong> 
                            @switch($data->status)
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
                            </p>

                            @if ($data->status !== 'finished' && $data->status !== 'rejected')
                            @if (auth()->user()->role !== 'Administrator')
                            <form action="{{ route('pengaduan.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <p class="mb-1">
                                    <strong>Ubah Status:</strong>
                                    <select name="status" id="status" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value=""> -- Pilih Status -- </option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="process">Process</option>
                                        <option value="pending">Pending</option>
                                        <option value="finished">Finished</option>
                                    </select>
                                    <div class="mt-2">
                                        <textarea name="keterangan" id="keterangan" style="width: 15cm;" class="rounded-md  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="1" placeholder="Tambahkan keterangan... untuk dikirim ke masyarakat"></textarea>
                                    </div>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Status</button>
                                </p>
                            </form>
                            @endif
                            @endif

                        </div>
                    </div>

                    <!-- With actions -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-white uppercase border-b border-gray-700 bg-gray-800" >
                                    <th class="px-4 py-3">Approved</th>
                                    <th class="px-4 py-3">Rejected</th>
                                    <th class="px-4 py-3">Process</th>
                                    <th class="px-4 py-3">Pending</th>
                                    <th class="px-4 py-3">Finished</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-400">
                                @php 
                                    $nomor = 1;
                                @endphp
                                <tr class="text-neutral-950 border">
                                    <td class="px-4 py-3 text-sm">
                                        @if( $data->approved_reason )
                                        {{ $data->approved_reason }}
                                        <p class="text-xs text-green-500">{{ \Carbon\Carbon::parse($data->approved_updated_at)->format('d M Y, H:i') }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if( $data->rejected_reason )
                                        {{ $data->rejected_reason }}
                                        <p class="text-xs text-green-500">{{ \Carbon\Carbon::parse($data->rejected_updated_at)->format('d M Y, H:i') }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if( $data->process_reason )
                                        {{ $data->process_reason }}
                                        <p class="text-xs text-green-500">{{ \Carbon\Carbon::parse($data->process_updated_at)->format('d M Y, H:i') }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if( $data->pending_reason )
                                        {{ $data->pending_reason }}
                                        <p class="text-xs text-green-500">{{ \Carbon\Carbon::parse($data->pending_updated_at)->format('d M Y, H:i') }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if( $data->finished_reason )
                                        {{ $data->finished_reason }}
                                        <p class="text-xs text-green-500">{{ \Carbon\Carbon::parse($data->finished_updated_at)->format('d M Y, H:i') }}</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            
                        </div>
                    </div>

                    <hr class="w-full border-gray-300 my-4">

                    <div class="mt-14 flex" style="">
                        @if ($data->gambar1)
                            <img src="data:image/png;base64,{{ $data->gambar1 }}" alt="Gambar Pengaduan" class="mb-4 border border-gray-300 rounded" style="width: 10cm; max-height: 100%; margin-right: 10px;">
                        @endif
                        @if ($data->gambar2)
                            <img src="data:image/png;base64,{{ $data->gambar2 }}" alt="Gambar Pengaduan" class="mb-4 border border-gray-300 rounded" style="width: 10cm; max-height: 100%; margin-right: 10px;">
                        @endif
                        @if ($data->gambar3)
                            <img src="data:image/png;base64,{{ $data->gambar3 }}" alt="Gambar Pengaduan" class="mb-4 border border-gray-300 rounded" style="width: 10cm; max-height: 100%; margin-right: 10px;">
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <!-- <a href="{{ route('pengaduan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 mr-2 rounded">
                            Kembali
                        </a> -->
                        <button onclick="goBack()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 mr-2 rounded">
                            Kembali
                        </button>
                        @if (auth()->user()->role !== 'Kepala Desa')
                        <a href="{{ route('pengaduan.show', $data->id) }}">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded">
                                PDF
                            </button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- target="_blank" -->

<script>
    function goBack() {
        window.history.back();
    }
</script>