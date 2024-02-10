<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
</script>
@if ($errors->any())
    <script>
        var errors = @json($errors->all());
        Toast.fire({
            icon: 'error',
            title: errors.join('\n')
        });
    </script>
@endif


@if (session()->has('success'))
    @php
        $messages = session('success');
    @endphp
    <script>
        Toast.fire({
            icon: 'success',
            title: '{{ $messages }}'
        })
    </script>
@endif

@if (session()->has('error'))
    @php
        $messages = session('error');
    @endphp
    <script>
        Toast.fire({
            icon: 'error',
            title: '{{ $messages }}'
        })
    </script>
@endif
