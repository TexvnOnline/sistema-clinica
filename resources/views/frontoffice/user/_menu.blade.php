<div class="card card-primary">
    {{--  <div class="card-header">
        <h3 class="card-title">About Me</h3>
    </div>  --}}
    <!-- /.card-header -->
    <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.user.profile')) !!}"
            href="{{route('frontoffice.user.profile')}}">
            Perfil
        </a>
        @if (auth()->user()->has_role(config('app.patient_role')))
        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.patient.schedule')) !!}"
            href="{{route('frontoffice.patient.schedule')}}">
            Agendar cita
        </a>
        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.patient.appointments')) !!}" href="{{route('frontoffice.patient.appointments')}}">
            Mis citas
        </a>
        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.patient.prescriptions')) !!}" href="{{route('frontoffice.patient.prescriptions')}}">
            Recetas
        </a>
        @endif

        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.patient.invoices')) !!}" href="{{route('frontoffice.patient.invoices')}}">
            Facturación
        </a>
        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.user.edit', [auth()->user()])) !!}" href="{{route('frontoffice.user.edit', [auth()->user(), 'view=frontoffice'])}}">
            Editar perfil
        </a>
        <a class="list-group-item list-group-item-action {!! active_class(route('frontoffice.user.edit_password')) !!}" href="{{route('frontoffice.user.edit_password')}}">
            Modificar contraseña
        </a>
    </div>
    <!-- /.card-body -->
</div>
