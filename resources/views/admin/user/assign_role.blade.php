@extends('layouts.admin')
@section('styles')
{!! Html::style('otika/assets/bundles/pretty-checkbox/pretty-checkbox.min.css') !!}
@endsection
@section('title','Asignar roles')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios</a></li>
<li class="breadcrumb-item"><a href="{{route('backoffice.users.show',$user )}}">{{$user->name}}</a></li>
{{--  show de usuario   --}}
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    {{-- <div class="col-12 col-md-6 col-lg-6"> --}}
    <div class="col-lg-9 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Selecciona los roles que deseas asignar</h4>
            </div>
            {{--  AGREGAR RUTA  --}}
            {!! Form::open(['route'=>['backoffice.role_assignment',$user], 'method'=>'POST']) !!}
            <div class="card-body">
                <div class="form-group">
                    <label>Roles</label> <br>
                    @foreach ($roles as $role)
                    <div class="pretty p-icon p-curve p-pulse">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" @if ($user->has_role($role->id))
                            checked
                        @endif>
                        <div class="state p-info-o">
                            <i class="icon material-icons">done</i>
                            <label> {{$role->name}}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">Guardar</button>
                <button class="btn btn-secondary" type="reset">Cancelar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('admin.user._menu')
</div>
@endsection
