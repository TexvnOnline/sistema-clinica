@extends('layouts.admin')
@section('title','Detalles de usuario')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}
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
                <h4>Detalles de usuario {{$user->name}}</h4>
            </div>
            <div class="card-body">
                <p><strong>Nombre: </strong>{{$user->name}}</p>
                <p><strong>Edad: </strong>{{$user->age()}}</p>
                <p><strong>Roles: </strong>{{$user->list_roles()}}</p>
                @if ($user->has_role(config('app.doctor_role')))
                <p><strong>Especialidades: </strong>{{$user->list_specialities()}}</p>
                @endif
            </div>
            <div class="card-footer text-right">
                <a href="{{route('backoffice.users.index')}}" class="btn btn-secondary" type="reset">Regresar</a>
            </div>
        </div>
    </div>
    @include('admin.user._menu')
</div>
@endsection
@section('scripts')
{!! Html::script('otika/assets/bundles/jquery-ui/jquery-ui.min.js') !!}
<!-- Page Specific JS File -->
{!! Html::script('otika/assets/js/page/advance-table.js') !!}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
