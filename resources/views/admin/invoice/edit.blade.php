@extends('layouts.admin')
@section('title','Editar factura '.$invoice->id)
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}


@endsection
@section('breadcrumb')
{{--  <li class="breadcrumb-item"><a href="{{route('backoffice.permissions.index')}}">Permisos</a></li>  --}}
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
{{-- <div class="col-12 col-md-6 col-lg-6"> --}}
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Editar factura</h4>
      </div>
      {!! Form::model($invoice, ['route'=>['backoffice.patient.invoices.update',$user,$invoice],'method'=>'PUT']) !!}
        <div class="card-body">
            

             
             
            

            <div class="form-group">
                <label>Monto de la factura</label>
                {!! Form::text('amount', null, ['class'=>'form-control']) !!}
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Estatus</label>
                {{--  {!! Form::select('status', $roles ,null, ['class'=>'form-control'] ) !!}  --}}
                <select name="status" class="form-control">
                    <option value="pending"
                    @if ($invoice->status == 'pending')
                        selected
                    @endif
                    >Pendiente</option>
                    <option value="approved"
                    @if ($invoice->status == 'approved')
                    selected
                    @endif
                    >Pagado</option>
                    <option value="rejected"
                    @if ($invoice->status == 'rejected')
                    selected
                    @endif
                    >Rechazado</option>
                    <option value="cancelled"
                    @if ($invoice->status == 'cancelled')
                    selected
                    @endif
                    >Cancelado</option>
                    <option value="refunded"
                    @if ($invoice->status == 'refunded')
                    selected
                    @endif
                    >Devolución</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            


        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Actualizar</button>
            <a href="{{route('backoffice.permissions.index')}}" class="btn btn-secondary" >Cancelar</a>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection