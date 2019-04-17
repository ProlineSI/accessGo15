<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
 */
?>
<?= $this->Html->script(['add-eticket.js'])?>
<div class="etickets form large-9 medium-8 columns content">
    <?= $this->Form->create($eticket) ?>
    <fieldset>
        <?php
            
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('surname', ['label' => 'Apellido']);
            echo $this->Form->control('cellphone', ['label' => 'Whatsapp']);
            echo $this->Form->control('type',['options' =>['cena' => 'Invitado a Cena', 'despuesDeCena' => 'Invitado Después de Cena'],'label' => 'Tipo de Invitado']);
            
            ?>
            <div id='tipo-de-entrada-container'>
        <?php
            echo $this->Form->control('Tipo de Entrada',['options' =>['individual' => 'Individual', 'grupoFamiliar' => 'Grupo Familiar']]);
        ?>
            </div>
            <div id = 'quantity-container'>
            </div>
            <div id='mesa-container'>
        <?php
            echo $this->Form->control('mesa');
            
        ?>
            </div>
    </fieldset>
    <?= $this->Form->button(__('Agregar')) ?>
    <a href="/accessGo15/etickets/table-cena">Volver a Lista de Invitados</a>
    <?= $this->Form->end() ?>
</div>
