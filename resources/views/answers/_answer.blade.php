<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        @include('shared._vote',[
                'model' => $answer
            ])
        <div class="media-body">
            {!! Form::open(['v-if'=>'editing','@submit.prevent'=>'update','url'=>'#']) !!}
            <div class="form-group">
                {!! Form::textarea('','',['rows'=>'10','v-model'=>'body','class'=>'form-control','required' => 'required']) !!}
            </div>
            {!! Form::button('Update',['class'=>'btn btn-primary','type'=>'submit',':disabled'=>'isInvalid']) !!}
            {!! Form::button('Cancel',['@click'=>'cancel','class'=>'btn btn-outline-secondary','type'=>'button']) !!}
            {{ Form::close() }}
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update', $answer)
                                <a @click.prevent="edit"
                                   class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan

                            @can('delete', $answer)
                                {!! Form::button('Delete', ['class' =>'btn btn-outline-danger btn-sm', '@click' => 'destroy']); !!}
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
    </div>
</answer>
