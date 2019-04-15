<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
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
        
        <li><?= $this->Html->link(__('Editar Eticket'), ['action' => 'edit', $eticket->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar Eticket'), ['action' => 'delete', $eticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eticket->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Etickets'), ['action' => 'index']) ?> </li>
        
      </ul>
        </div>
    </div>
</h1>
<div class="etickets view large-9 medium-8 columns content">
    
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Qr') ?></th>
            <td><?= h($eticket->qr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($eticket->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($eticket->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cellphone') ?></th>
            <td><?= h($eticket->cellphone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($eticket->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eticket->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mesa') ?></th>
            <td><?= $this->Number->format($eticket->mesa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($eticket->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($eticket->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($eticket->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Confirmation') ?></th>
            <td><?= $eticket->confirmation ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scanned') ?></th>
            <td><?= $eticket->scanned ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
