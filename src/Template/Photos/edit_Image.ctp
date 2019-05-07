<?php
//$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event,['type' => 'file', 'name' => 'images[]', 'multiple', 'url'=>['controller'=>'photos','action'=>'editImage']]) ?>
    <fieldset>
        <?php
            echo $this->Form->control('regular',['type' => 'file', 'name' => 'images[]', 'multiple', 'label' => 'Agregar Imagen/es'])
        ?>
    </fieldset>
    
    <?= $this->Form->button(__('Modificar')) ?>
    <?= $this->Form->end() ?>
    
    <?php foreach ($event->photos as $photo): ?>
                        <div class="thumbnail col-md-2 col-xs-4">
                            <?= $this->Html->image("https://s3.us-east-2.amazonaws.com/evquince" . $photo->thumbnail, ['style' => 'width: 100%;']);?>
                            <?=$this->Form->postLink(__(''), ['controller' => 'Photos', 'action' => 'delete_event', $photo->_joinData->id, $event->id], ['class' => 'btn btn-default glyphicon glyphicon-remove', 'style' => "position: absolute;right: 10px;top: 10px;", 'confirm' => 'Estas seguro que deseas desvincular la foto del evento?'])?> 
                        </div>
                    <?php endforeach; ?>
</div>
<script>
  $(function () {
    $('#startTime').datetimepicker();
    $('#endTime').datetimepicker();
 });
 </script>