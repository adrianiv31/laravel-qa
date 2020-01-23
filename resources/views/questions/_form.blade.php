<div class="form-group">
    {!! Form::label('question-title', 'Question Title'); !!}
    {!! Form::text('title', old('title', $question->title), ['id' => 'question-title', 'class' => 'form-control '. ($errors->has('title')?'is-invalid':'')]); !!}

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    {!! Form::label('question-body', 'Question Title'); !!}
    {!! Form::textarea('body', old('body', $question->body), ['id' => 'question-body', 'class' => 'form-control '. ($errors->has('body')?'is-invalid' :''), 'rows'=>'10']); !!}

    @if ($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    {!! Form::button($buttonText, ['type' => 'submit', 'class' =>'btn btn-outline-primary btn-lg']); !!}
</div>
