@extends('layouts.admin')
@section('title','Dar de alta aun nuevo usuario')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}

@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios del sistema</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Registrar usuario</h4>
    </div>
    {{--  {!! Form::open(['route'=>['backoffice..users.store',$user], 'method'=>'POST']) !!}  --}}
    {!! Form::open(['route'=>'backoffice.users.store', 'method'=>'POST']) !!}
    <div class="card-body">
        <div class="form-group">
            <label>Roles</label>
            {!! Form::select('role', $roles ,null, ['class'=>'form-control'] ) !!}
            @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @include('admin.user._form')
        <div class="form-group">
            <label>Contraseña</label>
            {!! Form::password('password', ['class'=>'form-control']) !!}
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Confirmar contraseña</label>
            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit">Guardar</button>
        <button class="btn btn-secondary" type="reset">Cancelar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection
