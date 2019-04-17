<?= $this->Html->css(['table.css']) ?>

<div class="col-md-12 col-sm-12 col-xs-12 table-container">
    <table id="table-despues-cena" class="table table-responsive table-accessGo">
        <thead class='head'>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Whatsapp</th>
                <th>Mesa</th>
                <th>Cantidad de Personas</th>
                <th>Invitación Enviada</th>
                <th>Confirmación</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>

<script>
var token = <?= json_encode($this->request->param('_csrfToken')) ?>;


var table = $('#table-despues-cena').DataTable({
    responsive: true,
    processing: true,
    serverSide: false,
    bInfo : false,
    language: {
            url: baseUrl +'webroot/js/datatable/Spanish.json', 
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
        { data: 'mesa'},
        { data: 'quantity'},
        {
            data: 'sent',
            "render": function(data, type, row) {
                if (row.sent == false) {
                    return 'No';
                } else {
                    return 'Sí';
                }
            }
        },
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
                var a = "   <a class='accessGoBtn' href='/accessGo15/etickets/edit/" + row.id +
                    "'><span class = 'glyphicon glyphicon-pencil'></span></a>" +
                    "   <button class='accessGoBtn' onClick = 'deleteEticket(" + row.id +
                    ")'><span class = 'glyphicon glyphicon-remove'></span></button>";
                    if(row.cellphone != null){
                        a = a + 
                        '<a href="https://wa.me/?text=Te invito a mis 15, esta es tu entrada: https://upload.wikimedia.org/wikipedia/commons/1/18/QRc%C3%B3digo_portada_wikipedia_espa%C3%B1ol.png">'+
                                        '<?= $this->Html->image("./svg/WhatsApp.svg", ["class" => "whatsapp-logo", "alt" => "Whatsapp"]);?>'+
                                    '</a>';
                    }
                return a;
            },
            responsivePriority: 2
        }
    ]
});

var deleteEticket = function(eticket_id) {
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
                table.ajax.reload();
                alertify.success(data['result']);
            }

        })
        .fail(function(data) {
            alertify.error(data);
        });
};
</script>