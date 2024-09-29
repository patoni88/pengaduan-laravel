<!DOCTYPE html>
<html>
<head>
	<title>Print</title>
</head>
<body>
	<center>
		<table width="541">
			<tr>
				<td width="80"><img src="{{ public_path('./assets/img/logo.png') }}" width="90" height="90"></td>
				<td>
				<center>
					<font size="4">PEMERINTAH KABUPATEN BANDUNG</font><br>
                    <font size="4">KECAMATAN CICALENGKA</font><br>
					<font size="5"><b>DESA DAMPIT</b></font><br>
					<font size="2">Jl. Cicalengka - Sindangwangi KM 4 No.96 Tlp.7952100</font><br>
					<!-- <font size="2"><i>Jln Cut Nya'Dien No. 02 Kode Pos : 68173 Telp./Fax (0331)758005 Tempurejo Jember Jawa Timur</i></font> -->
				</center>
				</td>
                <td width="80"></td>
			</tr>
			<tr>
                <td colspan="5" style="border-bottom: 1px solid;"></td>
			</tr>
        </table>

        <br>

        <table width="541">
            <tr>
                <center>
                    <b style="text-decoration: underline;">LAPORAN PENGADUAN</b>
                </center>
            </tr>
        </table>

        <table width="541">
            <tr>
                <td align="center">{{ $data->nomor }}</td>
            </tr>
        </table>

        <br>
        <br>

        <table width="541">
            <tr>
                <td>
                    <font>Pada tanggal {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }} telah diterima sebuah laporan dari:</font>
                </td>
            </tr>
        </table>

        <table width="541">
            <tr>
                <td>Nama </td>
                <td>:</td>
                <td width="450"><b>{{ $data->nama }}</b></td>
            </tr>
            <tr>
                <td>Tinggal</td>
                <td>:</td>
                <td width="450">{{ $data->alamatTinggal}}</td>
            </tr>
        </table>

        <table width="541">
            <tr>
                <td>
                    @if($data->finished_updated_at) 
                        <font>Dan telah selesai pada  {{ \Carbon\Carbon::parse($data->finished_updated_at)->format('d M Y') }}. 
                    @endif 
                    Berikut rincian dari laporan yang telah diterima:</font>
                </td>
            </tr>
        </table>

        <table>
            @if($data->finished_updated_at)
            <tr>
                <td>Selesai</td>
                <td>:</td>
                <td width="450"><b>{{ \Carbon\Carbon::parse($data->finished_updated_at)->format('d M Y') }}</b></td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>:</td>
                <td width="450">{{ \Carbon\Carbon::parse($data->finished_updated_at)->format('H:i') }}</td>
            </tr>
            @endif
            <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td style="text-align: justify;" width="450">{{ $data->deskripsi }}</td>
            </tr>
        </table>
            
            <br>

        <table style="border: 1px solid; border-collapse: separate; border-spacing: 0;" width="541">
            <tr style="border: 1px solid;">
                @if($data->rejected_reason)
                    <th style="border: 1px solid;">Rejected</th>
                @endif
                <th style="border: 1px solid;">Approved</th>
                <th style="border: 1px solid;">Process</th>
                <th style="border: 1px solid;">Pending</th>
                <th style="border: 1px solid;">Finished</th>
            </tr>
            <tr style="border: 1px solid;">
                @if($data->rejected_reason)
                    <td style="border: 1px solid;">{{ $data->rejected_reason }}</td>
                @endif
                <td style="border: 1px solid;">{{ $data->approved_reason }}</td>
                <td style="border: 1px solid;">{{ $data->process_reason }}</td>
                <td style="border: 1px solid;">{{ $data->pending_reason }}</td>
                <td style="border: 1px solid;">{{ $data->finished_reason }}</td>
            </tr>
            <tr style="border: 1px solid;">
                @if($data->rejected_reason)
                    <td style="border: 1px solid;">{{ \Carbon\Carbon::parse($data->rejected_updated_at)->format('d M Y, H:i') }}</td>
                @endif
                <td style="border: 1px solid;"> @if ($data->approved_updated_at) {{ \Carbon\Carbon::parse($data->approved_updated_at)->format('d M Y, H:i') }} @endif</td>
                <td style="border: 1px solid;">@if ($data->process_updated_at) {{ \Carbon\Carbon::parse($data->process_updated_at)->format('d M Y, H:i') }} @endif</td>
                <td style="border: 1px solid;">@if ($data->pending_updated_at) {{ \Carbon\Carbon::parse($data->pending_updated_at)->format('d M Y, H:i') }} @endif</td>
                <td style="border: 1px solid;">@if ($data->finished_updated_at) {{ \Carbon\Carbon::parse($data->finished_updated_at)->format('d M Y, H:i') }} @endif</td>
            </tr>
        </table>

        <br>

        <table width="541">
            <td>
                @if ($data->gambar1)
                    <img width="230" height="auto" src="data:image/png;base64,{{ $data->gambar1 }}" alt="Gambar Pengaduan">
                @endif
            </td>
            <td>
                @if ($data->gambar2)
                    <img width="230" height="auto" src="data:image/png;base64,{{ $data->gambar2 }}" alt="Gambar Pengaduan">
                @endif
            </td>
            <td>
                @if ($data->gambar3)
                    <img width="230" height="auto" src="data:image/png;base64,{{ $data->gambar3 }}" alt="Gambar Pengaduan">
                @endif
            </td>
        </table>

        <br><br><br><br>

        <table width="501">
            <tr>
                <td width="390"><br><br><br><br></td>
                <td class="text" align="center">Kepala Desa Dampit<br><br><br><br>{{ $user->name }}</td>
            </tr>
        </table>


        <!-- Include your JavaScript function -->
        <!-- <script>
            // Call the print function when the page finishes loading
            window.onload = function() {
                window.print();
            };
        </script> -->
</body>
</html>