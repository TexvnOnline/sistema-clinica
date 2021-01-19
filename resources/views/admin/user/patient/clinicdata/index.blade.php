@extends('layouts.admin')
@section('title','Historia clínica de '.$user->name)
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="{{route('backoffice.patient.schedule', $user)}}"><i
    class="fas fa-user-plus"></i> Agendar nueva cita</a> --}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios del sistema</a></li>
<li class="breadcrumb-item"><a href="{{route('backoffice.users.show', $user)}}">{{$user->name}}</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-9 col-md-12 col-12 col-sm-12">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Historia clínica</h4>
                    </div>
                    <div class="card-body">

                        <p><strong>Fecha de alta: </strong>
                            {{ carbon_format($user->clinic_data('check_in', $datas), 'd/m/Y') }}</p>
                        <p><strong>Escolaridad: </strong>{{ $user->clinic_data('scholarship', $datas) }}</p>

                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">

                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Notas de evolución</h4>
                    </div>
                    {!! Form::open(['route'=>['backoffice.clinic_note.store', $user], 'method'=>'POST']) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Escribe la nota médica aquí</label>
                            {!! Form::textarea('description', null,['class'=>'form-control']) !!}
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Selecciona la opción de privacidad</label>
                            <select class="form-control" id="privacy" name="privacy">
                                <option value="" disabled selected>Selecciona la opción de privacidad</option>
                                <option value="public">Pública</option>
                                <option value="private">Privada</option>
                            </select>

                            @error('privacy')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Guardar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                {{--  LISTADO DE NOTAS   --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Notas de evolución</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Información</th>
                                <th scope="col">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($clinic_notes as $note)
                                <tr>
                                    <td>
                                        <p>Creado por <b>{{ $note->creator->name }}</b> el
                                            <b>{{ carbon_format($note->date, 'd/m/Y') }}</b> a las
                                            <b>{{ carbon_format($note->date, 'H:i') }}</b></p>
                                        <b>Descripción: </b> {!! $note->description !!}
                                    </td>
                                    <td>
                                        <p>

                                            <button 
                                                type="button" 
                                                class="btn btn-info" 
                                                data-toggle="modal"  
                                                data-target="#modal" 
                                                data-note="{{ $note->id }}" 
                                                onclick="modal_note(this)"
                                            >Editar
                                            </button>

                                            

                                        </p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No hay notas registradas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        {{--  <button class="btn btn-primary mr-1" type="submit">Guardar</button>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.user._menu')
</div>
@endsection
@section('modal')
    {{--  VENTANA MODAL PARA EDICION  --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modal_note_edit_form" action="" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea id="modal_note_description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="row">
                        <div class="col s8">
                            <div class="form-group">
                                <select class="form-control" id="modal_note_privacy" name="privacy">
                                    <option value="public">Pública</option>
                                    <option value="private">Privada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s4">
                            <div class="row">
                                <div class="form-group col s12">
                                    <button class="btn btn-primary right" type="submit" style="width: 100%">
                                    <i class="fas fa-pen"></i>
                                    Actualizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('otika/assets/bundles/jquery-ui/jquery-ui.min.js') !!}
<!-- Page Specific JS File -->
{!! Html::script('otika/assets/js/page/advance-table.js') !!}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
 

    function modal_note(e)
    {
        var note_id = $(e).data('note');
        $.ajax({
            url: "{{ route('ajax.note_info') }}",
           
            data:
            {
                note_id: note_id,
            },
            success: function(data)
            {
                $("#modal_note_edit_form").attr('action', data.route);
                $("#modal_note_description").val(data.description);
                $("#modal_note_privacy").val(data.privacy);
                // re-initialize material-select DA UN ERROR
                   // $('#modal_note_privacy').material_select();
            }
        });
    }

</script>

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
