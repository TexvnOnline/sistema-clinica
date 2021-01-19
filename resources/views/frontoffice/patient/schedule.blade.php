@extends('layouts.main')
@section('styles')
{!! Html::style('pickadate/themes/default.css') !!}
{!! Html::style('pickadate/themes/default.date.css') !!}
{!! Html::style('pickadate/themes/default.time.css') !!}
@endsection
@section('name.user', $user->name)
@section('dob.user', $user->age())
@section('email.user', $user->email)
@section('date.user', $user->created_at->diffForHumans())
@section('title','Citas')
@section('header','Citas')
@section('nav')
<li class="nav-item">
    <a href="#" class="nav-link">Contact</a>
</li> 
@endsection
@section('content.profile')
{!! Form::open(['route'=>'frontoffice.patient.store_schedule', 'method'=>'POST']) !!}
    @include('includes.user.patient.schedule_form')
    <div class="form-row">
        <div class="col">
            <button class="btn btn-primary float-right" type="submit">Agendar <i
                    class="far fa-paper-plane"></i></button>
        </div>
    </div>
{!! Form::close() !!}
@endsection
@section('scripts')
@include('includes.user.patient.schedule_foot')
@endsection
