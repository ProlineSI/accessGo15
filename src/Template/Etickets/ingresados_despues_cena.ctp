<?= $this->Html->css(['table.css']) ?>

<div class="col-md-12 col-sm-12 col-xs-12 table-container">
    <table id="table-despues-cena" class="table table-accessGo">
        <thead class='head'>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cantidad Ingresados</th>
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
            url: baseUrl + 'js/datatable/Spanish.json', 
            searchPlaceholder: 'Buscar Invitado..'
        },
    aaSorting: [],
    ajax: {
        url: baseUrl + 'etickets/getEticketsDespCenaIngresados',
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
        { data: 'Cantidad Ingresados', 
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta) {
                var a = "<p>"+ row.scanCount +" de "+ row.quantity +" invitado/s</p>";
                return a;
            },
            responsivePriority: 1
        }
        
    ]
});

</script>