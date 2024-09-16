@extends('layouts.dashboard')
@section('content')
    <div class="p-2 overflow-hidden">

        <a href="{{ route('home') }}" class="flex gap-2 items-center">
            <div class="mb-5 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 72 72"><path fill="#FFFFFF" d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z"/><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z"/></svg>
            </div>
            <h1 class="dashboard-title">
                บันทึกการทานยา
            </h1>
        </a>

        <form id="form" action="{{ route('recordPost' , $cases->id) }}" method="POST">
        @csrf
        <div class="bg-white rounded-lg shadow p-4 mb-5">
            <div class="flex gap-3 items-center mb-4">
                <div>
                    <img class="inline-block w-6 md:w-7" src="{{ asset('images/icon-med.png') }}" alt="">
                </div>
                <div class="border-l border-primary pl-2">
                    <h2 class="text-xl font-bold">
                        ยาที่ทาน
                    </h2>
                </div>
            </div>
            <div id="meds" class="flex flex-col gap-y-1">
                @php
                $meds_array = explode(',', $cases->meds);
                $i = 0;
                @endphp

                @foreach ($meds_array as $meds)
                @php
                $i++;
                @endphp
                <div class="flex">
                    <input type="checkbox" name="meds[{{ $meds }}]" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="meds_{{ $i }}">
                    <label for="meds_{{ $i }}" class="text-base ms-2">{{ $meds }}</label>
                </div>
                @endforeach
                <div class="flex">
                    <input type="checkbox" name="meds_add" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="meds_add">
                    <label for="meds_add" class="text-base ms-2">
                        <input type="text" id="meds_add_input" name="meds_add_input" class="w-full border-0 border-b p-0 focus:ring-0 focus:outline-none" placeholder="อื่นๆ (ระบุชื่อยา)">
                    </label>
                </div>

            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 mb-5">
            <div class="flex gap-3 items-center mb-4">
                <div>
                    <img class="inline-block w-6 md:w-7" src="{{ asset('images/icon-date.png') }}" alt="">
                </div>
                <div class="border-l border-primary pl-2">
                    <h2 class="text-base font-bold" for="datepicker">
                        วันที่บันทึก
                    </h2>
                    <input value="{{ date('Y-m-d H:i') }}" type="datetime-local" name="date" id="datepicker" timezone="Asia/Bangkok" class="w-full border-gray-200 rounded-md focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-40">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 mb-5">
            <h2 class="text-base font-bold mb-4">
                ระดับความปวด
            </h2>
            <div class="w-[70%] mx-auto my-8">
                    @csrf
                <label for="symptoms-level" class="sr-only">symptoms level</label>
                <input
                type="range"
                class="w-full bg-transparent cursor-pointer appearance-none disabled:opacity-50 disabled:pointer-events-none focus:outline-none
                [&::-webkit-slider-thumb]:relative
                [&::-webkit-slider-thumb]:z-1
                [&::-webkit-slider-thumb]:w-2.5
                [&::-webkit-slider-thumb]:h-2.5
                [&::-webkit-slider-thumb]:-mt-0.5
                [&::-webkit-slider-thumb]:appearance-none
                [&::-webkit-slider-thumb]:bg-white
                [&::-webkit-slider-thumb]:shadow-[0_0_0_4px_rgba(160,160,160,1)]
                [&::-webkit-slider-thumb]:rounded-full
                [&::-webkit-slider-thumb]:transition-all
                [&::-webkit-slider-thumb]:duration-150
                [&::-webkit-slider-thumb]:ease-in-out

                [&::-moz-range-thumb]:w-2.5
                [&::-moz-range-thumb]:h-2.5
                [&::-moz-range-thumb]:appearance-none
                [&::-moz-range-thumb]:bg-white
                [&::-moz-range-thumb]:border-4
                [&::-moz-range-thumb]:border-neutral-300
                [&::-moz-range-thumb]:rounded-full
                [&::-moz-range-thumb]:transition-all
                [&::-moz-range-thumb]:duration-150
                [&::-moz-range-thumb]:ease-in-out

                [&::-webkit-slider-runnable-track]:w-full
                [&::-webkit-slider-runnable-track]:h-2
                [&::-webkit-slider-runnable-track]:bg-gray-100
                [&::-webkit-slider-runnable-track]:rounded-full

                [&::-moz-range-track]:w-full
                [&::-moz-range-track]:h-2
                [&::-moz-range-track]:bg-gray-100
                [&::-moz-range-track]:rounded-full"
                id="symptoms-level"
                name="symptomsLevel"
                aria-orientation="horizontal" min="0" max="10" />


                <div class="grid grid-cols-10 gap-0 h-2 mb-3 -mt-[15px] rounded-full overflow-hidden z-0">
                    <div class="bg-[#74b551]"></div>
                    <div class="bg-[#7fba53]"></div>
                    <div class="bg-[#98c34d]"></div>
                    <div class="bg-[#c0ca43]"></div>
                    <div class="bg-[#f2cb2e]"></div>
                    <div class="bg-[#ebb231]"></div>
                    <div class="bg-[#e19831]"></div>
                    <div class="bg-[#dc802d]"></div>
                    <div class="bg-[#d6682d]"></div>
                    <div class="bg-[#d14c2b]"></div>
                </div>


                <div>
                    <p class="text-center font-semibold">
                        ความปวด <span id="text-level" class="text-level-5">ระดับ <span id="number-level">5</span></span>
                    </p>
                </div>
            </div>
            <script>
                const symptomsLevel = document.getElementById('symptoms-level');
                const textLevel = document.getElementById('text-level');
                const numberLevel = document.getElementById('number-level');
                symptomsLevel.addEventListener('input', () => {
                    const value = symptomsLevel.value;
                    numberLevel.textContent = `${value}`;
                    // textLevel remove all class and add new class
                    textLevel.classList.remove(...textLevel.classList);
                    textLevel.classList.add(`text-level-${value}`);
                    if (value == 0) {
                        textLevel.classList.add(`text-level-1`);
                    }
                });
            </script>

        </div>
        <button id="btnSubmit" type="submut" class="hidden">submit</button>
        </form>
        <div class="flex justify-center gap-x-4">
            <button id="btnSave" type="button" class="w-full py-3 text-primary bg-white hover:bg-gray-50 font-medium rounded-lg text-lg px-5 shadow hover:shadow-lg">บันทึก</button>
        </div>


    </div>



<button id="btnDialog" class="hidden" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-slide-up-animation-modal" data-hs-overlay="#hs-slide-up-animation-modal">SHOW</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const btnSubmit = document.querySelector('#btnSubmit');
    const btnSave = document.querySelector('#btnSave');
    const form = document.querySelector('#form');
    const meds = document.querySelector('#meds');

    btnSave.addEventListener('click', () => {
        // get value all input of meds
        const medArray = [];
        for (let i = 0; i < meds.children.length; i++) {
            if (meds.children[i].children[0].checked) {
                medArray.push(meds.children[i].children[0].value);
            }
        }
        if( medArray.length === 0) {
            Swal.fire({
                title: "ยังไม่ได้เลือกยา",
                icon: "warning",
                showConfirmButton: false,
            });
        } else {
            // get form data
            const formData = new FormData(form);
            // add meds to formData
            // formData.append('meds', medArray.join(','));

            // formData.append('meds', medArray);



            // submit form
            btnSubmit.click();
        }
    })
</script>

@endsection
