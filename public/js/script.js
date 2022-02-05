var popupSize = {
    width: 780,
    height: 550
};

$(document).on('click', '.social-button', function (e) {
    var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
        horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

    var popup = window.open($(this).prop('href'), 'social',
        'width=' + popupSize.width + ',height=' + popupSize.height +
        ',left=' + verticalPos + ',top=' + horisontalPos +
        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

    if (popup) {
        popup.focus();
        e.preventDefault();
    }

});

$("[data-alert]").click(function(e){
    e.preventDefault();
    const form = $(this).parents("form");
    const message = $(this).data("alert")
    Swal.fire({
        title: message,
        text: '',
        icon: 'warning',
        type: 'input',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: 'green',
        confirmButtonText: 'Ya',
    })
    .then((result) => {
        if (result.isConfirmed) {
            form.submit()
        }
    });
})

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

function msToTime(s) {
  var pad = (n, z = 2) => ('00' + n).slice(-z);
  return pad(s/3.6e6|0) + ':' + pad((s%3.6e6)/6e4 | 0) + ':' + pad((s%6e4)/1000|0);
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