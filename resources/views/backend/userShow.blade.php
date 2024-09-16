<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('USER DETAIL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('dashboard') }}" class="inline-flex gap-3 items-center hover:text-blue-700 transition-all">
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
                                    <strong class="font-medium">ลงทะเบียนเมื่อ :</strong> {{ $user->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            @if($cases->count() > 0)
                            <div class="mt-3"></div>
                            <h2 class="text-2xl font-bold">บันทึกอาการปวด</h2>
                            @endif
                            <div class="space-y-3">
                            @forelse  ($cases as $case)
                            @php
                                $position_text = [];
                                $positions = $case->positions;
                                $positions = explode(',', $positions);
                                foreach ($positions as $position) {
                                    $position_text[] = $positions_text[$position];
                                }
                                $position_text = implode(', ', $position_text);
                            @endphp
                                <div class="border border-neutral-400/20 shadow hover:shadow-md p-3 px-5 rounded-xl transition-all">
                                    <a href="{{ route('caseShow', $case->id) }}" class="flex justify-between items-center">
                                        <div class="flex-1">
                                            <div class="flex gap-3 items-center">
                                                <img src="{{ asset('images/hand_pain.png') }}" onerror="this.src='https://via.placeholder.com/50x50'" alt="" loading="lazy" class="w-14 h-14 rounded-full" />
                                                <p class="font-semibold text-xl">{{ $position_text }}</p>
                                            </div>
                                        </div>
                                        <div class="bg-[#aed0ca] text-white p-2 w-12 h-12 rounded-xl text-center">
                                            <p class="text-base leading-none">{{ $case->created_at->format('d') }}</p>
                                            <p class="text-base leading-none">{{ $case->created_at->format('M') }}</p>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="text-center text-black font-medium text-xl pt-4 drop-shadow-md">ไม่มีข้อมูลการทานยา</p>
                            @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
