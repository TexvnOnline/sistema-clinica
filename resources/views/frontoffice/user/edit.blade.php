@extends('layouts.main')
@section('styles')
@endsection
@section('name.user', $user->name)
@section('dob.user', $user->age())
@section('email.user', $user->email)
@section('date.user', $user->created_at->diffForHumans())
@section('title','Editar perfil')
@section('header','Editar perfil')
@section('nav')
<li class="nav-item">
    <a href="#" class="nav-link">Contact</a>
</li>
@endsection
@section('content.profile')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Actualizar datos de usuario</h3>
    </div>
    {!! Form::model($user, ['route'=>['frontoffice.user.update',$user->id, 'view=frontoffice'],'method'=>'PUT']) !!}
    <div class="card-body">
        <div class="from-group">
            {!! Form::label('name','Nombre de usuario') !!}
            {!! Form::text('name', null, ['class'=>'form-control'],array('required' => 'required')) !!}
            @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>
        <div class="from-group">
            {!! Form::label('dob','Fecha de nacimiento') !!}
            {!! Form::date('dob', $user->dob->format('Y-m-d'), ['class'=>'form-control'],array('required' => 'required')) !!}
            @if ($errors->has('dob'))
            <div class="invalid-feedback">
                {{$errors->first('dob')}}
            </div>
            @endif
        </div>
        <div class="from-group">
            {!! Form::label('email','Fecha de nacimiento') !!}
            {!! Form::email('email', null, ['class'=>'form-control'],array('required' => 'required')) !!}
            @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
            @endif
        </div>
    </div>
    <div class="card-footer clearfix">
        <button type="submit" class="btn btn-primary float-right"><i class="far fa-paper-plane"></i>
            Actualizar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')

@endsection
