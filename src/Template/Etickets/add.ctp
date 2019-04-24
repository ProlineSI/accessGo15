<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
 */
?>
<?= $this->Html->script(['add-eticket.js'])?>
<style>
    #form-container{
        width: 70%;
        margin-top: 3%;
        margin-right: auto;
        margin-left: auto;
    }
    #redirect{
        display: block;
        margin-top: 3%;
        color:#272A3B;
        border-radius: 15px;
        border: 1px solid #272A3B;
        margin-right:70%;
        padding: 1% 1% 1% 2%;
        transition: all 0.3s;
    }
    #redirect:hover{
        color: white;
        background: #272A3B;
        text-decoration: none;
    }
    .btn-default {
        background: linear-gradient(to right, #00cbf6 10%, rgba(0, 220, 226) 20%, #01ff85 50%);
        color: white;
        transition: all 0.5s;
        border: none;
    }
    .btn-default:hover {
        background: #768B95;
        color: white;
    }
    @media(max-width: 991px){
            #form-container{
            width: 100%;
        }
    }
    @media(max-width: 680px){
        #redirect{
            margin-right: 60%;
        }
    }
    @media(max-width: 500px){
        #redirect{
            margin-right: 50%;
        }
    }
    @media(max-width: 400px){
        #redirect{
            margin-right: 35%;
        }
    }
</style>
<div id='form-container' class="etickets form large-9 medium-8 columns content">
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
                <label class="control-label" for="quantity">Cantidad de Personas</label><input type="number" name="quantity" required="required" id="quantity" class="form-control" value="1">
            </div>
            <br>
            <div id='mesa-container'>
        <?php
            echo $this->Form->control('mesa');
            
        ?>
            </div>
    </fieldset>
    <?= $this->Form->button(__('Agregar', ['class'=>'btn btn-default'])) ?>
    <a href="table-cena" id='redirect'>Volver a Lista de Invitados</a>
    <?= $this->Form->end() ?>
</div>
