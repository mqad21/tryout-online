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
<script type="text/javascript" src="{{ asset('assets_/assets/bootstrap-select/js/i18n/defaults-id_ID.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/summernote/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/summernote/lang/summernote-id-ID.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets_/assets/scripts/main.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('show.bs.modal', '.modal', function() {
            $(this).appendTo('body');
        });
        $('data-toggle[dropdown]').dropdown();
        initZoomImage();
    });

    function initZoomImage() {
        $('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
            var src = $(this).attr('src');
            var modal;

            function removeModal() {
                modal.remove();
                $('body').off('keyup.modal-close');
            }
            modal = $('<div>').css({
                background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
                backgroundSize: 'contain',
                width: '100%',
                height: '100%',
                position: 'fixed',
                zIndex: '10000',
                top: '0',
                left: '0',
                cursor: 'zoom-out'
            }).click(function() {
                removeModal();
            }).appendTo('body');
            //handling ESC
            $('body').on('keyup.modal-close', function(e) {
                if (e.key === 'Escape') {
                    removeModal();
                }
            });
        });
    }

    function deleteItem(e) {
        e.preventDefault();
        const target = e.currentTarget.getAttribute('href');
        const id = target.split("/").pop()
        console.log(target);
        Swal.fire({
                title: 'Anda yakin ingin menghapus?',
                text: 'Item yang sudah dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                type: 'input',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonColor: 'green',
                confirmButtonText: 'Ya',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: target,
                        type: 'POST',
                        data: {
                            id,
                            _method: 'DELETE'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Berhasil menghapus item',
                                icon: 'success',
                            }).then(() => {
                                window.location.reload()
                            })
                        }
                    })
                }
            });
    }

    function createPopupWin(pageURL, pageTitle,
        popupWinWidth, popupWinHeight) {
        var left = (screen.width - popupWinWidth) / 2;
        var top = (screen.height - popupWinHeight) / 4;

        var myWindow = window.open(pageURL, pageTitle,
            'resizable=yes, width=' + popupWinWidth +
            ', height=' + popupWinHeight + ', top=' +
            top + ', left=' + left);
    }

    function loginOAuth(e) {
        e.preventDefault();
        const target = e.currentTarget.getAttribute('target');
        createPopupWin(target, 'login', 600, 600)
    }
</script>

</body>

</html>