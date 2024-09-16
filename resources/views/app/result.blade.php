<x-guest-layout>
    <div class="p-2 overflow-hidden">
        <x-app.step step="5" />
        <div class="mt-5 mb-8">
            {{-- <h1 class="page-title">สรุป</h1> --}}
        </div>
        <div class="relative p-2 md:px-10 md:py-5">
            <div class="rounded-lg border border-neutral-400/20 p-2 md:py-10 md:px-5">
                <div class="mb-5 w-1/3 md:w-1/4 mx-auto">
                    <img src="{{ asset('images/hand_pain.png') }}" alt="" class="w-full h-auto">
                </div>
                <p class="text-center text-xl md:text-2xl font-bold mb-5">
                    สรุป
                </p>
                <div class="space-y-2 font-medium text-sm md:text-lg">
                    <p>
                        <span class="text-primary inline-block md:min-w-[130px] mr-3">ตำแหน่งอาการ:</span>
                        @foreach ($position_text_all as $text)
                            @if ($loop->last)
                            {{ $text }}
                            @else
                            {{ $text }} ,
                            @endif
                        @endforeach
                    </p>
                    <p>
                        <span class="text-primary inline-block md:min-w-[130px] mr-3">ระดับความปวด:</span>
                        {{ $symptomsLevel }}
                    </p>
                    <p>
                        <span class="text-primary inline-block md:min-w-[130px] mr-3">ลักษณะการปวด:</span>
                        @foreach ($symptoms_text as $text)
                            @if ($loop->last)
                            {{ $text }}
                            @else
                            {{ $text }} ,
                            @endif
                        @endforeach
                    </p>
                    <p>
                        <span class="text-primary inline-block md:min-w-[130px] mr-3">ยาที่รับประทาน::</span>
                        @foreach ($medReceived as $item)
                            @if ($loop->last)
                            {{ $item['name']  }}
                            @else
                            {{ $item['name']  }} ,
                            @endif
                        @endforeach
                    </p>
                </div>

            </div>
        </div>
        <div class="flex justify-center gap-5">
            <form action="{{ route('caseSubmit') }}" method="post">
                @csrf
                <button id="submit" type="submit" class="button-primary" >บันทึก</button>
            </form>
            <button id="btnDialog" class="hidden" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-slide-up-animation-modal" data-hs-overlay="#hs-slide-up-animation-modal">SHOW</button>
        </div>
    </div>
</x-guest-layout>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => { document.getElementById('btnDialog').click(); }, 200)
            setTimeout(() => {
                window.location.href = "{{ route('home') }}";
            }, 3000)
        })
    </script>
@endif

<div id="hs-slide-up-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none flex items-center" role="dialog" tabindex="-1" aria-labelledby="hs-slide-up-animation-modal-label">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-14 opacity-0 ease-out transition-all sm:max-w-md sm:w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">

            <div class="p-4 md:px-10 md:py-10 overflow-y-auto text-center">
                <img src="{{ asset('images/icon-success.png') }}" alt="" class="w-24 h-auto mx-auto mb-5">
                <p class="mt-1 text-lg font-semibold">
                    บันทึกเรียบร้อย!
                </p>
                <p class="mb-5">
                    ขอบคุณสำหรับการบันทึก
                </p>
                <a href="{{ route('home') }}" type="button" class="button-primary shadow-md" data-hs-overlay="#hs-slide-up-animation-modal">เสร็จสิ้น</a>
            </div>

        </div>
    </div>
</div>
