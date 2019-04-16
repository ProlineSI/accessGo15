<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket[]|\Cake\Collection\CollectionInterface $etickets
 */
?>

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
<table id="table_id" class="display">
    <thead>
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
    $('#table_id').DataTable( {
        ajax: {
                url: baseUrl + 'etickets/getEtickets',
                dataSrc: ""
                },
    columns: [
        { data: 'name' },
        { data: 'surname'},
        { data: 'cellphone'},
        { data: 'confirmation'},
        { data: 'mesa' },
    ]
} );
</script>
