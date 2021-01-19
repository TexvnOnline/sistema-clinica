@extends('layouts.main')
@section('styles')
@endsection
@section('name.user', $user->name)
@section('dob.user', $user->age())
@section('email.user', $user->email)
@section('date.user', $user->created_at->diffForHumans())
@section('title','Recetas')
@section('header','Recetas')
@section('nav')
<li class="nav-item">
    <a href="#" class="nav-link">Contact</a>
</li>
@endsection
@section('content.profile')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Historial de recetas</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @include('includes.user.patient.invoice_table')
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        
    </div>
</div>

@include('includes.user.patient.invoice_modal')

@endsection

@section('scripts')
<script>

    @include('includes.user.patient.invoice_foot')

</script>
@endsection
