@extends('layouts.main')
@section('styles')
@endsection
@section('name.user', $user->name)
@section('dob.user', $user->age())
@section('email.user', $user->email)
@section('date.user', $user->created_at->diffForHumans())
@section('title','Modificar contraseña')
@section('header','Modificar contraseña')
@section('nav')
<li class="nav-item">
    <a href="#" class="nav-link">Contact</a>
</li>
@endsection
@section('content.profile')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modificar contraseña</h3>
    </div>
    {!! Form::model($user, ['route'=>['frontoffice.user.change_password'],'method'=>'PUT']) !!}
    <div class="card-body">

        <div class="from-group">
            {!! Form::label('old_password','Contraseña actual') !!}
            {!! Form::password('old_password', ['class'=>'form-control'],array('required' => 'required')) !!}
            @if ($errors->has('old_password'))
            <div class="invalid-feedback">
                {{$errors->first('old_password')}}
            </div>
            @endif
        </div>

        <div class="from-group">
            {!! Form::label('password','Nueva contraseña') !!}
            {!! Form::password('password', ['class'=>'form-control'],array('required' => 'required')) !!}
            @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{$errors->first('password')}}
            </div>
            @endif
        </div>

        <div class="from-group">
            {!! Form::label('password_confirmation','Confirmar contraseña') !!}
            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
        </div>

    </div>
    <div class="card-footer clearfix">
        <button type="submit" class="btn btn-primary float-right"><i class="far fa-paper-plane"></i>
            Actualizar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
{!! Html::script('otika/assets/bundles/jquery-ui/jquery-ui.min.js') !!}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(session('guardado') == 'ok')
<script>
    Swal.fire({

        icon: 'success',
        title: 'Contraseña actualizada correctamente',
        showConfirmButton: false,
        timer: 1200
    })

</script>
@endif
@endsection
