<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CASE DETAIL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('userShow' , $user->id) }}" class="inline-flex gap-3 items-center hover:text-blue-700 transition-all">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 72 72"><path fill="#3F3F3F" d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z"/><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z"/></svg>
                        </div>
                        <div>
                            <span>
                                ย้อนกลับ
                            </span>
                        </div>
                    </a>
                    <div class="my-4"></div>

                    <div class="flex flex-wrap gap-5">
                        <div class="w-full basis-full md:w-1/4 md:basis-1/4">
                            <img class="w-full rounded-xl hover:rounded-md transition-all shadow-md" src="{{ $user->pictureUrl }}" onerror="this.src='https://via.placeholder.com/50x50'" alt="" loading="lazy" />
                        </div>
                        <div class="flex-1 w-auto p-3">
                            <div class="text-neutral-800 text-lg font-light">
                                <p>
                                    <strong class="font-medium">ชื่อไลน์ :</strong> {{ $user->displayName }}
                                </p>
                                <p>
                                    @php
                                        $position_text = [];
                                        $positions = $case->positions;
                                        $positions = explode(',', $positions);
                                        foreach ($positions as $position) {
                                            $position_text[] = $positions_text[$position];
                                        }
                                        $position_text = implode(', ', $position_text);
                                    @endphp
                                    <strong class="font-medium">ตำแหน่งที่ปวด :</strong> {{ $position_text }}
                                </p>
                                <p>
                                    <strong class="font-medium">ยาที่ได้รับ :</strong> {{ $case->meds }}
                                </p>
                            </div>
                            <div class="mb-5 text-lg">
                                <strong class="font-medium">สถานะ :</strong>
                                <span class="cursor-pointer uppercase inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $case->status }}
                                </span>
                            </div>

                            <div class="bg-white rounded-lg shadow-xl p-2 mb-5 md:max-w-[630px]">
                                <div id="chart"></div>
                            </div>

                            <h2 class="text-xl font-bold text-black">
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


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
