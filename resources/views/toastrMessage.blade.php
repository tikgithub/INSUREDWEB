<div class="notosanLao pt-5">
    @if ($message = Session::get('success'))
        <script>
            toastr.success('{{ $message }}');
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            toastr.error('{{ $message }}');
        </script>
    @endif

    @if ($message = Session::get('warning'))
        <script>
            toastr.warning('{{ $message }}');
        </script>
    @endif

    @if ($message = Session::get('info'))
        <script>
            toastr.info('{{ $message }}');
        </script>
    @endif
</div>


@if ($errors->any())
<script>
   toastr.warning('{{ implode('', $errors->all(':message')) }}');
</script>
@endif
