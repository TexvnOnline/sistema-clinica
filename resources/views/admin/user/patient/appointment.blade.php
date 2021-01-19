@extends('layouts.admin')
@section('title','Citas de '.$user->name)
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
                <h4>Citas de {{$user->name}}</h4>
                <div class="card-header-form">
                    {{--  <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>  --}}
                </div>
            </div>
            <div class="card-body">
                    @include('includes.user.patient.appointments',[
                        'update' => true
                    ])
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                   
                </nav>
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
