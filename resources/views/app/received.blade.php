<x-guest-layout>
    <div class="p-2 overflow-hidden">
        <x-app.step step="4" />
        <div class="mt-5 mb-8">
            <h1 class="page-title">ยาที่ได้รับ</h1>
        </div>
        <div class="relative">
            {{-- import livewire MedReceived --}}
            <livewire:med-received />
        </div>

        <div class="flex justify-center gap-5">
            <x-app.btn-secondary text="ย้อนกลับ" url="{{ Route('symptomsSelect') }}" />
            <x-app.btn-primary text="ถัดไป" />
        </div>

        <form class="mt-5 hidden" id="form" action="{{ route('receivedPost') }}" method="POST">
            @csrf
            <button id="submit" type="submit" class="hidden">ยืนยัน</button>
        </form>
    </div>
</x-guest-layout>
<script>
    const btnPrimary = document.querySelector('#btn-primary');
    const submit = document.querySelector('#submit');

    btnPrimary.addEventListener('click', () => {
        submit.click();
    });
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
