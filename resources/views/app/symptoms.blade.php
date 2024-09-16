<x-guest-layout>
    <div class="p-2 overflow-hidden">
        <x-app.step step="2" />
        <div class="mt-5 mb-8">
            <h1 class="page-title">เลือกระดับความปวด</h1>
        </div>
        <div class="my-20"></div>
        <div class="relative">
            <x-app.level-symptoms symptomsLevel="{{ $symptomsLevel }}" />
        </div>
        <div class="flex justify-center gap-5">
            <x-app.btn-secondary text="ย้อนกลับ" url="{{ route('pain') }}" />
            <x-app.btn-primary text="ถัดไป" />
        </div>
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

<script>
    const btnPrimary = document.querySelector('#btn-primary');
    const submit = document.querySelector('#submit');

    btnPrimary.addEventListener('click', () => {
        submit.click();
    })
</script>
