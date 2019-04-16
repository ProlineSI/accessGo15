<style>
.head th{
    font-size: 20px;
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
        
        <li><?= $this->Html->link(__('Añadir Eticket'), ['action' => 'add']) ?></li>
         </ul>
        </div>
    </div>
</h1>
<table id="example" class="table table-striped table-bordered">
        <thead class = 'head'>
            <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Whatsapp</th>
            <th>Confirmación</th>
            </tr>
        </thead>
        
    </table>

    <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        ajax: {
                url: baseUrl + 'etickets/getEtickets',
                dataSrc: ""
                },
    columns: [
        { data: 'name' },
        { data: 'surname'},
        { data: 'cellphone'},
        { data: 'confirmation'}
    ]
} );});
</script>