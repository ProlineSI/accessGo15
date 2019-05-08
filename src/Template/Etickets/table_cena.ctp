<?= $this->Html->css(['table.css']) ?>

<!--MODAL DE PLANTILLAS DE TICKET-->
<div id="modalEticketIngreso" tabindex="-1" role="dialog" aria-hidden="true" aria-labbeledby="ticketTypesModal"
    class="modal fade">
    <div class="modal-dialog modal-sm" id="modalTicketTypes">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modalEticketTitle">Ingresar E-Ticket</h4>
            </div>
            <div class="modal-body ">

                <?= $this->Form->create() ?>
                <div class = "row modalLabelEticket">
                    <label id = "nombreEticket"></label>
                </div>
                <div class = "row modalLabelEticket">
                    <label id = "escaneosRestantesEticket"></label>
                </div>
                <fieldset>
                    <div class="input-group input-plus-minus-container">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-number btn-plus-minus" data-type="minus"
                                data-field="cantidadIngreso">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input readonly type="text" name="cantidadIngreso"
                            class="form-control input-number input-plus-minus"
                            value="1" min="1" max="5" id = "cantidadIngreso">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-number btn-plus-minus" data-type="plus"
                                data-field="cantidadIngreso">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>

                </fieldset>
                <?= $this->Form->end();?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-acept" type="button" onClick='ingresarEticket()'>Ingresar</button>
                <button data-dismiss="modal" class="btn btn-default" type="submit">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--FIN MODAL DE PLANTILLA DE TICKETS-->
<div class="col-md-12 col-sm-12 col-xs-12 table-container">
    <table id="table-despues-cena" class="table table-accessGo">
        <thead class='head'>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Whatsapp</th>
                <th>Mesa</th>
                <th>Cantidad Personas</th>
                <!--<th>Invitación Enviada</th>-->
                <th>Confirmación</th>
                <th id='acciones'>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
<?php 
    if($event->wp_msg != null){
        $msg = $event->wp_msg;
    }else{
        $msg = 'Te invito a mi Evento, confirmá tu asistencia y descargá tu entrada utilzando AccessGo:';
    }
?>
<script>
var token = <?= json_encode($this->request->param('_csrfToken')) ?>;


var table = $('#table-despues-cena').DataTable({
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],               
    dom: 'lBfrtip',            
    	"buttons": [  
            { extend: 'excel', className: 'excelButton', filename: 'Planilla Invitados a Cena <?= $event->name?>', text: 'Descargar Excel' },
            { extend: 'pdf', className: 'pdfButton', filename: 'Planilla Invitados a Cena <?= $event->name?>', text: 'Descargar PDF' }
    ],
    responsive: true,
    processing: true,
    serverSide: false,
    bInfo: false,
    language: {
        url: baseUrl + 'js/datatable/Spanish.json',
        searchPlaceholder: 'Buscar Invitado..'
    },
    aaSorting: [],
    ajax: {
        url: baseUrl + 'etickets/getEticketsCena',
        dataSrc: "",
    },
    columns: [{
            data: 'name',
            responsivePriority: 1
        },
        {
            data: 'surname',
            responsivePriority: 1
        },
        {
            data: 'cellphone'
        },
        { data: 'mesa' , responsivePriority: 2},
        { data: 'quantity', responsivePriority: 2},
        /*{
            data: 'sent',
            "render": function(data, type, row) {
                if (row.sent == false) {
                    return 'No';
                } else {
                    return 'Sí';
                }
            }
        },*/
        {
            data: 'confirmation',
            "render": function(data, type, row) {
                if (row.confirmation == false) {
                    return 'No';
                } else {
                    return 'Sí';
                }
            }, responsivePriority: 2
        },
        {
            data: 'Acciones',
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta) {
                var a = "   <a class='accessGoBtn' href='edit/" + row.id +
                    "' title='Editar Invitado'><span class = 'edit glyphicon glyphicon-pencil'></span></a>" +
                    "   <a class='accessGoBtn' onClick = 'deleteEticket(" + row.id +
                    ")' title='Eliminar Invitado'><span class = 'delete glyphicon glyphicon-remove'></span></a>";
                a = a + '<a  target="_blank" title = "ingresoBtn" onClick = "ingresar(' + meta.row +
                    ')"><?= $this->Html->image("./svg/ingreso.svg", ["class" => "ingreso-btn", "alt" => "ingresar"]);?></a>';
                if (row.cellphone != null) {
                    a = a +
                        '<a  target="_blank" title="Enviar url de entrada o confirmación por wpp" href="https://wa.me/549' +
                        row.cellphone + '?text=' + '<?= $msg?>' +
                        ' https://ev.accessgo.com.ar/invitados/confirmation/' + row.qr +
                        ' (Si no podés ver el link, te pedimos que respondas el mensaje)">' +
                        '<?= $this->Html->image("./svg/WhatsApp.svg", ["class" => "whatsapp-logo", "alt" => "Whatsapp"]);?>' +
                        '</a>';
                }
                
                return a;
            }   ,
            responsivePriority: 1
        }
    ]
});

//var openConfirmModal = function(eticket_id){
//    $("#confirmModal").modal({show:true});
//    $("#confirmBtn").on('click', function(){
//        deleteEticket(eticket_id);
//    })
//}

var deleteEticket = function(eticket_id) {
    confirm("Está seguro que desea eliminar invitado?");
    $.ajax({
            type: 'POST',
            url: baseUrl + 'etickets/delete',
            data: {
                "id": eticket_id
            },
            beforeSend: function(xhr) { //Agregar esta línea cuando las peticiones post den error
                xhr.setRequestHeader('X-CSRF-Token', token);
            }
        })
        .done(function(data) {
            if ('errors' in data) {
                alertify.error(data['errors']);
            } else {
                $("#confirmModal").modal('hide');
                table.ajax.reload();
                alertify.success(data['result']);
            }

        })
        .fail(function(data) {
            console.log(data);
            alertify.error(data);
        });
};

var eticket = new Array();

var ingresar = function(id) {
    var max = table.row(id).data()['quantity'] - table.row(id).data()['scanCount'];
    eticket['qr'] = table.row(id).data()['qr'];
    eticket['event_id'] = table.row(id).data()['event_id'];
    $('.btn-plus-minus').removeAttr("disabled");
    $('#cantidadIngreso').val(1);
    $('#nombreEticket').text(table.row(id).data()['name'] + ' ' + table.row(id).data()['surname']);
    $('#escaneosRestantesEticket').text('Ingresados: '+ table.row(id).data()['scanCount'] + '/' + table.row(id).data()['quantity']);
    $('#cantidadIngreso').attr({
       "max" : max,        // substitute your own
       "min" : 1          // values (or variables) here
    });
    $('#modalEticketIngreso').modal().show();
}

var ingresarEticket = function(){
    eticket['quantity'] =  $('#cantidadIngreso').val();
    $.ajax({
            type: 'POST',
            url: baseUrl + 'etickets/ingresarBackOffice',
            data: {qr: eticket['qr'], event_id: eticket['event_id'], quantity: eticket['quantity']},
            beforeSend: function(xhr) { //Agregar esta línea cuando las peticiones post den error
                xhr.setRequestHeader('X-CSRF-Token', token);
            }
        })
        .done(function(data) {
            if ('errors' in data) {
                alertify.error(data['errors']);
            } else {
                table.ajax.reload();
                $("#modalEticketIngreso").modal('hide');
                alertify.success(data['result']);
            }

        })
        .fail(function(data) {
            console.log(data);
            alertify.error(data);
        });
}

$('.input-number').focusin(function() {
    $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alertify.warning('El valor de una de las solicitudes es demasiado alto.');
        $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
        alertify.warning('El valor de una de las solicitudes es demasiado bajo.');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
$('.btn-number').click(function(e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus') {

            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if (type == 'plus') {

            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
</script>