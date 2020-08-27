@if($errors->any())
    @push('scripts')
        <script>
            @foreach($errors->all() as $error)
            toastr.error("{{ $error }}")
            @endforeach
        </script>
    @endpush
@endif
@if (session('status'))
    @push('scripts')
        <script>
            toastr.success("{{ session('status') }}")
        </script>
    @endpush
@endif