@extends('admin.layout')
@section('content')
    <div class="flex flex-col w-full h-full rounded-lg shadow-xl items-center justify-center mb-8 py-8">
        <h1 class="text-center uppercase font-bold text-3xl mb-5">Select Schedules</h1>
        <div class="">
            <div class="grid md:grid-cols-3 gap-2 mx-5">
                <div class="grid grid-cols-3 h-full">
                    <div class="p-3 w-full h-full">
                        <div class="rounded-lg w-full h-full bg-red-500"> </div>
                    </div>
                    <div class="p-3 col-span-2 w-full h-full text-lg font-bold flex justify-start items-center">
                        <div class="my-auto">
                            Tidak Bisa
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 h-full">
                    <div class="p-3 w-full h-full">
                        <div class="rounded-lg w-full h-full bg-green-500"> </div>
                    </div>
                    <div class="p-3 col-span-2 w-full h-full text-lg font-bold flex justify-start items-center">
                        <div class="my-auto">
                            Bisa
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 h-full">
                    <div class="p-3 w-full h-full">
                        <div class="rounded-lg w-full h-full bg-black"> </div>
                    </div>
                    <div class="p-3 col-span-2 w-full h-full text-lg font-bold flex justify-start items-center">
                        <div class="my-auto">
                            Ada Interview
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-4 w-full h-full">
        @php
            $jad = 1;
        @endphp
        @foreach ($dates as $date)
            <div class="w-full h-full rounded-lg shadow-xl items-center justify-center p-8">
                <div class="py-4 text-center font-bold font-serif bg-gray-100 ring-2 ring-black rounded-sm shadow-lg hover:shadow-2xl z-10 mb-1 jadwal"
                    id="jadwal-{{ $jad }}">
                    {{ $date['day'] }} ({{ $date['date'] }})
                </div>
                <div class="hidden" id="jamJadwal-{{ $jad }}">
                    <div class="grid-cols-2 grid bg-gray-50">
                        @for ($i = 0; $i < 7; $i++)
                            <div class="mt-0.5 rounded-sm grid grid-cols-3">
                                <div class="col-span-2 py-3 text-center">
                                    @php
                                        $time = 7 + $i;
                                        $str = $time < 10 ? '0' . str($time) . ':30' : str($time) . ':30';
                                        $str .=
                                            $time + 1 < 10
                                                ? ' - 0' . str($time + 1) . ':30'
                                                : ' - ' . ($time + 1) . ':30';
                                        echo $str;
                                        $stat = 0;
                                    @endphp
                                </div>
                                @foreach ($date['schedules'] as $schedule)
                                    @if ($schedule['time'] == $time)
                                        @php
                                            $stat = $schedule['status'];
                                            $online = $schedule['online'];
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($stat == 1)
                                    @if ($online == 1)
                                        <div class="cursor-pointer hover:bg-yellow-500 transition duration-200 ease-in-out bg-yellow-500 time"
                                            id="time:{{ $date['id'] }}:{{ $time }}:1:1"></div>
                                    @else
                                        <div class="cursor-pointer hover:bg-yellow-500 transition duration-200 ease-in-out bg-green-500 time"
                                            id="time:{{ $date['id'] }}:{{ $time }}:1:0"></div>
                                    @endif
                                @elseif($stat == 2)
                                    <div class="bg-black time"
                                        id="time:{{ $date['id'] }}:{{ $time }}:2"></div>
                                @else
                                    <div class="cursor-pointer hover:bg-yellow-500 transition duration-200 ease-in-out bg-red-500 time"
                                        id="time:{{ $date['id'] }}:{{ $time }}:0"></div>
                                @endif
                            </div>
                            <div class="mt-0.5 rounded-sm grid grid-cols-3">
                                <div class="col-span-2 py-3 text-center">
                                    @php
                                        $time = 14 + $i;
                                        if ($time < 20) {
                                            echo str($time) . ':30 - ' . ($time + 1) . ':30';
                                        }
                                        $stat = 0;
                                    @endphp
                                </div>
                                @if ($time < 20)
                                    @foreach ($date['schedules'] as $schedule)
                                        @if ($schedule['time'] == $time)
                                            @php
                                                $stat = $schedule['status'];
                                                $online = $schedule['online'];
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($stat == 1)
                                        @if ($online == 1)
                                            <div class="cursor-pointer hover:bg-yellow-500 transition duration-200 ease-in-out bg-yellow-500 time"
                                                id="time:{{ $date['id'] }}:{{ $time }}:1:1"></div>
                                        @else
                                            <div class="cursor-pointer hover:bg-yellow-500 transition duration-200 ease-in-out bg-green-500 time"
                                                id="time:{{ $date['id'] }}:{{ $time }}:1:0"></div>
                                        @endif
                                    @elseif($stat == 2)
                                        <div class="bg-black time"
                                            id="time:{{ $date['id'] }}:{{ $time }}:2"></div>
                                    @else
                                        <div class="cursor-pointer hover:bg-yellow-500 transition duration-200 ease-in-out bg-red-500 time"
                                            id="time:{{ $date['id'] }}:{{ $time }}:0"></div>
                                    @endif
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            @php
                $jad++;
            @endphp
        @endforeach
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.jadwal', function() {
                let id = $(this).attr('id');
                let num = id.split('-')[1];
                $('#jamJadwal-' + num).slideToggle('slow');
            });
            $(document).on('click', '.time', async function() {
                let item = $(this);
                let id = $(this).attr('id');
                let date = id.split(':')[1];
                let time = id.split(':')[2];
                let status = id.split(':')[3];
                let statusBaru = 0;
                let online = 0;
                let data = {};
                // return;
                if (status != 2) {
                    if (status == 1) {
                        online = id.split(':')[4];
                        if (online == 0) {
                            await Swal.fire({
                                title: "Are you sure?",
                                showConfirmButton: false,
                                showDenyButton: true,
                                showCancelButton: true,
                                denyButtonText: "Deactivate",
                                denyButtonColor: "red",
                                cancelButtonColor: "gray",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    data = {
                                        "_token": "{{ csrf_token() }}",
                                        "date_id": date,
                                        "time": time,
                                        "status": status,
                                        "online": 1
                                    };
                                    online = 1;
                                    statusBaru = 1;
                                } else if (result.isDenied) {
                                    data = {
                                        "_token": "{{ csrf_token() }}",
                                        "date_id": date,
                                        "time": time,
                                        "status": 0,
                                        "online": 0
                                    };
                                    statusBaru = 0;
                                }
                            })
                        } else {
                            await Swal.fire({
                                title: "Are you sure?",
                                showConfirmButton: false,
                                showDenyButton: true,
                                showCancelButton: true,
                                denyButtonText: "Deactivate",
                                denyButtonColor: "red",
                                cancelButtonColor: "gray",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    data = {
                                        "_token": "{{ csrf_token() }}",
                                        "date_id": date,
                                        "time": time,
                                        "status": status,
                                        "online": 0
                                    };
                                    online = 0;
                                    statusBaru = 1;
                                } else if (result.isDenied) {
                                    data = {
                                        "_token": "{{ csrf_token() }}",
                                        "date_id": date,
                                        "time": time,
                                        "status": 0,
                                        "online": 1
                                    };
                                    statusBaru = 0;
                                }
                            })
                        }
                    } else {
                        await Swal.fire({
                            title: "Change for this ",
                            showDenyButton: false,
                            showCancelButton: true,
                            confirmButtonText: "Available",
                            confirmButtonColor: "#46C92C",
                            cancelButtonColor: "gray",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                data = {
                                    "_token": "{{ csrf_token() }}",
                                    "date_id": date,
                                    "time": time,
                                    "status": 1,
                                    "online": 0
                                };
                                online = 0;
                                statusBaru = 1;
                            } else if (result.isDenied) {
                                data = {
                                    "_token": "{{ csrf_token() }}",
                                    "date_id": date,
                                    "time": time,
                                    "status": 1,
                                    "online": 1
                                };
                                online = 1;
                                statusBaru = 1;
                            }
                        })
                    }
                    Swal.showLoading();
                    $.ajax({
                        url: "{{ route('admin.select.schedule.update') }}",
                        type: "PATCH",
                        data: data,
                        success: function(e) {
                            console.log(e)
                            Swal.hideLoading();
                            if (e.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: e.message,
                                    showConfirmButton: false,
                                    timer: 500
                                })
                                let idBaru = id.split(':')[0] + ':' + id.split(':')[1] +
                                    ':' + id.split(':')[2] + ':' + statusBaru + ":" +
                                    online;
                                // console.log(d, id, idBaru);
                                if (statusBaru == 1) {
                                    // console.log($("#time:" + date + ":" + time + ":" + status).attr('id'));
                                    item.removeClass('bg-red-500');
                                    item.removeClass('bg-yellow-500');
                                    item.removeClass('bg-green-500');
                                    if (online == 1) {
                                        item.addClass('bg-yellow-500');
                                    } else {
                                        item.addClass('bg-green-500');
                                    }
                                    item.attr('id', idBaru);
                                } else {
                                    // console.log($(this).attr('id'));
                                    item.removeClass('bg-yellow-500');
                                    item.removeClass('bg-green-500');
                                    item.addClass('bg-red-500');
                                    item.attr('id', idBaru);
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: e.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        }
                    });
                }
            })
        })
    </script>


@endsection
