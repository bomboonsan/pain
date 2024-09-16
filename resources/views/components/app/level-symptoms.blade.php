<div class="w-[70%] mx-auto my-8">
    <form action="{{ route('symptomsPost') }}" method="POST">
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
    aria-orientation="horizontal" min="0" max="10" @if(!empty($symptomsLevel)) value="{{ $symptomsLevel }}" @endif />
    <button type="submit" id="submit" class="hidden">ยืนยัน</button>
    </form>

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

    // document. loaded
    document.addEventListener('DOMContentLoaded', () => {
        numberLevel.textContent = `{{ $symptomsLevel }}`;
        textLevel.classList.remove(...textLevel.classList);
        textLevel.classList.add(`text-level-{{ $symptomsLevel }}`);
        if ({{ $symptomsLevel }} == 0) {
            textLevel.classList.add(`text-level-1`);
        }
    })
</script>
