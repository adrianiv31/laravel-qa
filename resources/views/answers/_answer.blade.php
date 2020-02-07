<div class="media post">
    @include('shared._vote',[
            'model' => $answer
        ])
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
                <user-info :model="{{ $answer }}" label="answerred"></user-info>
            </div>
        </div>
    </div>
</div>
