<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('text') }}
            {{ Form::text('text', $pagina->text, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'placeholder' => 'Text']) }}
            {!! $errors->first('text', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numeracion') }}
            {{ Form::text('numeracion', $pagina->numeracion, ['class' => 'form-control' . ($errors->has('numeracion') ? ' is-invalid' : ''), 'placeholder' => 'Numeracion']) }}
            {!! $errors->first('numeracion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       <!-- <div class="form-group">
            {{ Form::label('cuento_id') }}
            {{ Form::text('cuento_id', $pagina->cuento_id, ['class' => 'form-control' . ($errors->has('cuento_id') ? ' is-invalid' : ''), 'placeholder' => 'Cuento Id']) }}
            {!! $errors->first('cuento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
-->
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>