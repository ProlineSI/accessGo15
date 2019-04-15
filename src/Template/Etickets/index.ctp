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
<div class="etickets index large-9 medium-8 columns content">
    
    <table class='table table-striped' cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cellphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('confirmation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('scanned') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mesa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions" style="width: 150px;"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etickets as $eticket): ?>
            <tr>
                <td><?= $this->Number->format($eticket->id) ?></td>
                <td><?= h($eticket->qr) ?></td>
                <td><?= h($eticket->name) ?></td>
                <td><?= h($eticket->surname) ?></td>
                <td><?= h($eticket->cellphone) ?></td>
                <td><?= h($eticket->confirmation) ?></td>
                <td><?= h($eticket->scanned) ?></td>
                <td><?= h($eticket->type) ?></td>
                <td><?= $this->Number->format($eticket->mesa) ?></td>
                <td><?= h($eticket->deleted) ?></td>
                <td><?= h($eticket->created) ?></td>
                <td><?= h($eticket->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__(''), ['action' => 'view', $eticket->id], ['class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link(__(''), ['action' => 'edit', $eticket->id],['class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $eticket->id],['class' => 'btn btn-default glyphicon glyphicon-trash'], ['confirm' => __('Are you sure you want to delete # {0}?', $eticket->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
