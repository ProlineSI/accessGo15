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
<div  class="container-fluid ">
        <ul  class="nav nav-pills" id="tab">
            <li>
                <a class="btn-nav-tabs" href="#listaCena" data-toggle="tab">Invitados a Cena</a>
            </li>
            <li>
                <a class="btn-nav-tabs" href="#listaDespuésCena" data-toggle="tab">Invitados Después de Cena</a>
            </li>
        </ul>
</div>
<div class="tab-content clearfix">
    <div class="tab-pane"  id="listaCena">
        <?= $this->element('table-cena') ?>
    </div>
    <div class="tab-pane"  id="listaDespuésCena">
        <?= $this->element('table-despues-cena') ?>
    </div>
</div>
<script>
    $(function () {
        
        $('#tab a[data-toggle="tab"]').on('click', function (e) {
            window.localStorage.setItem('tab_activeTab', $(e.target).attr('href'));
            
        });
        
        var tab_activeTab = window.localStorage.getItem('tab_activeTab');
        if (tab_activeTab) {
            $('#tab a[href="' + tab_activeTab + '"]').tab('show');
        } else {
            $('#tab a[href="#detallesEvento"]').tab('show');
        }
    });
</script>
