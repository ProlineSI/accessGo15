<?= $this->Html->css(['table.css']) ?>

<!--Modal confirmacion de eliminacion de invitado -->
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
<!--Fin modal -->

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
                "   <a class='accessGoBtn' href='/users/editScanner/" + row.id +
                    "' title='Editar Scanner'><span class = 'edit glyphicon glyphicon-pencil'></span></a>" +"   <a class='accessGoBtn' onClick = 'openConfirmModal(" + row.id +
                    ")' title='Eliminar Scanner'><span class = 'delete glyphicon glyphicon-remove'></span></a>";
                    
                return a;
            },
            responsivePriority: 2
        }
    ]
});

var openConfirmModal = function(scanner_id){
    $("#confirmModal").modal({show:true});
    $("#confirmBtn").on('click', function(){
        deleteScanner(scanner_id);
    })
}

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