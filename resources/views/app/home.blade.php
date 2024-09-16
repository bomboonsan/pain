@extends('layouts.dashboard')
@section('content')
    <div class="p-2 overflow-hidden">
        <div class="flex justify-between items-center">
            <div>
                <div class="flex gap-3 items-center">
                    <div class="mb-5">
                        <img class="w-16 h-16 rounded-full border border-[#446b64] shadow-lg" src="{{ $user->pictureUrl }}" onerror="this.src='https://via.placeholder.com/50x50'" alt="" />
                    </div>
                    <h1 class="dashboard-title">
                        {{-- Home --}}
                        {{ $user->displayName }}
                    </h1>
                </div>
            </div>
            <div class=" mb-5">
                <a href="{{ route('logout')}}" class="bg-red-500 hover:bg-red-700 text-white text-sm py-1 px-4 rounded-xl"> Log out</a>
            </div>
        </div>

        @if($case_inprogress_id)
        <div class="grid grid-cols-2 gap-5 mb-5">

            <a href="{{ route('record') }}" class="bg-white rounded-lg p-2 md:py-8 flex justify-between items-center hover:shadow-md transition-all">
                <div class="text-back font-medium text-sm md:text-lg flex-1 text-center">
                    บันทึกการทานยา
                </div>
                <div class=" flex-1 text-center">
                    <img class="inline-block w-8 md:w-14" src="{{ asset('images/icon-med.png') }}" alt="" loading="lazy">
                </div>
            </a>
            <div class="bg-white rounded-lg p-2 md:py-8 flex justify-between items-center  hover:shadow-md transition-all"  aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-slide-up-animation-modal" data-hs-overlay="#hs-slide-up-animation-modal">
                <div class="text-back font-medium text-sm md:text-lg flex-1 text-center">
                    หายแล้ว
                </div>
                <div class=" flex-1 text-center">
                    <img class="inline-block w-8 md:w-14" src="{{ asset('images/icon-smile.png') }}" alt="" loading="lazy">
                </div>
            </div>

        </div>
        @else
        <div class="grid grid-cols-2 gap-5 mb-5">

            <a href="{{ route('newPain') }}" class="bg-white rounded-lg p-2 md:py-8 flex justify-between items-center hover:shadow-md transition-all">
                <div class="text-back font-medium text-sm md:text-lg flex-1 text-center">
                    เริ่มบันทึกใหม่
                </div>
                <div class=" flex-1 text-center">
                    <img class="inline-block w-8 md:w-14" src="{{ asset('images/icon-med.png') }}" alt="" loading="lazy">
                </div>
            </a>

        </div>
        @endif

        <div class="bg-white rounded-lg shadow-xl p-2 mb-5">
            <div id="chart"></div>
        </div>

        <div class="space-y-3">

            @forelse  ($cases as $case)
            @php
                $position_text = [];
                $positions = $case->positions;
                $positions = explode(',', $positions);
                foreach ($positions as $position) {
                    $position_text[] = $postions_text[$position];
                }
                $position_text = implode(', ', $position_text);
            @endphp
                <x-app.card-report :positions="$position_text" :meds="$case->meds" :createdAt="$case->created_at->format('d M Y')" :id="$case->id" />
            @empty
                <p class="text-center text-white font-medium text-xl pt-4 drop-shadow-md">ไม่มีข้อมูลการทานยา</p>
            @endforelse


        </div>

    </div>



    <div id="hs-slide-up-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-slide-up-animation-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-14 opacity-0 ease-out transition-all sm:max-w-md sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">

                <div class="p-4 md:px-10 md:py-10 overflow-y-auto text-center">
                    <img src="{{ asset('images/icon-smile-full.png') }}" alt="" class="w-24 h-auto mx-auto mb-5">
                    <p class="mt-1 text-lg font-semibold">
                        คุณได้หายจากการปวดแล้ว?
                    </p>
                    <p class="mb-5">
                        หากคุณหายจากอาการปวดแล้ว <br/>
                        กรุณากดยืนยัน เมื่อกดยืนยันแล้ว ไม่สามารถแก้ไขได้
                    </p>
                    <div class="flex gap-3 justify-center">
                        <button type="button" class="shadow bg-[#f6f6f6] text-primary inline-flex py-2 px-1 justify-center items-center gap-2 rounded-lg w-32" data-hs-overlay="#hs-slide-up-animation-modal">ยกเลิก</button>
                        @if($case_inprogress_id)
                        <form action="{{ route('finishCase', $case_inprogress_id) }}" method="post">
                            @csrf
                            <button type="submit" class="shadow bg-primary text-white inline-flex py-2 px-1 justify-center items-center gap-2 rounded-lg w-32">ยืนยัน</button>
                        </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'line',
                fontFamily: 'Kanit'
            },
            stroke: {
                curve: 'smooth',
                colors: ['#aed0ca']
            },
            title: {
                text: 'ระดับความปวด',
                align: 'left',
                style: {
                    fontSize:  '18px',
                    fontWeight:  'bold',
                    color:  '#3E3E3E'
                },
            },
            series: [{
                name: 'ความปวด',
                data: [
                    // 5,3,5,4,2,1
                    @forelse ($records as $record)
                    {{ $record->level }},
                    @empty
                    @endforelse
                ]
            }],
            xaxis: {
                categories: [
                    @forelse ($records as $record)
                    '{{ \Carbon\Carbon::parse($record->date)->format('d M') }}',
                    @empty
                    @endforelse
                ]
            },
            yaxis: {
                min: 0,
                max: 10
            },
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endsection
