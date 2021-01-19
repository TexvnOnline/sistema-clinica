@extends('layouts.admin')
@section('title','Detalles de permiso')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}


@endsection
@section('breadcrumb')
{{--  <li class="breadcrumb-item"><a href="{{route('backoffice.roles.index')}}">Roles del sistema</a></li>  --}}
<li class="breadcrumb-item"><a href="{{route('backoffice.permissions.index')}}">Permisos</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
{{-- <div class="col-12 col-md-6 col-lg-6"> --}}
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Detalles de permiso {{$permission->name}}</h4>
      </div>
        <div class="card-body">
            <p><strong>Nombre: </strong>{{$permission->name}}</p>
            <p><strong>Slug: </strong>{{$permission->slug}}</p>
            <p><strong>Rol al que pertenece: </strong>{{$permission->role->name}}</p>
            <p><strong>Descripción: </strong>{{$permission->description}}</p>
        </div>
        <div class="card-footer text-right">
            <a href="{{route('backoffice.permissions.index')}}" class="btn btn-secondary" type="reset">Regresar</a>
        </div>
    </div>
</div>
<h1></h1>
@endsection