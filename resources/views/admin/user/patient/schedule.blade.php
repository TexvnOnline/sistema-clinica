@extends('layouts.admin')
@section('title','Agendar cita')
@section('styles')
{!! Html::style('pickadate/themes/default.css') !!}
{!! Html::style('pickadate/themes/default.date.css') !!}
{!! Html::style('pickadate/themes/default.time.css') !!}
@endsection
@section('dropdown')
<a class="dropdown-item has-icon" href="{{route('backoffice.users.edit',$user)}}"><i class="fas fa-user-edit"></i>
    Editar usuario</a>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-9 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Agendar cita</h4>
            </div>
            {!! Form::open(['route'=>['backoffice.patient.store_back_schedule', $user], 'method'=>'POST']) !!}
            <div class="card-body">
                @include('includes.user.patient.schedule_form')
            </div>
            <div class="card-footer text-right">
                <div class="form-row">
                    <div class="col">
                        <button class="btn btn-primary float-right" type="submit">Agendar <i
                                class="far fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('admin.user._menu')
</div>
@endsection
@section('scripts')
@include('includes.user.patient.schedule_foot')
@endsection