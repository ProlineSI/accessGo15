<style>
.head th{
    font-size: 20px;
    width: 150px;
}
</style>
<h1 class="page-header"><?= $title; ?>
    <div class="pull-right">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
        
        <li><?= $this->Html->link(__('Añadir Invitados'), ['action' => 'add']) ?></li>
         </ul>
        </div>
    </div>
</h1>
<table id="cena-table" class="table table-striped table-bordered">
        <thead class = 'head'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Whatsapp</th>
            <th>Confirmación</th>
            <th>Mesa</th>
            </tr>
        </thead>
        
    </table>

<script>
$(document).ready(function() {
    $('#cena-table').DataTable( {
        ajax: {
                url: baseUrl + 'etickets/getEtickets',
                dataSrc: ""
                },
    columns: [
        { data: 'name' },
        { data: 'surname'},
        { data: 'cellphone'},
        { data: 'confirmation',
        "render": function (data, type, row) {
 
        if (row.confirmation == false) {
            return 'No';}
 
            else {
 
    return 'Sí';
 
}}},
        { data: 'mesa' },
    ]
} );});
</script>