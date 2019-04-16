<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Etickets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="etickets form large-9 medium-8 columns content">
    <?= $this->Form->create($eticket) ?>
    <fieldset>
        <legend><?= __('Add Eticket') ?></legend>
        <?php
            
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('surname', ['label' => 'Apellido']);
            echo $this->Form->control('cellphone', ['label' => 'Whatsapp']);
            echo $this->Form->control('type',['options' =>['cena' => 'Invitado a Cena', 'despuesDeCena' => 'Invitado Después de Cena']]);
            echo $this->Form->control('mesa');
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
