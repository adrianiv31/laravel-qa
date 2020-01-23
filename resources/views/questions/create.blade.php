@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask Questions</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all
                                    questions</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'questions.store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('question-title', 'Question Title'); !!}
                            {!! Form::text('title', null, ['id' => 'question-title', 'class' => 'form-control '. ($errors->has('title')?'is-invalid':'')]); !!}

                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('question-body', 'Question Title'); !!}
                            {!! Form::textarea('body', null, ['id' => 'question-body', 'class' => 'form-control '. ($errors->has('body')?'is-invalid' :''), 'rows'=>'10']); !!}

                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::button('Ask this question', ['type' => 'submit', 'class' =>'btn btn-outline-primary btn-lg']); !!}
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
