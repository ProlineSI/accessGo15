<?= $this->Html->css(['table.css']) ?>

<!--Modal confirmacion de eliminacion de invitado 
<div id="confirmModal" tabindex="-1" role="dialog" aria-hidden="true" aria-labbeledby="confirmModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div style='font-size: 20px;'>Desea eliminar el usuario?</div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-acept" type="btn" id='confirmBtn'>Confirmar</button>
                    <button data-dismiss="modal" class="btn btn-danger" type="btn" id='cancelBtn'>Cancelar</button>
            </div>
        </div>
    </div>
</div>
Fin modal -->

<div class="col-md-12 col-sm-12 col-xs-12 table-container">
    <table id="table-despues-cena" class="table table-accessGo">
        <thead class='head'>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Whatsapp</th>
                <th>Cantidad Personas</th>
                <!--<th>Invitación Enviada</th>-->
                <th>Confirmación</th>
                <th>Acciones</th>
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
    responsive: true,
    processing: true,
    serverSide: false,
    bInfo : false,
    language: {
            url: baseUrl + 'js/datatable/Spanish.json', 
            searchPlaceholder: 'Buscar Invitado..'
        },
    aaSorting: [],
    ajax: {
        url: baseUrl + 'etickets/getEticketsDespCena',
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
        { data: 'quantity'},
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
            }
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
                    if(row.cellphone != null){
                        a = a + 
                        '<a  target="_blank" title="Enviar url de entrada o confirmación por wpp" href="https://wa.me/549' + row.cellphone + '?text=' + '<?= $msg?>' + ' https://ev.accessgo.com.ar/invitados/confirmation/'+row.qr+' (Responde con 😀 y entra el enlace)">'+
                                        '<?= $this->Html->image("./svg/WhatsApp.svg", ["class" => "whatsapp-logo", "alt" => "Whatsapp"]); ?>'+
                                    '</a>';
                    }
                return a;
            },
            responsivePriority: 2
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
                alertify.error(data['result'] + ',error: ' + JSON.stringify(data['errors'], null, 4));
            } else {
                $("#confirmModal").modal('hide');
                table.ajax.reload();
                alertify.success(data['result']);
            }

        })
        .fail(function(data) {
            alertify.error(data);
        });
};
</script>