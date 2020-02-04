@if($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions.vote';
    @endphp
@elseif($model instanceOf App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers.vote';
    @endphp
@endif
@php
    $formId = $name . "-" . $model->id;
@endphp
<div class="d-flex flex-column vote-controls">
    <a title="This $name is usefull"
       class="vote-up {{ Auth::guest() ? 'off' : '' }}"
       onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();"
    >
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    {!! Form::open(['route'=> [$firstURISegment,$model->id], 'method' => 'POST', 'id' => 'up-vote-'.$formId, 'style' => 'display:none']) !!}
    {!! Form::hidden('vote','1') !!}
    {!! Form::close() !!}
    <span class="votes count">{{ $model->votes_count }}</span>
    <a title="This $name is not usefull"
       class="vote-down  {{ Auth::guest() ? 'off' : '' }}"
       onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();"
    >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    {!! Form::open(['route'=> [$firstURISegment,$model->id], 'method' => 'POST', 'id' => 'down-vote-'.$formId, 'style' => 'display:none']) !!}
    {!! Form::hidden('vote','-1') !!}
    {!! Form::close() !!}

    @if($model instanceof App\Question)
        @include('shared._favorite',[
            'model' => $model
        ])
    @elseif($model instanceof App\Answer)
        @include('shared._accept',[
            'model' => $model
        ])
    @endif
</div>
