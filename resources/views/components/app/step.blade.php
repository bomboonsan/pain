<!-- Stepper -->
<ul class="relative flex flex-row gap-x-2 w-full mx-auto custom-stepper ml-3 sm:ml-9">
    <!-- Item -->
    <li class="shrink basis-0 flex-1 group @if($step == 1) active @endif">
        <div class="min-w-7 min-h-7 w-full inline-flex items-center text-xs align-middle">
            <span class="step-number size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full">
                1
            </span>
            <div class="ms-2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </div>
        <div class="mt-3">
            <span class="block text-[11px] sm:text-sm font-medium text-gray-800">
                ตำแหน่ง
            </span>
        </div>
    </li>
    <!-- End Item -->

    <!-- Item -->
    <li class="shrink basis-0 flex-1 group @if($step == 2) active @endif">
        <div class="min-w-7 min-h-7 w-full inline-flex items-center text-xs align-middle">
            <span class="step-number size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full">
                2
            </span>
            <div class="ms-2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </div>
        <div class="mt-3">
            <span class="block text-[11px] sm:text-sm font-medium text-gray-800">
                ความปวด
            </span>
        </div>
    </li>
    <!-- End Item -->

    <!-- Item -->
    <li class="shrink basis-0 flex-1 group @if($step == 3) active @endif">
        <div class="min-w-7 min-h-7 w-full inline-flex items-center text-xs align-middle">
            <span class="step-number size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full">
                3
            </span>
            <div class="ms-2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </div>
        <div class="mt-3">
            <span class="block text-[11px] sm:text-sm font-medium text-gray-800">
                ปวดแบบไหน
            </span>
        </div>
    </li>
    <!-- End Item -->

    <!-- Item -->
    <li class="shrink basis-0 flex-1 group @if($step == 4) active @endif">
        <div class="min-w-7 min-h-7 w-full inline-flex items-center text-xs align-middle">
            <span class="step-number size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full">
                4
            </span>
            <div class="ms-2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </div>
        <div class="mt-3">
            <span class="block text-[11px] sm:text-sm font-medium text-gray-800">
                ยาที่ได้รับ
            </span>
        </div>
    </li>
    <!-- End Item -->

    <!-- Item -->
    <li class="shrink basis-0 flex-1 group @if($step == 5) active @endif">
        <div class="min-w-7 min-h-7 w-full inline-flex items-center text-xs align-middle">
            <span class="step-number size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full">
                5
            </span>
            <div class="ms-2 w-full h-px flex-1 bg-gray-200 group-last:hidden"></div>
        </div>
        <div class="mt-3">
            <span class="block text-[11px] sm:text-sm font-medium text-gray-800">
                สรุป
            </span>
        </div>
    </li>
    <!-- End Item -->

</ul>
<!-- End Stepper -->
