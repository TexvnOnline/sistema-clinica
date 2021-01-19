<div class="form-row">
    @if (!isset($appointment))

        @if (user()->has_role(config('app.doctor_role')))
            <input type="hidden" name="doctor" value="{{user()->id}}">
        @else
        <div class="col">
            <label class="my-1 mr-2">Selecciona la especialidad</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">
                        <i class="fas fa-user-tag"></i>
                    </label>
                </div>
                <select name="speciality" id="speciality" class="custom-select">
                    <option selected>-- Seleccionar especialidad --</option>
                    @foreach ($specialities as $speciality)
                    <option value="{{$speciality->id}}">{{$speciality->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <label class="my-1 mr-2">Selecciona doctor</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">
                        <i class="fas fa-user-md"></i>
                    </label>
                </div>
                <select name="doctor" id="doctor" class="custom-select">
                    <option selected>-- Primero selecciona una especialidad --</option>
                    <option value="1">One</option>
                </select>
            </div>
        </div>
        @endif

    @else

    <div class="col">
        <label class="my-1 mr-2">Selecciona el estatus de la cita</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text">
                    <i class="fas fa-clock"></i>
                </label>
            </div>
            <select name="status" id="status" class="custom-select">
                <option selected>-- Selecciona el estatus de la cita --</option>
                <option value="pending" 
                @if ($appointment->status == 'pending')
                    selected
                @endif
                >Pendiente</option>
                <option value="done"
                @if ($appointment->status == 'done')
                    selected
                @endif
                >Terminada</option>
                <option value="cancelled"
                @if ($appointment->status == 'cancelled')
                    selected
                @endif
                >Cancelada</option>
            </select>
        </div>
    </div>
    @endif
</div>
<div class="form-row">
    <div class="col">
        <label for="datepiker">Seleccione una fecha</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="text" name="date" class="datepiker form-control" 
            @if (isset($appointment))
                data-value="{{$appointment->date->format('Y-m-d')}}"
            @endif
            >
        </div>
    </div>
    <div class="col">
        <label for="timepiker">Seleccione un horario</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-clock"></i>
                </span>
            </div>
            <input type="text" name="time" class="timepiker form-control"
            @if (isset($appointment))
                data-value="{{$appointment->date->format('H:i')}}"
            @endif
            >
        </div>
    </div>
</div>
<input type="hidden" name="user_id" value="{{ encrypt($user->id) }}">