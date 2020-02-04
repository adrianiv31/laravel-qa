<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is usefull"
                               class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            {!! Form::open(['route'=> ['answers.vote',$answer->id], 'method' => 'POST', 'id' => 'up-vote-answer-'.$answer->id, 'style' => 'display:none']) !!}
                            {!! Form::hidden('vote','1') !!}
                            {!! Form::close() !!}
                            <span class="votes count">{{ $answer->votes_count }}</span>
                            <a title="This answer is not usefull" class="vote-down  {{ Auth::guest() ? 'off' : '' }}"
                               onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            {!! Form::open(['route'=> ['answers.vote',$answer->id], 'method' => 'POST', 'id' => 'down-vote-answer-'.$answer->id, 'style' => 'display:none']) !!}
                            {!! Form::hidden('vote','-1') !!}
                            {!! Form::close() !!}
                            @can('accept',$answer)
                                <a title="Mark this answer as best answer"
                                   class="favorite mt-2 {{ $answer->status }}"
                                   onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                {!! Form::open(['route' => ['answers.accept',$answer->id], 'method' => 'POST', 'id' => 'accept-answer-'.$answer->id, 'style' => 'display:none']) !!}
                                {!! Form::close() !!}
                            @else
                                @if($answer->is_best)
                                    <a title="The question qwner acceped this answer as best answer"
                                       class="favorite mt-2 {{ $answer->status }}"
                                    >
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                               class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan

                                        @can('delete', $answer)
                                            {!! Form::open(['method' => 'DELETE', 'action' => ['AnswersController@destroy', $question->id, $answer->id],'class' => 'form-delete']) !!}
                                            {!! Form::submit('Delete', ['class' =>'btn btn-outline-danger btn-sm', 'onclick' => 'return confirm("Are you sure?")']); !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
