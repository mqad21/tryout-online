<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Scanner Kartu Alumni | IKAMAN 1 Medan</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center p-4">
            <div class="col-md-6 col-12">
                <div class="text-center">
                    <a href="{{ url('/') }}"><img class="mb-2" style="width:100px" src="{{ asset('assets/img/logo.png') }}" alt="logo-ikaman"></a>
                    <h5 class="mb-4">Scan Kartu Alumni</h5>
                </div>
                <div id="reader-container">
                    <div class="form-group row">
                        <label for="camera" class="col-3 col-form-label">Kamera:</label>
                        <div class="col-9">
                            <select name="camera" id="camera" class="form-control"></select>
                        </div>
                    </div>
                    <div class="w-100" id="reader"></div>
                </div>
                <div id="result-container" style="display: none">
                    <div class="btn btn-block primary mb-4" id="btn-scan">Scan Lagi</div>
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/plugins/html5-qrcode/dist/html5-qrcode.min.js') }}"></script>
<script>
    const html5QrCode = new Html5Qrcode("reader");
    let scanned = false;
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        if (!scanned) {
            $.ajax({
                url: "/result/" + decodedText,
                success: function(response) {
                    $("#result-container").show()
                    $("#reader-container").hide();
                    $("#result").html(response);
                    scanned = true;
                }
            });
        }
    };

    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            let options = ''
            devices.forEach(device => {
                options += `<option value="${device.id}">${device.label}</option>`
            });
            $("#camera").html(options);
            changeCamera(devices[0].id);
        }
    }).catch(err => {
        console.log(err);
        scanned = false;
    });

    $(document).ready(function() {
        $("#camera").change(function() {
            changeCamera($(this).val());
        });

        $("#btn-scan").click(function() {
            $("#result").html('');
            $("#reader-container").show();
            $("#result-container").hide()
            scanned = true;
        });
    });

    function changeCamera(cameraId) {
        function start(cameraId) {
            html5QrCode.start({
                deviceId: {
                    exact: cameraId
                }
            }, {
                fps: 10,
                qrbox: 200
            }, qrCodeSuccessCallback);
        }

        html5QrCode.stop().then(() => {
            start(cameraId);
        }).catch(() => {
            start(cameraId);
        })
    }
</script>

{{-- @include('homepage.layout.foot') --}}