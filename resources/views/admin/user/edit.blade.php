@extends('layouts.admin')
@section('title','Editar '. $user->name)
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}


@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios del sistema</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
{{-- <div class="col-12 col-md-6 col-lg-6"> --}}
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Editar {{$user->name}}</h4>
        </div>
        {!! Form::model($user, ['route'=>['backoffice.users.update',$user->id],'method'=>'PUT']) !!}
        <div class="card-body">
            @include('admin.user._form')
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Actualizar</button>
            <button class="btn btn-secondary" type="reset">Cancelar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
