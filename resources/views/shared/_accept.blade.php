@can('accept',$model)
    <a title="Mark this answer as best answer"
       class="favorite mt-2 {{ $model->status }}"
       onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    {!! Form::open(['route' => ['answers.accept',$model->id], 'method' => 'POST', 'id' => 'accept-answer-'.$model->id, 'style' => 'display:none']) !!}
    {!! Form::close() !!}
@else
    @if($model->is_best)
        <a title="The question qwner acceped this answer as best answer"
           class="favorite mt-2 {{ $model->status }}"
        >
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
