<table class="table ">
    <thead>
        <tr>
            <th style="width: 10px">ID</th>
            <th>Concepto</th>
            {{--  <th>Doctor</th>  --}}
            <th>Monto</th>
            <th>Estatus</th>
            <th
            @if (isset($user))
                colspan="2"
            @endif
            >Acción</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($invoices as $invoice)
        <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->concept()}}</td>
            {{--  <td>{{$invoice->doctor()->name}}</td>  --}}
            <td>{{$invoice->amount}}</td>
            <td>{{$invoice->status}}</td>
            <td>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"
                data-invoice="{{$invoice->id}}"
                onclick="modal_invoice(this)">
                    Ver
                </button>
            </td>
            @if (isset($user))
                <td>
                    <a href="{{route('backoffice.patient.invoices.edit',[$user, $invoice])}}">Editar</a>
                </td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="5">No tienes registrada ninguna factura</td>
        </tr>
        @endforelse

    </tbody>
</table>