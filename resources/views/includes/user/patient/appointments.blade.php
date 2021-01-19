<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">ID</th>
            <th>Especialista</th>
            <th>Fecha</th>
            <th>Estado</th>
            @if ($update)
            <th>Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($appointments as $appointment)
        <tr>
            <td>{{$appointment->id}}</td>
            <td>{{$appointment->doctor()->name}}</td>
            <td>{{$appointment->date->format('d/m/Y H:i')}}</td>
            <td>{{$appointment->status}}</td>
            @if ($update)
            <td><a href="{{route('backoffice.patient.appointments.edit', [$user, $appointment])}}">Editar</a></td>
            @endif
        </tr>
        @empty
        <tr colspan="4">No hay citas registradas</tr>
        @endforelse
    </tbody>
</table>