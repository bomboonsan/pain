<x-guest-layout>
    <div class="p-2 overflow-hidden">
        <x-app.step step="1" />
        <div class="mt-5 mb-8">
            <h1 class="page-title">เลือกตำแหน่งที่ปวด</h1>
        </div>
        <div class="relative">
            <div class="relative mx-auto w-2/3 sm:w-5/12 h-auto">
                <img src="{{ asset('images/body.png') }}" alt="body" class="block w-full h-auto" />
                <i class="markPosition position-1"></i>
                <i class="markPosition position-2"></i>
                <i class="markPosition position-3"></i>
                <i class="markPosition position-4"></i>
                <i class="markPosition position-5"></i>
                <i class="markPosition position-6"></i>
                <i class="markPosition position-7"></i>
                <i class="markPosition position-8"></i>
                <i class="markPosition position-9"></i>
                <i class="markPosition position-10"></i>
                <i class="markPosition position-11"></i>
                <i class="markPosition position-12"></i>
                <i class="markPosition position-13"></i>
                <i class="markPosition position-14"></i>
                <i class="markPosition position-15"></i>
                <i class="markPosition position-16"></i>
                <i class="markPosition position-17"></i>
                <i class="markPosition position-18"></i>
            </div>
            <div class="absolute top-[10%] right-[20%] transform translate-x-1/2 -translate-y-1/2 w-[16%] sm:w-[10%] h-auto aspect-square">
                <svg class="w-full h-auto aspect-square" viewBox="0 0 56 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_2010_363)">
                    <path d="M35.8772 3.03564L29.5135 9.49461L35.8772 15.9536" stroke="#9ED0CA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M29.5135 9.49463H39.1297C45.7685 9.49463 51.1499 16.3295 51.1499 24.7613V26.2879" stroke="#9ED0CA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21.0859 59.0671L27.4496 53.2541L21.0859 47.441" stroke="#9ED0CA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M26.1769 53.9001H16.5607C9.92196 53.9001 4.54052 47.591 4.54052 39.8079V38.3986" stroke="#9ED0CA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M35.4573 32.9148C37.2009 34.1162 38.4227 35.7438 38.4227 37.914V41.7894H42.2409C42.9409 41.7894 43.5136 41.2081 43.5136 40.4976V37.914C43.5136 35.0979 38.97 33.4315 35.4573 32.9148Z" fill="#9ED0CA"/>
                    <path d="M25.6954 31.4552C28.507 31.4552 30.7863 29.1418 30.7863 26.288C30.7863 23.4343 28.507 21.1208 25.6954 21.1208C22.8838 21.1208 20.6045 23.4343 20.6045 26.288C20.6045 29.1418 22.8838 31.4552 25.6954 31.4552Z" fill="#9ED0CA"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M33.3317 31.4552C36.1445 31.4552 38.4226 29.1429 38.4226 26.288C38.4226 23.4332 36.1445 21.1208 33.3317 21.1208C32.7335 21.1208 32.1735 21.25 31.639 21.4309C32.7342 22.8056 33.3317 24.5201 33.3317 26.288C33.3317 28.056 32.7342 29.7704 31.639 31.1452C32.1735 31.326 32.7335 31.4552 33.3317 31.4552ZM25.6954 32.747C22.2972 32.747 15.5135 34.478 15.5135 37.9142V40.4978C15.5135 41.2082 16.0863 41.7895 16.7863 41.7895H34.6045C35.3045 41.7895 35.8772 41.2082 35.8772 40.4978V37.9142C35.8772 34.478 29.0935 32.747 25.6954 32.747Z" fill="#9ED0CA"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_2010_363">
                    <rect width="56" height="60.7143" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <p class="text-primary text-center">
                    ด้านหน้า
                </p>
            </div>
        </div>
        <div class="mt-5 text-center">
            <button id="next" type="button" class="button-primary">ถัดไป</button>
        </div>
        <form class="mt-5 hidden" id="form" action="{{ route('painPost') }}" method="POST">
            @csrf
            @php
                $maxPosition = 18;
            @endphp
            @for ($i = 1; $i <= $maxPosition; $i++)
                <input type="checkbox" class="checkbox" data-position="{{ $i }}" name="positions[{{ $i }}]" value="{{ $i }}" @if($positions && in_array($i, $positions)) checked @endif  />
            @endfor
            <button id="submit" type="submit" class="hidden">ยืนยัน</button>
        </form>
    </div>
</x-guest-layout>

@if(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: "{{ session('error') }}",
        icon: "warning",
        showConfirmButton: false,
    });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    const markPositions = document.querySelectorAll('.markPosition');
    const form = document.getElementById('form');
    const checkbox = document.querySelectorAll('.checkbox');
    const nextButton = document.getElementById('next');
    const submitButton = document.getElementById('submit');



    nextButton.addEventListener('click', function () {
        // count checkboxChecked
        let checkboxChecked = 0;
        checkbox.forEach(checkbox => {
            if (checkbox.checked) {
                checkboxChecked++;
            }
        })
        if(checkboxChecked < 1) {
            Swal.fire({
                title: "กรุณาเลือกตำแหน่งที่ปวด",
                icon: "warning",
                showConfirmButton: false,
            });
            return;
        }

        submitButton.click();
    })

    markPositions.forEach(markPosition => {
        markPosition.addEventListener('click', function (e) {
            let position = e.target.classList[1];
            position = parseInt(position.replace('position-', ''));
            console.log('position:', position);
            checkBox(position);
            activePosition(position);
        })
    });

    function activePosition(position) {
        markPositions.forEach(markPosition => {
            let positionMark = parseInt(markPosition.classList[1].replace('position-', ''));
            if (positionMark == position) {
                if (markPosition.classList.contains('position-active')) {
                    markPosition.classList.remove('position-active');
                } else {
                    markPosition.classList.add('position-active');
                }
            }
        })
    }

    function checkBox(position) {
        checkbox.forEach(checkbox => {
            if (checkbox.dataset.position == position) {
                if (checkbox.checked) {
                    checkbox.checked = false;
                } else {
                    checkbox.checked = true;
                }
            }

        })
    }

    document.addEventListener('DOMContentLoaded', function () {
        // get value from checkbox
        checkbox.forEach(checkbox => {
            if (checkbox.checked) {
                activePosition(checkbox.dataset.position);
            }
        })
    });
</script>


{{--
position 1 หัว
position 2 ไหล่ซ้าย
position 3 หน้าอก
position 4 ไหล่ขวา
position 5 ข้อศอกซ้าย
position 6 ข้อศอกขวา
position 7 เอวซ้าย
position 8 เอวขวา
position 9 มือซ้าย
position 10 มือขวา
position 11 ต้นขาซ้าย
position 12 ต้นขาขวา
position 13 หัวเข่าซ้าย
position 14 หัวเข่าขวา
position 15 น่องซ้าย
position 16 น่องขวา
position 17 เท้าซ้าย
position 18 เท้าขวา
--}}
