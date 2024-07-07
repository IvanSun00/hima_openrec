@extends('main.layout')

@section('styles')
    <style>
        div[data-te-select-options-list-ref] div[data-te-select-option-ref]>span {
            max-width: 97%;
            overflow: hidden;
            word-wrap: normal;
            white-space: normal;
        }

        div[data-te-select-option-ref] {
            height: auto !important;
            min-height: 38px;
            padding-block: 7px;
        }
    </style>
@endsection

@section('content')
    @include('main.stepper', ['applicant' => $form])

    {{-- @php
        echo '<pre>';
        print_r($errors);
        if(isset($msg)) print_r($msg);
        echo '</pre>';
    @endphp --}}

    <h1 class="text-3xl font-bold text-center text-white">Biodata Pendaftar</h1>
    <section class="max-w-[940px] mx-auto pt-3 pb-16">
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
        <div
            class="block rounded-xl bg-white/10 backdrop-blur-md p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
            <form data-te-validation-init
                action="{{ !array_key_exists('id', $form) ? route('applicant.application.store') : route('applicant.application.update') }}"
                method="POST" id="application-form">
                @csrf
                @if (array_key_exists('id', $form))
                    @method('PATCH')
                @endif

                <div class="grid sm:grid-cols-2 sm:gap-4">
                    {{-- {{ array_key_exists('name', $form) }} --}}
                    <div class="relative mb-8" data-te-validate="input"
                        @error('name') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('name') ?? ($form['name'] ?? '') }}"
                            {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                            {{ empty(old('name')) && !array_key_exists('name', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput123" aria-describedby="emailHelp123" placeholder="Nama Lengkap"
                            name="name" />
                        <label for="emailHelp123"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            Nama Lengkap
                        </label>
                        <small data-te-invalid-feedback></small>
                    </div>

                    <div class="relative mb-8" data-te-validate="input"
                        @error('email') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('email') ?? ($form['email'] ?? '') }}"
                            {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                            {{ empty(old('email')) && !array_key_exists('email', $form) ? '' : 'data-te-input-state-active readonly' }}
                            class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 !disabled:bg-white/50"
                            id="exampleInput124" aria-describedby="emailHelp124" placeholder="Email" name="email" />
                        <label for="exampleInput124"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            Email
                        </label>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 sm:gap-4">
                    <div class="relative mb-8" data-te-validate="input"
                        @error('major_id') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror>
                        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                        <select data-te-select-init name="major_id" {{ array_key_exists('id', $form) ? 'disabled' : '' }}>
                            <option value="" selected disabled hidden></option>
                            @foreach ($majors as $major)
                                <option
                                    {{ old('major_id') === $major->id || data_get($form, 'major_id', '-1') === $major->id ? 'selected' : '' }}
                                    value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Jurusan</label>
                    </div>
                    <div class="relative mb-8" data-te-validate="input"
                        @error('gpa') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('gpa') ?? ($form['gpa'] ?? '') }}"
                            {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                            {{ empty(old('gpa')) && !array_key_exists('gpa', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput126" placeholder="IPK Terakhir" name="gpa" />
                        <label for="exampleInput126"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">
                            IPK Terakhir (ex: 3.80)
                        </label>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 sm:gap-4">
                    <div class="relative mb-8" data-te-validate="input"
                        @error('gender') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror>
                        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                        <select data-te-select-init name="gender">
                            <option value="" selected disabled hidden></option>
                            <option value="0"
                                {{ old('gender') === '0' || data_get($form, 'gender', '-1') == 0 ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="1"
                                {{ old('gender') === '1' || data_get($form, 'gender', '-1') == 1 ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        <label data-te-select-label-ref>Jenis Kelamin</label>
                    </div>

                    <div class="relative mb-8" data-te-validate="input"
                        @error('religion') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror>
                        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                        <select data-te-select-init name="religion">
                            <option value="" selected disabled hidden></option>
                            @foreach ($religions as $religion)
                                <option value="{{ $religion }}"
                                    {{ old('religion') == $religion || data_get($form, 'religion', '-1') === $religion ? 'selected' : '' }}>
                                    {{ $religion }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Agama</label>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 sm:gap-4">
                    <div class="relative mb-8" data-te-validate="input"
                        @error('birth_place') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('birth_place') ?? ($form['birth_place'] ?? '') }}"
                            {{ empty(old('birth_place')) && !array_key_exists('birth_place', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput123" aria-describedby="emailHelp123" placeholder="Tempat Lahir"
                            name="birth_place" />
                        <label for="emailHelp123"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            Tempat Lahir
                        </label>
                    </div>

                    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                    <div class="relative mb-8" data-te-validate="input"
                        @error('birth_date') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-datepicker-init data-te-input-wrapper-init data-te-format="yyyy-mm-dd">
                        <input type="text" value="{{ old('birth_date') ?? ($form['birth_date'] ?? '') }}"
                            {{ empty(old('birth_date')) && !array_key_exists('birth_date', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            placeholder="Tanggal Lahir" name="birth_date" />
                        <label for="floatingInput"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            Tanggal Lahir (yyyy-mm-dd)
                        </label>
                    </div>
                </div>

                <div class="relative mb-8" data-te-validate="input"
                    @error('address') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                    data-te-input-wrapper-init>
                    <input type="text" value="{{ old('address') ?? ($form['address'] ?? '') }}"
                        {{ empty(old('address')) && !array_key_exists('address', $form) ? '' : 'data-te-input-state-active' }}
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleInput125" placeholder="Alamat" name="address" />
                    <label for="exampleInput125"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200">
                        Alamat (domisili saat ini)
                    </label>
                </div>

                <div class="grid sm:grid-cols-2 sm:gap-4">
                    <div class="relative mb-8" data-te-validate="input"
                        @error('phone') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('phone') ?? ($form['phone'] ?? '') }}"
                            {{ empty(old('phone')) && !array_key_exists('phone', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput123" aria-describedby="emailHelp123" placeholder="No HP" name="phone" />
                        <label for="emailHelp123"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            No HP
                        </label>
                    </div>

                    <div class="relative mb-8" data-te-validate="input"
                        @error('line') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('line') ?? ($form['line'] ?? '') }}"
                            {{ empty(old('line')) && !array_key_exists('line', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput123" aria-describedby="emailHelp123" placeholder="ID Line" name="line" />
                        <label for="emailHelp123"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            ID Line
                        </label>
                    </div>

                </div>

                <div class="grid sm:grid-cols-2 sm:gap-4">
                 
                    <div class="relative mb-8" data-te-validate="input"
                        @error('instagram') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('instagram') ?? ($form['instagram'] ?? '') }}"
                            {{ empty(old('instagram')) && !array_key_exists('instagram', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput123" aria-describedby="emailHelp123" placeholder="Instagram"
                            name="instagram" />
                        <label for="emailHelp123"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            Instagram
                        </label>
                    </div>

                    <div class="relative mb-8" data-te-validate="input"
                        @error('tiktok') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                        data-te-input-wrapper-init>
                        <input type="text" value="{{ old('tiktok') ?? ($form['tiktok'] ?? '') }}"
                            {{ empty(old('tiktok')) && !array_key_exists('tiktok', $form) ? '' : 'data-te-input-state-active' }}
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="exampleInput123" aria-describedby="emailHelp123" placeholder="TikTok" name="tiktok" />
                        <label for="emailHelp123"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                            TikTok
                        </label>
                    </div>
                </div>

                <div class="relative mb-8" data-te-validate="input"
                    @error('motivation') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                    data-te-input-wrapper-init>
                    <textarea {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                        {{ empty(old('motivation')) && !array_key_exists('motivation', $form) ? '' : 'data-te-input-state-active' }}
                        class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleFormControlTextarea13" rows="2" placeholder="Motivasi" name="motivation">{{ old('motivation') ?? ($form['motivation'] ?? '') }}</textarea>
                    <label for="exampleFormControlTextarea13"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                        Motivasi
                    </label>
                </div>

                <div class="relative mb-8" data-te-validate="input"
                    @error('commitment') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                    data-te-input-wrapper-init>
                    <textarea {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                        {{ empty(old('commitment')) && !array_key_exists('commitment', $form) ? '' : 'data-te-input-state-active' }}
                        class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleFormControlTextarea13" rows="2" placeholder="Komitmen" name="commitment">{{ old('commitment') ?? ($form['commitment'] ?? '') }}</textarea>
                    <label for="exampleFormControlTextarea13"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                        Komitmen
                    </label>
                </div>

                <div class="relative mb-8" data-te-validate="input"
                    @error('strength') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                    data-te-input-wrapper-init>
                    <textarea {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                        {{ empty(old('strength')) && !array_key_exists('strength', $form) ? '' : 'data-te-input-state-active' }}
                        class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleFormControlTextarea13" rows="2" placeholder="Kelebihan" name="strength">{{ old('strength') ?? ($form['strength'] ?? '') }}</textarea>
                    <label for="exampleFormControlTextarea13"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                        Kelebihan
                    </label>
                </div>

                <div class="relative mb-8" data-te-validate="input"
                    @error('weakness') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                    data-te-input-wrapper-init>
                    <textarea {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                        {{ empty(old('weakness')) && !array_key_exists('weakness', $form) ? '' : 'data-te-input-state-active' }}
                        class="peer block min-h-[auto] w-full rounded border-0 {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleFormControlTextarea13" rows="2" placeholder="Kekurangan" name="weakness">{{ old('weakness') ?? ($form['weakness'] ?? '') }}</textarea>
                    <label for="exampleFormControlTextarea13"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                        Kekurangan
                    </label>
                </div>

                <div class="relative mb-8" data-te-validate="input"
                    @error('experience') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror
                    data-te-input-wrapper-init>
                    <textarea {{ array_key_exists('id', $form) ? 'disabled' : '' }}
                        {{ empty(old('experience')) && !array_key_exists('experience', $form) ? '' : 'data-te-input-state-active' }}
                        class="peer {{ array_key_exists('id', $form) ? 'bg-gray-200' : 'bg-transparent' }} block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleFormControlTextarea13" rows="2" placeholder="Pengalaman" name="experience">{{ old('experience') ?? ($form['experience'] ?? '') }}</textarea>
                    <label for="exampleFormControlTextarea13"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                        Pengalaman Organisasi/Panitia
                    </label>
                </div>


                <div class="grid sm:grid-cols-2 sm:gap-4">
                    <div class="relative mb-8" data-te-validate="input"
                        @error('priority_department1') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror>
                        <select
                            {{ array_key_exists('id', $form) ? 'disabled' : '' }} data-te-select-init
                            id="priority-department1" name="priority_department1">
                            <option value="" selected hidden >-</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department['id'] }}" 
                                    {{ old('priority_department1') === $department['id'] || data_get($form, 'priority_department1', '-1') === $department['id'] ? 'selected' : '' }}>
                                    {{ $department['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Department Prioritas 1</label>
                    </div>

                    <div class="relative mb-8" data-te-validate="input"
                        @error('priority_department2') data-te-validation-state="invalid" data-te-invalid-feedback="{{ $message }}" @enderror>
                        <select 
                            {{ array_key_exists('id', $form) ? 'disabled' : '' }} data-te-select-init
                            id="priority-department2" name="priority_department2" readonly>
                            {{-- <option value="" hidden></option> --}}
                            <option value="" selected>-</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department['id'] }}"
                                    {{ old('priority_department2') === $department['id'] || data_get($form, 'priority_department2', '-1') === $department['id'] ? 'selected' : '' }}>
                                    {{ $department['name'] }}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Department Prioritas 2</label>
                    </div>
                </div>

                @if (!array_key_exists('id', $form))
                    <div class="px-3 mb-8 text-white">
                        <p style="font-size: 110%;"><span class="text-red-400">Perhatian!</span><br />Pilihan  <span class="text-red-400">Department</span> hanya dapat
                            dipilih <span class="text-red-400">satu kali</span> dan <span class="text-red-400">tidak dapat
                                diubah</span> setelah submit!</p>
                    </div>
                @endif

                <!--Submit button-->
                <button type="submit"
                    class="inline-block w-full rounded bg-[#e59980] px-6 pb-2 pt-2 mt-2 text-md font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-[#ba7d68] focus:bg-[#ba7d68]  focus:outline-none focus:ring-0 active:bg-primary-700"
                    data-te-ripple-init data-te-ripple-color="light">
                    {{ !array_key_exists('id', $form) ? 'SUBMIT' : 'UPDATE' }}
                </button>
            </form>
        </div>
    </section>
@endsection



@section('scripts')
    <script>
        $(document).ready(() => {
            $('form[data-te-validation-init]').attr('data-te-validated', true);
            $('input[data-te-input-state-active] ~ div').attr('data-te-input-state-active', true);
            $('textarea[data-te-input-state-active] ~ div').attr('data-te-input-state-active', true);

            $('#application-form').submit(function(e) {
                e.preventDefault();
                $('#priority-department1').attr('disabled', false);
                $('#priority-department2').attr('disabled', false);
                $(this).unbind('submit').submit();
            });

            // flash message
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ Session::get('success') }}',
                    didClose: () => {
                        window.location.href = '{{ route('applicant.documents-form') }}';
                    }
                });
            @endif

            @if (Session::has('success_update'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ Session::get('success_update') }}',
                });
            @endif
            @if (Session::has('previous_stage_not_completed'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ Session::get('previous_stage_not_completed') }}',
                });
            @endif
        });
    </script>
@endsection
