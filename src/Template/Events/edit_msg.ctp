
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
    @media(max-width: 500px){
        #fill-event{
            font-size: 110%;
            padding-top: 0px;
        }
    }
</style>
<div id='form-container' class="etickets form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <?php 
             echo $this->Form->control('wp_msg', ['label' => 'Mensaje Personalizado']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>