
    function modal_invoice(e){
        var invoice_id = $(e).data('invoice');
        $.ajax({
            url: "{{route('ajax.invoice_info')}}",
            method: 'GET',
            data: {
                invoice_id: invoice_id,
            },
            success: function(data){
                
                $('#modal_invoice_id').html(data.invoice.id);
                $('#modal_invoice_doctor').html(data.doctor.name);
                $('#modal_invoice_concept').html(data.concept);
                $('#modal_invoice_amount').html(data.invoice.amount);
            }
        });
    }