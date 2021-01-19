@extends('layouts.admin')
@section('title','Historia clínica '. $user->name)
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
            <h4>Actualizar datos de hostia clínica del usuario</h4>
        </div> 
        {!! Form::open(['route'=>['backoffice.clinic_data.store', $user], 'method'=>'POST']) !!}
        <div class="card-body">
           
            <div class="form-group">
                <label>Fecha de alta</label>

                <input
                id="check_in"
                type="date"
                name="check_in"
                value="{{ $user->clinic_data('check_in', $datas) }}"
                class="form-control"
                >
                @error('check_in')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Escolaridad</label>

                <input
                id="scholarship"
                type="text"
                name="scholarship"
                value="{{ $user->clinic_data('scholarship', $datas) }}"
                class="form-control"
                >
                @error('scholarship')
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
</div>
@endsection
