@extends('admin.layout')
@section('content')
    <div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-10">
        <h1 class="text-center text-4xl uppercase font-bold">Detail Pendaftar</h1>
    </div>
    <div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-10 px-8">
        <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
        <h1 class="text-center text-2xl uppercase font-bold italic mb-3">Personal Data</h1>
        <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
        <div class="w-full px-8">
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">name : </b>{{ $applicant->name }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">nrp :
                </b>{{ substr($applicant->email, 0, 9) }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">major : </b>{{ $applicant->major->name }}
            </h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">gpa : </b>{{ $applicant->gpa }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">gender :
                </b>{{ $applicant->gender == 0 ? 'Male' : 'Female' }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">birth place :
                </b>{{ $applicant->birth_place }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">birth date :
                </b>{{ $applicant->birth_date }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">religion : </b>{{ $applicant->religion }}
            </h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">address : </b>{{ $applicant->address }}
            </h1>
        </div>
        <br>
        <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
        <h1 class="text-center text-2xl uppercase font-bold italic mb-3">Contact Data</h1>
        <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
        <div class="w-full px-8">
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">email : </b>{{ $applicant->email }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">phone : </b>{{ $applicant->phone }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">line : </b>{{ $applicant->line }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">instagram :
                </b>{{ $applicant->instagram }}</h1>
            @if (isset($applicant->tiktok))
                <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">tiktok :
                    </b>{{ $applicant->tiktok }}</h1>
            @endif
        </div>
        <br>
        <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
        <h1 class="text-center text-2xl uppercase font-bold italic mb-3">Application Data</h1>
        <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
        <div class="w-full px-8">
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">Motivation :
                </b>{{ $applicant->motivation }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">strength :
                </b>{{ $applicant->strength }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">weakness :
                </b>{{ $applicant->weakness }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">commitment :
                </b>{{ $applicant->commitment }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">Experience :
                </b>{{ $applicant->experience }}</h1>
            <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">First Department :
                </b>{{ $applicant->priorityDepartment1['name'] }}</h1>
            @isset($applicant->priorityDepartment2)
                <h1 class="uppercase text-lg mb-3"><b class="text-xl font-bold italic">Second Department :
                    </b>{{ $applicant->priorityDepartment2['name'] }}</h1>
            @endisset
        </div>
        @foreach ($documentTypes as $type => $label)
            @php
                $fileSrc = '';
                $fileExt = '';
                if ($applicant['documents'] && array_key_exists(strtolower($type), $applicant['documents'])) {
                    $fileSrc = route('upload', [
                        'path' => strtolower($type) . '/' . data_get($applicant['documents'], strtolower($type)),
                    ]);
                    $fileExt = pathinfo($fileSrc, PATHINFO_EXTENSION);
                }
            @endphp
            <br>
            <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>
            <h1 class="text-center text-2xl uppercase font-bold italic mb-3">{{ $label }} File <a
                    href="{{ $fileSrc }}" target="_blank" class="text-blue-600 italic text-md"> >Open file< </a>
            </h1>
            <div class="h-1 w-full bg-gradient-to-r from-gray-100 via-gray-400 to-gray-100 bg-repeat mb-4"></div>

            @if (in_array($fileExt, ['jpg', 'jpeg', 'png']))
                <img src="{{ $fileSrc }}" alt="{{ $label }}" class="max-h-[400px] max-w mb-5"
                    style="max-width: 100%">
            @elseif($fileExt == 'pdf')
                <embed src="{{ $fileSrc }}" type="application/pdf" width="100%" height="500px">
                <br><br>
            @endif
        @endforeach
    </div>
@endsection
