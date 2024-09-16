@extends('layouts.dashboard')
@section('content')
    <div class="p-2 overflow-hidden">
        <div class="flex gap-2 items-center">
            <div class="mb-5 ">
                <a href="{{ route('home') }}" class="text-xl font-bold text-white"> < </a>
            </div>
            <h1 class="dashboard-title">
                รายงานบันทึกผล
            </h1>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-2 mb-5">
            <div id="chart"></div>
        </div>

        <h2 class="text-xl font-bold text-white">
            ประวัติการทานยา
        </h2>

        <div class="space-y-3 mb-5">

            <div class="p-3 bg-white rounded-lg shadow flex justify-between gap-3">
                <div class="flex gap-3 items-center">
                    <div>
                        <img src="{{ asset('images/img-med.png') }}" alt="" class="w-12 h-12" loading="lazy">
                    </div>
                    <div>
                        <p class="text-sm md:text-base font-medium">
                            Ecoxib
                        </p>
                    </div>
                </div>
                <div>
                    <div class="bg-primary text-white aspect-square h-16 w-16 rounded-xl flex flex-col justify-center items-center">
                        <p class="text-lg">10</p>
                        <p class="text-sm">Jan</p>
                    </div>
                </div>
            </div>

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
                data: [5,3,5,4,2,1]
            }],
            xaxis: {
                categories: [
                    'วันที่ 1',
                    'วันที่ 2',
                    'วันที่ 3',
                    'วันที่ 4',
                    'วันที่ 5',
                    'วันที่ X',
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
