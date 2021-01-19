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
        <table class="table ">
            <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Especialista</th>
                    <th>Acción </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Update software</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                            Ver
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{--  <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>  --}}
    </div>
</div>



<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Large Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Imprimir</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
  </div>

@endsection

@section('scripts')

@endsection
