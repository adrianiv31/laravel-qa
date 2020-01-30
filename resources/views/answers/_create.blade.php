<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your answer</h3>
                </div>
                <hr>
                {!! Form::open(['route' => ['questions.answers.store',$question->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::textarea('body', null, ['id' => 'question-body', 'class' => 'form-control '. ($errors->has('body') ? 'is-invalid' : ''), 'rows'=>'7']); !!}
                    @if($errors->has('body'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::button('Submit', ['type' => 'submit', 'class' =>'btn btn-outline-primary btn-lg']); !!}
                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
</div>
