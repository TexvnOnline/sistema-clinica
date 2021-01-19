@extends('layouts.admin')
@section('title','Registro de rol')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.roles.index')}}">Roles</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
{{-- <div class="col-12 col-md-6 col-lg-6"> --}}
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Crear rol</h4>
        </div>
        {!! Form::open(['route'=>'backoffice.roles.store', 'method'=>'POST']) !!}
        <div class="card-body">
            @include('admin.role._form')
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Guardar</button>
            <button class="btn btn-secondary" type="reset">Cancelar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
