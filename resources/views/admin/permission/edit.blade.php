@extends('layouts.admin')
@section('title','Editar permiso '.$permission->name)
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}


@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.permissions.index')}}">Permisos</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
{{-- <div class="col-12 col-md-6 col-lg-6"> --}}
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Editar permiso {{$permission->name}}</h4>
      </div>
      {!! Form::model($permission, ['route'=>['backoffice.permissions.update',$permission],'method'=>'PUT']) !!}
        <div class="card-body">
            @include('admin.permission._form')
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Actualizar</button>
            <a href="{{route('backoffice.permissions.index')}}" class="btn btn-secondary" >Cancelar</a>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection