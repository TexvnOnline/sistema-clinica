@extends('layouts.admin')
@section('title','Importar usuarios')
@section('styles')
{!! Html::style('otika/assets/bundles/dropzonejs/dropzone.css') !!}
@endsection
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
        <h4>Seleccionar un archivo de Excel.</h4>
    </div>
    <div class="card-body">

        <form action="{{route('backoffice.users.make_import')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" />
            <button class="btn btn-primary mr-1" type="submit" >Guardar</button>
        </form>
        {{-- {!! Form::open(['route'=>'backoffice.users.make_import', 'method'=>'POST', 'enctype'=>'multipart/form-data',
        'id'=>'mydropzone', 'class'=>'dropzone']) !!} --}}
        {{-- <div class="fallback">
            <input type="file" name="file" />
        </div>
        {!! Form::close() !!} --}}
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit" form="mydropzone">Guardar</button>
        <button class="btn btn-secondary" type="reset">Cancelar</button>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('otika/assets/bundles/dropzonejs/min/dropzone.min.js') !!}
{!! Html::script('otika/assets/js/page/multiple-upload.js') !!}
@endsection
