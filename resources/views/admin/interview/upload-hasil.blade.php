@extends('admin.layout')

@section('content')
    <div class="flex w-full h-24 rounded-lg shadow-xl items-center justify-center mb-8">
        <h1 class="text-center uppercase font-bold text-3xl">Upload Hasil Interview</h1>
    </div>
    <div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-8">
        <div class="px-4">
            {{-- upload hasil interview --}}
        <div class="mb-4">
            <label for="formFileMultiple" class="mb-2 inline-block text-neutral-700 dark:text-neutral-200">
            </label>
                <form class="grid sm:grid-cols-5 sm:gap-4 grid-cols-3 gap-2"
                    action="{{ route('admin.interview.store', [$applicant->id]) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <input
                        class="relative m-0 block sm:col-span-4 col-span-2 min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary disabled:opacity-60"
                        type="file" name="{{ strtolower($type) }}" @if ($applicant['documents'] && array_key_exists(strtolower($type), $applicant['documents'])) disabled @endif
                        accept=".PDF" />
                    <button type="submit" data-te-ripple-init data-te-ripple-color="light"
                        class="inline-block rounded bg-[#e59980] sm:px-6 px-2.5 pb-1.5 pt-1.5 sm:text-sm text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-[#ba7d68] focus:bg-[#ba7d68] focus:outline-none focus:ring-0 active:bg-primary-700 disabled:opacity-70 disabled:pointer-events-none"
                        @if ($applicant['documents'] && array_key_exists(strtolower($type), $applicant['documents'])) disabled @endif>
                        UPLOAD
                    </button>
                </form>
            <div
                class="h-1 w-full bg-neutral-200 dark:bg-neutral-600 my-1 {{ $applicant['documents'] && array_key_exists(strtolower($type), $applicant['documents']) ? '' : 'hidden' }} progress-bar">
                <div class="h-1 bg-primary"
                    {{ $applicant['documents'] && array_key_exists(strtolower($type), $applicant['documents']) ? '' : 'style="width: 100%"' }}>
                </div>
            </div>
            <div class="preview mt-2">
            </div>
        </div>

        {{-- text comment --}}
        <div class="w-full">
            <form action="{{ route('admin.interview.comment', [$applicant->id]) }}" method="post">
                @csrf
                <label for="comment" class="block text-neutral-700 dark:text-neutral-200 mb-2">Komentar</label>
                <textarea id="comment" name="comment"
                        class="w-full h-24 p-2 border border-neutral-300 rounded-md focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200 dark:focus:border-primary"
                        placeholder="Tambahkan komentar atau catatan di sini...">{{ $applicant->comment }}</textarea>
    
                <div class="mt-4">
                    <button type="submit" data-te-ripple-init data-te-ripple-color="light"
                        class="w-full inline-block rounded bg-[#e59980] sm:px-6 px-2.5 pb-1.5 pt-1.5 sm:text-sm text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-[#ba7d68] focus:bg-[#ba7d68] focus:outline-none focus:ring-0 active:bg-primary-700 disabled:opacity-70 disabled:pointer-events-none">
                        SIMPAN
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
    @if(isset($fileSrc))
        <embed src="{{ $fileSrc }}" type="application/pdf" width="100%" height="500px">
    @endif

    

@endsection


@section('script')
<script>
    @if (Session::has('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ Session::get('success') }}',
        showConfirmButton: false,
        timer: 1700
    });
    @endif

    @if (Session::has('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ Session::get('error') }}',
        showConfirmButton: false,
        timer: 1700
    });
    @endif
</script>

@endsection