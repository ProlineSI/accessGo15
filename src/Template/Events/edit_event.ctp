
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
 */
?>
<?= $this->Html->css(['edit-event.css']) ?>
<?= $this->Html->script(['add-eticket.js'])?>

<div id='form-container' class="etickets form large-9 medium-8 columns content">
    <div id="form-opacity">
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
        <div class="row" id='excel-container'>
            <h4>IMPORTAR EXCEL <span id='request-info' title='Información' class='glyphicon glyphicon-info-sign'></span></h4>
        </div>
        <?= $this->Form->create($event,['type' => 'file', 'name' => 'excel', 'url' => ['controller'=>'events', 'action' => 'importExcelfileCena']]) ?>
        <fieldset>
            <?= $this->Form->control('regular',['type' => 'file', 'name' => 'excel', 'label' => 'A Cena', 'id'=>'excel-cena-choose', 'class' => 'btn'])?>
        </fieldset>
        <?= $this->Form->button(__('Cargar a Cena')) ?>
        <?= $this->Form->end() ?>
        <?= $this->Form->create($event,['type' => 'file', 'name' => 'excel', 'url' => ['controller'=>'events', 'action' => 'importExcelfileDCena']]) ?>
        <fieldset>
            <?= $this->Form->control('regular',['type' => 'file', 'name' => 'excel', 'label' => 'D/Cena', 'id'=>'excel-dcena-choose', 'class' => 'btn'])?>
        </fieldset>
        <?= $this->Form->button(__('Cargar a D/Cena')) ?>
        <?= $this->Form->end() ?>
    </div>
    <div id="info">
        <p>Para importar un archivo excel, debes seguir la estructura(el orden de las columnas) que poseen ambas tablas en el sistema respectivamente a cada una, indicando en la primer fila los títulos de cada columna; caso contrario la carga no se realizará o no se hará de la manera deseada. En el caso que desee cargar lista D/Cena, en la columna "Mesa", debés poner un 0.</p>
        <p class='bold'>Recuerdá que el orden de las columnas en el sistema es Nombre-Apellido-Whatsapp-Mesa-Cantidad Personas</p>
        <a class='bold' title='Modelo de Excel' href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'downloadModel']);?>">Descargar archivo modelo</a>
    </div>
</div>
<script>
    var info_state = false;
    $('#request-info').click(function(){
        if(info_state == false){
            $('#info').fadeIn(200);
            if($(window).width() <= 500){
                $('#form-opacity').css({'opacity' : '0.3'});
            }
            info_state = true;
        }else{
            $('#info').fadeOut(200);
            if($(window).width() <= 500){
                $('#form-opacity').css({'opacity' : '1'});
            }
            info_state = false;
        }    
    });
</script>
