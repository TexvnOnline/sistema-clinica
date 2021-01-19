@extends('layouts.admin')
@section('title','Detalles de rol')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}


@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.roles.index')}}">Roles</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    {{-- <div class="col-12 col-md-6 col-lg-6"> --}}
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Detalles de rol {{$role->name}}</h4>
            </div>
            <div class="card-body">
                <p><strong>Nombre: </strong>{{$role->name}}</p>
                <p><strong>Slug: </strong>{{$role->slug}}</p>
                <p><strong>Descripción: </strong>{{$role->description}}</p>
            </div>
            {{--  <div class="card-footer text-right">
          <button class="btn btn-secondary" type="reset">Regresar</button>
      </div>  --}}
        </div>

        {{--  <div class="card">
    <div class="card-header">
      <h4>Usuarios</h4>
    </div>
      <div class="card-body">
        @foreach ($role->users as $user)
        <p><strong>Nombre: </strong>{{$user->name}}</p>
        @endforeach
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-secondary" type="reset">Regresar</button>
    </div>
</div> --}}

</div>

<div class="col-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Permisos</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción </th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role->permissions as $permission)
                    <tr>
                        <th scope="row">{{$permission->id}}</th>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->description}}</td>
                        <td>
                            {!! Form::open(['route'=>['backoffice.permissions.destroy',$permission->id],
                            'method'=>'DELETE', 'class'=>'formulario-eliminar']) !!}
                            <a href="{{route('backoffice.permissions.edit', $permission->id)}}"
                                class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>

                            <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{--  <div class="card-footer text-right">
        <button class="btn btn-secondary" type="reset">Regresar</button>
    </div>  --}}
    </div>
</div>
</div>
@endsection
