@extends('layouts.admin')
@section('styles')
{!! Html::style('otika/assets/bundles/pretty-checkbox/pretty-checkbox.min.css') !!}

{!! Html::style('multiple_dates_picker/jquery-ui.multidatespicker.css') !!}

@endsection
@section('title','Gestión de horarios')
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>  --}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('backoffice.users.index')}}">Usuarios</a></li>
<li class="breadcrumb-item"><a href="{{route('backoffice.users.show',$user )}}">{{$user->name}}</a></li>
{{--  show de usuario   --}}
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    {{-- <div class="col-12 col-md-6 col-lg-6"> --}}
    <div class="col-lg-9 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Establecer los horarios para el medico</h4>
            </div>
            {{--  AGREGAR RUTA  --}}
            
            {!! Form::open(['route'=>['backoffice.doctor.schedule.assignment',$user], 'method'=>'POST']) !!}

            <div class="card-body">
                


                <div class="form-group">
                    <label for="days_off">Días de asueto</label>
                    <input id="multi_date_input" name="multi_date_input" id="days_off" type="text" placeholder="Seleccione los días de asueto y vacaciones" class="form-control">
                </div>




                <div class="form-group">
                    <label>Días no laborables</label>
                    <select class="form-control" id="week_days_off" name="week_days_off[]" required="" multiple>

                        <option value="" disabled selected>Selecciona los días no laborables</option>
                        <option value="1">Domingo</option>
                        <option value="2">Lunes</option>
                        <option value="3">Martes</option>
                        <option value="4">Miércoles</option>
                        <option value="5">Jueves</option>
                        <option value="6">Viernes</option>
                        <option value="7">Sábado</option>
                        
                    </select>
                        
                </div>



                @foreach($days as $key => $day)
                    <div class="row">
                        <div class="col s2">
                            <p>{{ $day }}</p>
                        </div>
                        <div class="col s2">
                            <input id="{{ $key }}-turn_a_in" type="time" name="{{ $key }}-turn_a_in">
                            <label for="{{ $key }}-turn_a_in">Turno A Entrada</label>
                        </div>
                        <div class="col s2">
                            <input id="{{ $key }}-turn_a_out" type="time" name="{{ $key }}-turn_a_out">
                            <label for="{{ $key }}-turn_a_out">Turno A Salida</label>
                        </div>
                        <div class="col s2">
                            <input id="{{ $key }}-turn_b_in" type="time" name="{{ $key }}-turn_b_in">
                            <label for="{{ $key }}-turn_b_in">Turno B Entrada</label>
                        </div>
                        <div class="col s2">
                            <input id="{{ $key }}-turn_b_out" type="time" name="{{ $key }}-turn_c_out">
                            <label for="{{ $key }}-turn_b_out">Turno B Salida</label>
                        </div>
                    </div>
                @endforeach


               

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">Guardar</button>
                <button class="btn btn-secondary" type="reset">Cancelar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @include('admin.user._menu')
</div>
@endsection
@section('scripts')
{!! Html::script('multiple_dates_picker/jquery-ui.multidatespicker.js') !!}

<script type="text/javascript">
    $('#multi_date_input').multiDatesPicker({
        dateFormat: "yy/m/d-",
    });
</script>

@endsection
