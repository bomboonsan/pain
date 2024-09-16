<x-guest-layout>
    <div class="p-2 overflow-hidden">
        <x-app.step step="3" />
        <div class="mt-5 mb-8">
            <h1 class="page-title">ปวดแบบไหน</h1>
        </div>
        <div class="my-20"></div>
        <div class="relative">
            <form action="{{ route('symptomsSelectPost') }}" method="POST">
                @csrf
            <div class="relative px-2 space-y-2">
                @php
                $symptoms = [
                    'aching' => 'Aching',
                    'burnning' => 'Burnning',
                    'dull' => 'Dull',
                    'electric_shock' => 'Electric Shock',
                    'pins_and_needles' => 'Pins and Needles',
                ];
                $symptomsSelectedKey = array_keys($symptomsSelected);
                @endphp
                @foreach ($symptoms as $key => $value)
                <x-app.symptoms-select key="{{ $key }}" value="{{ $value }}" checked="{{ in_array($key, $symptomsSelectedKey) }}" />
                @endforeach

            </div>
                <button type="submit" id="submit" class="hidden">ยืนยัน</button>
            </form>
        </div>
        <div class="flex justify-center gap-5 mt-10">
            <x-app.btn-secondary text="ย้อนกลับ" url="{{ route('symptoms') }}" />
            <x-app.btn-primary text="ถัดไป" />
        </div>
    </div>
</x-guest-layout>



<script>
    const btnPrimary = document.querySelector('#btn-primary');
    const submit = document.querySelector('#submit');
    btnPrimary.addEventListener('click', () => {
        submit.click();
    })
</script>


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
