{{--  SOLUCIONAR EL PROBLEMA DE QUE NO SE MUESTRA EL MODAL data-backdrop="false" --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_invoice_title">Información de la factura</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Folio: </strong> <span id="modal_invoice_id"></span></p>
                <p><strong>Doctor: </strong> <span id="modal_invoice_doctor"></span></p>
                <p><strong>Concepto: </strong> <span id="modal_invoice_concept"></span></p>
                <p><strong>Monto: </strong> <span id="modal_invoice_amount"></span></p>
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Imprimir</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>