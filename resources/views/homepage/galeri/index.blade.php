@include('homepage.layout.head')
@include('homepage.layout.header')

{{-- Konten Daftar Event. --}}
<section class="event section pt-0">
    <div class="container mt-4">
        <div class="row title">
            <div class="col-12">
                <h3 class="text-center font-weight-bold">Galeri<span class="text-primary">.</span></h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class='embedsocial-album' data-ref="c2871dc09ce2c7278f818bd7e1e9c6ffff250641"></div><script>(function(d, s, id){var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/embedscript/ei.js"; d.getElementsByTagName("head")[0].appendChild(js);}(document, "script", "EmbedSocialScript"));</script>
            </div>
        </div>
    </div>
</section>

@section('script')

@endsection

@include('homepage.layout.footer')
@include('homepage.layout.foot')