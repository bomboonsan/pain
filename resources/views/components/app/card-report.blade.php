<div class="rounded-lg bg-white border border-gray-200 shadow-md  p-2">
    <div class="border-l-2 border-primary px-2">
        <h2 class="text-lg font-semibold">
            {{-- ปวดมือ/ข้อมือ  --}}
            {{ $positions ?? '' }}
        </h2>
        <p class="text-sm">
            บันทึกเมื่อวันที่ {{ $createdAt ?? '' }}
        </p>
        <div class="flex gap-3 items-center">
            <div class="basis-1/5 w-1/5">
                <img src="{{ asset('images/hand_pain.png') }}" class="w-full" alt="" loading="lazy">
            </div>
            <div class="flex-1 text-primary">
                <p class="text-lg font-bold">
                    ยาที่ทาน {{ $meds ?? '' }}
                </p>
                <p class="text-sm">
                    วันที่ 10-12 มกราคม
                </p>
            </div>
        </div>
        <div class="text-right -mt-2">
            <a href="{{ route('report' , $id) }}" class="inline-flex justify-center items-center text-sm p-1 bg-primary hover:bg-[#3c9e95] transition-all text-white rounded-lg w-40 ">
                รายละเอียด
            </a>
        </div>
    </div>
</div>
