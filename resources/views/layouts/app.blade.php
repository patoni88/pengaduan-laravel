<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pengaduan Masyarakat') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
        <!--Replace with your tailwind.css once created-->


        <!--Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">

        <!-- icon -->
        <link rel="icon" type="image/png" href="{{ asset('/assets/img/logo.png') }}">

        <!-- lightbox2 -->
        <link rel="stylesheet" href="../dist/css/lightbox.min.css">

        <style>
            /*Overrides for Tailwind CSS */

            /*Form fields*/
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #4a5568;
                /*text-gray-700*/
                padding-left: 1rem;
                /*pl-4*/
                padding-right: 1rem;
                /*pl-4*/
                padding-top: .5rem;
                /*pl-2*/
                padding-bottom: .5rem;
                /*pl-2*/
                line-height: 1.25;
                /*leading-tight*/
                border-width: 2px;
                /*border-2*/
                border-radius: .25rem;
                border-color: #edf2f7;
                /*border-gray-200*/
                background-color: #edf2f7;
                /*bg-gray-200*/
            }

            /*Row Hover*/
            table.dataTable.hover tbody tr:hover,
            table.dataTable.display tbody tr:hover {
                background-color: #ebf4ff;
                /*bg-indigo-100*/
            }

            /*Pagination Buttons*/
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }

            /*Pagination Buttons - Current selected */
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                color: #fff !important;
                /*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /*shadow*/
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                background: #667eea !important;
                /*bg-indigo-500*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }

            /*Pagination Buttons - Hover */
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                color: #fff !important;
                /*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /*shadow*/
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                background: #667eea !important;
                /*bg-indigo-500*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }

            /*Add padding to bottom border */
            table.dataTable.no-footer {
                border-bottom: 1px solid #e2e8f0;
                /*border-b-1 border-gray-300*/
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }

            /*Change colour of responsive icon*/
            table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
            table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #667eea !important;
                /*bg-indigo-500*/
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @include('flash-message')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')



        </div>


        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {

                var table = $('#example').DataTable({
                        responsive: true
                    })
                    .columns.adjust()
                    .responsive.recalc();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');

                modalToggleButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        const target = button.dataset.modalTarget;
                        const modal = document.getElementById(target);

                        if (modal) {
                            modal.classList.toggle('hidden');
                        }
                    });
                });

                const modalHideButtons = document.querySelectorAll('[data-modal-hide]');

                modalHideButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        const target = button.dataset.modalHide;
                        const modal = document.getElementById(target);

                        if (modal) {
                            modal.classList.add('hidden');
                        }
                    });
                });
            });
        </script>

        <script>
            $('.swall-confirm').click(function(e) {
                id = e.target.dataset.id;
                swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang terhapus tidak dapat dikembalikan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-warning',
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, function() {
                    swal("Terhapus!", "Data anda telah terhapus", "success");
                    $(`#delete${id}`).submit();
                });

            });
        </script>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            // Tambahkan event listener untuk perubahan nilai dropdown
            $('#statusDropdown').on('change', function() {
            var selectedValue = $(this).val(); // Ambil nilai yang dipilih

            // Kirim permintaan AJAX ke server
            $.ajax({
                url: '/update-data', // Ubah URL sesuai dengan endpoint yang sesuai di server
                method: 'POST', // Ubah metode HTTP sesuai kebutuhan Anda
                data: { status: selectedValue }, // Kirim data pilihan dropdown
                success: function(response) {
                // Perbarui konten dinamis di halaman dengan data yang diterima dari server
                $('#dynamicContent').html(response);
                },
                error: function(error) {
                console.log(error);
                }
            });
            });
        });
        </script>

        <script>
        function confirmDeactivate(id) {
            if (confirm('Apakah Anda ingin menonaktifkan akun?')) {
            updateStatus(id, 'inactive');
            }
        }

        function confirmActivate(id) {
            if (confirm('Apakah Anda ingin mengaktifkan akun?')) {
            updateStatus(id, 'active');
            }
        }

        function updateStatus(id, status) {
            // Kirim request AJAX ke endpoint update status dengan menggunakan id dan status
            // Setelah berhasil, perbarui tampilan tombol dengan mengganti teks dan kelas CSS
        }
        </script>
        
        <!-- lightbox -->
        <script src="../dist/js/lightbox-plus-jquery.min.js"></script>

        <script>
            // Ambil elemen gambar dengan kelas "image-modal"
            const images = document.querySelectorAll('.image-modal');

            // Tambahkan event listener untuk setiap gambar
            images.forEach(image => {
                image.addEventListener('click', () => {
                    const imageUrl = image.getAttribute('data-image');
                    const modal = document.getElementById('add-user-modal');
                    const modalImage = document.createElement('img');
                    modalImage.src = imageUrl;
                    modalImage.alt = 'Gambar Pengaduan';
                    modalImage.classList.add('mb-4');
                    modalImage.style.width = '100%';
                    
                    // Hapus konten modal sebelumnya (jika ada)
                    while (modal.firstChild) {
                        modal.firstChild.remove();
                    }
                    
                    // Tambahkan gambar ke dalam modal
                    modal.appendChild(modalImage);
                    
                    // Tampilkan modal
                    modal.classList.remove('hidden');
                });
            });

            // Tambahkan event listener untuk tombol close modal
            const closeButton = document.querySelector('[data-modal-hide="add-user-modal"]');
            closeButton.addEventListener('click', () => {
                const modal = document.getElementById('add-user-modal');
                modal.classList.add('hidden');
            });
        </script>

        <script>
            // Initialization for ES Users
            import {
            Carousel,
            initTE,
            } from "tw-elements";

            initTE({ Carousel });
        </script>



    <!-- jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- socket.io-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.2/socket.io.min.js" integrity="sha512-mUWPbwx6PZatai4i3+gevCw6LeuQxcMgnJs/DZij22MZ4JMpqKaEvMq0N9TTArSWEb5sdQ9xH68HMUc30eNPEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>
</html>
