<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WhatsApp') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div>
                        Anda Sudah Terhubung WhatsApp
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

    <!-- jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- socket.io-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.2/socket.io.min.js" integrity="sha512-mUWPbwx6PZatai4i3+gevCw6LeuQxcMgnJs/DZij22MZ4JMpqKaEvMq0N9TTArSWEb5sdQ9xH68HMUc30eNPEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
