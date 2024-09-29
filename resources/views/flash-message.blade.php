@if ($message = Session::get('success'))
<div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
    <div class="flex items-center justify-between">
        <strong>{{ $message }}</strong>
        <button type="button" class="text-white" onclick="this.parentElement.parentElement.remove()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm0-5a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
    <div class="flex items-center justify-between">
        <strong>{{ $message }}</strong>
        <button type="button" class="text-white" onclick="this.parentElement.parentElement.remove()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm0-5a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="bg-yellow-500 text-white px-4 py-2 rounded-md mb-4">
    <div class="flex items-center justify-between">
        <strong>{{ $message }}</strong>
        <button type="button" class="text-white" onclick="this.parentElement.parentElement.remove()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm0-5a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('info'))
<div class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">
    <div class="flex items-center justify-between">
        <strong>{{ $message }}</strong>
        <button type="button" class="text-white" onclick="this.parentElement.parentElement.remove()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm0-5a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
    <div class="flex items-center justify-between">
        <strong>Mohon periksa kembali data yang anda masukan</strong>
        <button type="button" class="text-white" onclick="this.parentElement.parentElement.remove()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm0-5a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
@endif
