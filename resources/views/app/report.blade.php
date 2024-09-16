@extends('layouts.dashboard')
@section('content')
    <div class="p-2 overflow-hidden">
        <a href="{{ route('home') }}" class="flex gap-2 items-center">
            <div class="mb-5 ">
                {{-- <span class="text-xl font-bold text-white"> < </span> --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 72 72"><path fill="#FFFFFF" d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z"/><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z"/></svg>
            </div>
            <h1 class="dashboard-title">
                รายงานบันทึกผล
            </h1>
            <div class="mb-5">
                <span class="cursor-pointer uppercase inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $case->status }}
                </span>
            </div>
        </a>

        <div class="bg-white rounded-lg shadow-xl p-2 mb-5">
            <div id="chart"></div>
        </div>

        <h2 class="text-xl font-bold text-white">
            ประวัติการทานยา
        </h2>

        <div class="space-y-3 mb-5">
            @forelse ($records as $record)


            <div class="p-3 bg-white rounded-lg shadow flex justify-between gap-3">
                <div class="flex gap-3 items-center">
                    <div>
                        <img src="{{ asset('images/img-med.png') }}" alt="" class="w-12 h-12" loading="lazy">
                    </div>
                    <div>
                        <p class="text-sm md:text-base font-medium">
                            {{ $record->meds }}
                        </p>
                        <p class="text-[.7rem] md:text-sm font-light">
                            ความปวด : <span class="font-medium text-black text-lg">{{ $record->level }}</span>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="bg-primary text-white aspect-square h-16 w-16 rounded-xl flex flex-col justify-center items-center">
                        <p class="text-lg">{{ \Carbon\Carbon::parse($record->date)->format('d') }}</p>
                        <p class="text-sm">{{ \Carbon\Carbon::parse($record->date)->format('M') }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-white font-medium text-xl pt-4 drop-shadow-md">ไม่มีข้อมูลการทานยา</p>
            @endforelse

        </div>


        <div class="flex justify-center gap-x-4">
            <a href="{{ route('home') }}"
            class="w-full py-3 text-primary bg-white hover:bg-gray-50 font-medium rounded-lg text-lg px-5 shadow hover:shadow-lg flex justify-center">ตกลง</a>
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
