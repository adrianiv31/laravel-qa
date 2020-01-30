@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Edititing answer for question <strong>{{ $question->title }}</strong></h1>
                        </div>
                        <hr>
                        {!! Form::open(['route' => ['questions.answers.update',$question->id, $answer->id], 'method' => 'PATCH']) !!}
                        <div class="form-group">
                            {!! Form::textarea('body', old('body', $answer->body), ['id' => 'question-body', 'class' => 'form-control '. ($errors->has('body') ? 'is-invalid' : ''), 'rows'=>'7']); !!}
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::button('Update', ['type' => 'submit', 'class' =>'btn btn-outline-primary btn-lg']); !!}
                        </div>
                        {!! Form::close(); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
