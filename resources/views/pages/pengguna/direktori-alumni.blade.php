@extends('layout.app')

@section('title', 'Direktori Alumni')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{{ $dataTable->scripts() }}
<script>
    $("#alumnidatatable-table_wrapper img").ready(function() {
        $('img[data-enlargeable]').click(function() {
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
    });
</script>
@endsection