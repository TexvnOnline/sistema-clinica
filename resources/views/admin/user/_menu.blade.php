<div class="col-lg-3 col-md-12 col-12 col-sm-12">
    <div class="list-group">
        <a href="{{route('backoffice.users.show', $user->id)}}" class="list-group-item list-group-item-action active">
            {{$user->name}}
        </a>
        @if (Auth::user()->has_any_role([
            config('app.secretary_role'),
            config('app.admin_role'),
            config('app.doctor_role'),
            ]))
            @if ($user->has_role(config('app.patient_role')))
            
            {{--  VALIDAR  --}}

            <a href="{{route('backoffice.clinic_data.index', $user)}}"
            class="list-group-item list-group-item-action">Historia clínica</a>

            {{--  VALIDAR  --}}

            <a href="{{route('backoffice.patient.schedule', $user)}}"
            class="list-group-item list-group-item-action">Agendar cita</a>

            <a href="{{route('backoffice.patient.appointments', $user)}}"
            class="list-group-item list-group-item-action">Citas</a>

            <a href="{{route('backoffice.patient.invoices', $user)}}"
            class="list-group-item list-group-item-action">Facturas</a>

            @endif

            @if ($user->has_role(config('app.doctor_role')))
            <a href="{{route('backoffice.doctor.appointments.show', $user)}}"
            class="list-group-item list-group-item-action">Citas</a>
            {{--  GESTION DE HORARIO  --}}
            <a href="{{route('backoffice.doctor.schedule.assign', $user)}}"
            class="list-group-item list-group-item-action">Gestión de horarios</a>

            @endif

        @endif
        @if (Auth::user()->has_role(config('app.admin_role')))
        <a href="{{route('backoffice.assign_role', $user)}}" class="list-group-item list-group-item-action">Asignar
            roles</a>
        <a href="{{route('backoffice.assign_permission', $user)}}"
            class="list-group-item list-group-item-action">Asignar permisos</a>

            @if ($user->has_role(config('app.doctor_role')))
            <a href="{{route('backoffice.user.assign_speciality', $user)}}"
            class="list-group-item list-group-item-action">Asignar especialidad</a>
            @endif

        @endif
        
    </div>
</div>
