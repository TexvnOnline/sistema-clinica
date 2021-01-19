
<div class="form-group">
    <label>Nombre de usuario</label>
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label>Fecha de nacimiento</label>
    {!! Form::date('dob', null, ['class'=>'form-control']) !!}
    @error('dob')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label>Correo electrónico</label>
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


