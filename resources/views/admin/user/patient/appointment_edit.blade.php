@extends('layouts.admin')
@section('title','Editar cita de '.$user->name)
@section('styles')
{!! Html::style('pickadate/themes/default.css') !!}
{!! Html::style('pickadate/themes/default.date.css') !!}
{!! Html::style('pickadate/themes/default.time.css') !!}
@endsection
@section('dropdown')
<a class="dropdown-item has-icon" href="{{route('backoffice.patient.schedule', $user)}}"><i class="fas fa-user-plus"></i> Agendar nueva cita</a>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios</a></li>

<li class="breadcrumb-item"><a href="{{route('backoffice.users.show', $user)}}">{{$user->name}}</a></li>

<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-9 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Editar cita de {{$user->name}}</h4>
                <div class="card-header-form">

                </div>
            </div>
            {{--  {!! Form::open(['route'=>['backoffice.patient.store_back_schedule', $user], 'method'=>'POST']) !!}  --}}
            
            {!! Form::model($appointment, ['route'=>['backoffice.patient.appointments.update',$appointment, $user],'method'=>'PUT']) !!}

            <div class="card-body">

                @include('includes.user.patient.schedule_form')  

            </div>
            <div class="card-footer text-right">
                <div class="form-row">
                    <div class="col">
                        <button class="btn btn-primary float-right" type="submit">Actualizar <i
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

{!! Html::script('otika/assets/bundles/jquery-ui/jquery-ui.min.js') !!}
<!-- Page Specific JS File -->
{!! Html::script('otika/assets/js/page/advance-table.js') !!}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $('.formulario-eliminar').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });

</script>
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
    )

</script>
@endif
@if(session('editado') == 'ok')
<script>
    Swal.fire({
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1200
    })

</script>
@endif
@if(session('guardado') == 'ok')
<script>
    Swal.fire({

        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1200
    })

</script>
@endif
@endsection
