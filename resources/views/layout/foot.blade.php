</div>
</div>
<script type="text/javascript" src="{{ asset('assets_/assets/scripts/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/sweet-alert/sweetalert2.min.js') }}"></script>
@if(Session::has('alert'))
@php
$alert = Session::get('alert');
@endphp
<script type="text/javascript">
    Swal.fire({
            title: @json($alert['title']),
            text: @json($alert['message']),
            icon: @json($alert['type']),
        })
</script>
@endif
@yield('script')
<script type="text/javascript" src="{{ asset('assets_/assets/scripts/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/bootstrap-select/js/i18n/defaults-id_ID.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('assets_/assets/summernote/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/summernote/lang/summernote-id-ID.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/scripts/main.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('show.bs.modal', '.modal', function() {
            $(this).appendTo('body');
        });
        $('data-toggle[dropdown]').dropdown();
        initZoomImage();
    });
</script>

</body>

</html>