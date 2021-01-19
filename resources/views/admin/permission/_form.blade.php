<div class="form-group">
    <label>Nombre</label>
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label>Roles</label>
    {!! Form::select('role_id', $roles ,null, ['class'=>'form-control'] ) !!}
    @error('role_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label>Descripción</label>
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
