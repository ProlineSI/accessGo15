<?= $this->Html->css(['table.css']) ?>

<div class="col-md-12 col-sm-12 col-xs-12 table-container">
    <table id="table-scanners" class="table table-accessGo">
        <thead class='head'>
            <tr>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>

<script>
var token = <?= json_encode($this->request->param('_csrfToken')) ?>;


var table = $('#table-scanners').DataTable({
    responsive: true,
    processing: true,
    serverSide: false,
    bInfo : false,
    language: {
            url: baseUrl +'js/datatable/Spanish.json', 
            searchPlaceholder: 'Buscar Invitado..'
        },
    aaSorting: [],
    ajax: {
        url: baseUrl + 'users/getScanners',
        dataSrc: "",
    },
    columns: [{
            data: 'username',
            responsivePriority: 1
        },
        {
            data: 'Acciones',
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta) {
                var a = 
                "   <a class='accessGoBtn' href='/accessGo15/users/editScanner/" + row.id +
                    "' title='Editar Invitado'><span class = 'edit glyphicon glyphicon-pencil'></span></a>" +"   <a class='accessGoBtn' onClick = 'deleteScanner(" + row.id +
                    ")' title='Eliminar Invitado'><span class = 'delete glyphicon glyphicon-remove'></span></a>";
                    
                return a;
            },
            responsivePriority: 2
        }
    ]
});

var deleteScanner = function(scanner_id) {
    $.ajax({
            type: 'POST',
            url: baseUrl + 'users/deleteScanner',
            data: {
                "id": scanner_id
            },
            beforeSend: function(xhr) { //Agregar esta línea cuando las peticiones post den error
                xhr.setRequestHeader('X-CSRF-Token', token);
            }
        })
        .done(function(data) {
            if ('errors' in data) {
                alertify.error(data['error']);
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