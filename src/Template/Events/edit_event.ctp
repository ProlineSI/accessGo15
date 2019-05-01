
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
    .control{
        margin-top: 3%;
        margin-bottom: 3%;
    }
    #remember{
        color: #b6b6b6;
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
    <h5 id='remember'>Recorda que el horario de invitación a cena y después de cena es que el se muestra en la confirmación y E-ticket.</h5>
    <fieldset>
        <div class="control">
            <?php
                if($event->wp_msg){
                    echo $this->Form->control('wp_msg', ['label' => 'Mensaje Personalizado de Whatsapp', 'Placeholder' => $event->wp_msg]);
                }else{
                    echo $this->Form->control('wp_msg', ['label' => 'Mensaje Personalizado de Whatsapp', 'Placeholder' => 'Te invito a mi Evento, confirmá tu asistencia y descargá tu entrada utilzando AccessGo']);
                }
            ?>
        </div>
        <div class="control">
            <?php   
                echo $this->Form->label('Horario de Invitación a Cena');
                if($event->cena_time){
                    echo $this->Form->time('cena_time');
                }else{
                    echo $this->Form->time('cena_time');
                }
            ?>
        </div>
        <div class="control">
            <?php 
                echo $this->Form->label('Horario de Invitación Después de Cena');   
                if($event->despCena_time){
                    echo $this->Form->time('despCena_time');
                }else{
                    echo $this->Form->time('despCena_time');
                }
            ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>
