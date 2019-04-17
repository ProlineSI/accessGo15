<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
 */
?>
<div class="etickets form large-9 medium-8 columns content">
    <?= $this->Form->create($eticket) ?>
    <fieldset>
        <?php
            
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('surname', ['label' => 'Apellido']);
            echo $this->Form->control('cellphone', ['label' => 'Whatsapp']);
            echo $this->Form->control('type',['options' =>['cena' => 'Invitado a Cena', 'despuesDeCena' => 'Invitado Después de Cena']]);
            echo $this->Form->control('mesa');
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Agregar')) ?>
    <?= $this->Form->end() ?>
</div>
