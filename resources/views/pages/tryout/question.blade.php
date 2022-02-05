{!!$question->question!!}
@foreach($question->options as $index => $option)
<label class="form-check card border mb-2 shadow-none {{ $test->done_at && $question->correct_answer->id == $option->id ? 'border-success' : '' }}"
    style="cursor: pointer">
    <div class="card-body p-2 px-3">
        <div class="row">
            <div class="col-auto pr-0">
                <input class="form-check-input mr-2" type="radio" name="answer" value="{{ $option->id }}">
                {{ range('A','Z')[$index] }}.
            </div>
            <div class="col pl-1">
                {!! $option->option !!}
            </div>
            @if ($test->done_at)
            <div class="col-auto">
                Skor: {{$option->score}}
            </div>
            @endif
        </div>
    </div>
</label>
@endforeach

@if ($test->done_at)
    <h1 class="card-subtitle mt-4">Pembahasan</h1>
    {!! $question->explanation !!}
@endif

<div class="row justify-content-between mt-4">
    <div class="col-auto">
        @if($prev != 0)
        <button data-question-id="{{ $prev }}" id="prev" class="btn btn-secondary"><i class="fa fa-arrow-left mr-2"></i>
            Sebelumnya</button>
        @endif
    </div>
    <div class="col-auto">
        @if($next != 0)
        <button data-question-id="{{ $next }}" id="next" class="btn btn-primary">Selanjutnya <i
                class="fa fa-arrow-right ml-2"></i></button>
        @elseif(!$test->done_at)
        <button id="finish" class="btn btn-primary">Selesai<i class="fa fa-check ml-2"></i></button>
        @endif
    </div>
</div>