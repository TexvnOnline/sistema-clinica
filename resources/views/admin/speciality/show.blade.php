@extends('layouts.admin')
@section('title','Detalles de Especialidad '.$speciality->name)
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}

{{--  MODIFICAR ICONO DE EDICION  --}}
<a class="dropdown-item has-icon" href="{{route('backoffice.speciality.edit', $speciality)}}"><i class="far fa-heart"></i> Editar</a> 

@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.speciality.index')}}">Especialidades</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    {{-- <div class="col-12 col-md-6 col-lg-6"> --}}
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>{{$speciality->name}}</h4>
            </div>
            <div class="card-body">
                <p><strong>Nombre: </strong>{{$speciality->name}}</p>
            </div>
            <div class="card-footer text-right">
                {!! Form::open(['route'=>['backoffice.speciality.destroy',$speciality], 'method'=>'DELETE',
                'class'=>'formulario-eliminar']) !!}
                <button class="btn btn-secondary mr-2" type="submit">Eliminar</button>
                <a href="{{route('backoffice.speciality.edit', $speciality)}}" class="btn btn-primary"
                    type="reset">Editar</a>
                {!! Form::close() !!}
            </div>
        </div>
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
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{route('backoffice.users.show', $user)}}"
                                    class="btn btn-icon btn-secondary"><i class="fas fa-eye"></i></a>

                                <a href="{{route('backoffice.users.edit', $user)}}" class="btn btn-icon btn-primary"><i
                                        class="far fa-edit"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No hay médicos registrados</td>
                        </tr>
                        @endforelse
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
