@extends('layouts.admin')
@section('title','Gestión de permissions')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}

<a class="dropdown-item has-icon" href="{{route('backoffice.permissions.create')}}"><i class="fas fa-plus"></i> Agregar permiso</a>


@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')

     
        


      <div class="card">
        <div class="card-header">
          <h4>Advanced Table</h4>
          <div class="card-header-form">
            <form>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                  <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>


        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th class="text-center">
                  <div class="custom-checkbox custom-checkbox-table custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                      class="custom-control-input" id="checkbox-all">
                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                  </div>
                </th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
                <th >Acciones</th>
              </tr>
              @foreach ($permissions as $permission)
              <tr>
                  <td class="p-0 text-center">
                    <div class="custom-checkbox custom-control">
                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                        id="checkbox-1">
                      <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                    </div>
                  </td>
                  <td>{{$permission->id}}</td>
                  <td>{{$permission->name}}</td>
                  <td><a href="{{route('backoffice.roles.show', $permission->role)}}">{{$permission->role->name}}</a></td>
                  <td>{{$permission->description}}</td>
                  <td>{{$permission->created_at}}</td>
                    <td >
                        {!! Form::open(['route'=>['backoffice.permissions.destroy',$permission->id], 'method'=>'DELETE', 'class'=>'formulario-eliminar']) !!}
                            <a  href="{{route('backoffice.permissions.edit', $permission->id)}}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                            <a  href="{{route('backoffice.permissions.show', $permission->id)}}" class="btn btn-icon btn-secondary"><i class="fas fa-eye"></i></a>
                            <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></button>
                        {!! Form::close() !!}
                    </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>

        <div class="card-footer text-right">
          <nav class="d-inline-block">
            {{$permissions->render()}}
          </nav>
        </div>

      </div>




      
@endsection
@section('scripts')
{!! Html::script('otika/assets/bundles/jquery-ui/jquery-ui.min.js') !!}
<!-- Page Specific JS File -->
{!! Html::script('otika/assets/js/page/advance-table.js') !!}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>

  $('.formulario-eliminar').submit(function(e){
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
        {{--  position: 'top-end',  --}}
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
