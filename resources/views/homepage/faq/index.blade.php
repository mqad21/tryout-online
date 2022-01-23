@include('homepage.layout.head')
@include('homepage.layout.header')

{{-- Konten Daftar FAQ. --}}
<section class="event section pt-0">
    <div class="container mt-4">
        <div class="row title">
            <div class="col-12">
                <h3 class="text-center font-weight-bold">Frequently Asked Questions (FAQ)<span class="text-primary">.</span></h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                @if(!$faqs->count())
                    <p class="text-center font-italic">Belum ada FAQ</p>
                @endif
                <div id="accordion">
                    @foreach($faqs as $faq)
                        <div class="card">
                            <div class="card-header" id="heading{{ $faq->id }}">
                                <h6 class="mb-0">
                                    <a class="btn-link cursor-pointer" data-toggle="collapse" data-target="#question{{ $faq->id }}" aria-expanded="true" aria-controls="question{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </a>
                                </h6>
                            </div>
                            <div id="question{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion">
                                <div class="card-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@include('homepage.layout.footer')
@include('homepage.layout.foot')