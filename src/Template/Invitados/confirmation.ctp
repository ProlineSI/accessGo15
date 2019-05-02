<?php if (isset($current_user)){
    session_destroy();
    header("Refresh:0");
    } 
    echo $this->Html->script('qrcode.js/qrcode.min.js');

?>
<?= $this->Html->css(['confirmacion_eticket.css']) ?>
<!--Modal confirmacion de invitado -->
<div id="confirmEticketModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" aria-labbeledby="confirmEticketModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <?php 
                    if(isset($eticket)){
                        if($eticket->confirmation == true){
                            $qr = $eticket->qrImg;
                            ?>
                            <div id="qr-container">
                            <?php  if($eticket->event->type){?>
                                <h1 id='title'><?= $eticket->event->type ?></h1>
                            <?php }else{ ?> 
                                <h1 id='title'><?= $eticket->event->name ?></h1>
                            <?php }?>  
                            <?php 
                                    $file_path = WWW_ROOT . DS . 'img'. DS . 'svg' . DS . 'entradas-eticket'. DS . $eticket->event->type.'-eticket.svg';
                                    if(file_exists($file_path)){?>
                                        <?= $this->Html->image('svg/entradas-eticket/'.$eticket->event->type.'-eticket.svg', ['id' => 'eticket', 'alt' => 'qr']); ?>
                                    <?php }else{
                                        echo $this->Html->image('svg/entradas-eticket/accessgo-eticket.svg', ['id' => 'tarjeta', 'alt' => 'tarjeta']);
                                    }?>
                                <div class="center" id='qr'></div>
                                <div id="qr-content-container">
                                    <div class="row row-1">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Nombre y Apellido</h6>
                                            </div>
                                            <div class="row">
                                                <p><?= $eticket->name ?> <?= $eticket->surname ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Fecha, Hora y Evento</h6>
                                            </div>
                                            <div class="row">
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= date('j-n-y', strtotime($eticket->event->startTime)); ?>, <?= date('H:i', strtotime($eticket->event->cena_time)); ?> - Evento de <?= $eticket->event->name ?></p>
                                                <?php }else{?>
                                                    <p><?= date('j-n-y', strtotime($eticket->event->startTime)); ?>, <?= date('H:i', strtotime($eticket->event->despCena_time)); ?> - Evento de <?= $eticket->event->name ?></p>
                                                <?php }?>
                                            </div>       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Cantidad de Personas</h6>
                                            </div> 
                                            <div class="row">
                                                <p><?= $eticket->quantity ?></p>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Mesa</h6>
                                            </div>
                                            <div class="row">
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= $eticket->mesa ?></p>
                                                <?php }else{?>
                                                    <p>-</p>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="map" class='qr-map' style="width:100%; height:200px; margin-bottom:10px;"></div>   
                            </div>            
                <?php   
                        }else{ ?>
                            <div id="confirmation-container">
                                <?php 
                                    $file_path = WWW_ROOT . DS . 'img'. DS . 'svg' . DS . 'entradas-eticket'. DS . $eticket->event->name.'.svg';
                                    if(file_exists($file_path)){?>
                                        <?= $this->Html->image('svg/entradas-eticket/'.$eticket->event->name.'.svg', ['id' => 'tarjeta', 'alt' => 'tarjeta']);?>
                                    <?php }else{?>
                                        <?= $this->Html->image('svg/entradas-eticket/accessgo-confirmation.svg', ['id' => 'tarjeta', 'alt' => 'hola']);?>
                                        <h1 id='title'><?= $eticket->event->name ?></h1>
                                    <?php } ?>
                                <div id="content-container">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Nombre y Apellido</h6>
                                            </div>
                                            <div class="row">
                                                <p><?= $eticket->name ?> <?= $eticket->surname ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Hora</h6>
                                            </div>
                                            <div class="row">
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= date('H:i', strtotime($eticket->event->cena_time)); ?></p>
                                                <?php }else{?>
                                                    <p><?= date('H:i', strtotime($eticket->event->despCena_time)); ?></p>
                                                <?php }?>
                                            </div>       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Cantidad de Personas</h6>
                                            </div> 
                                            <div class="row">
                                                    <p><?= $eticket->quantity ?></p>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="row">
                                                <h6>Mesa</h6>
                                            </div>
                                            <div class="row">
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= $eticket->mesa ?></p>
                                                <?php }else{?>
                                                    <p>-</p>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id='btn-container'>
                                        <button type= "button" id ="confirm-btn">Confirmar</button>
                                    </div>    
                                </div>
                                <div id="map" class='confirmation-map' style="width:100%; height:200px; margin-bottom:10px;"></div>
                            </div> 
                    <?php }
                        ?>
                <?php }else{
                    echo 'Error';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--Fin modal -->


<script src="https://maps.googleapis.com/maps/api/js?key="></script>
<?php echo "<script> var latlng = new google.maps.LatLng(".$eticket->event->lat.", ".$eticket->event->lng."); </script>";?>
<?= $this->html->script(['googlemapsview.js']); ?>

<script>
    $(document).ready(function(){
        new QRCode(document.getElementById("qr"), {
        text: "<?=  h($eticket->qr)?>",
        width: 82,
        height: 82,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
        $('#confirmEticketModal').modal({show:true});
    })

    var token = <?= json_encode($this->request->param('_csrfToken')) ?>;
    $('#confirm-btn').on('click', function(){
        $.ajax({
            type: 'POST',
            url: baseUrl + 'invitados/confirmEticket',
            data: {
                "id": <?=  $eticket->id?>
            },
            beforeSend: function(xhr) { //Agregar esta línea cuando las peticiones post den error
                xhr.setRequestHeader('X-CSRF-Token', token);
            }
        })
        .done(function(data) {
            if ('errors' in data) {
                console.log(data);
                alertify.error(data['error']);
            } else {
                window.location.reload(false); 
                alertify.success(data['result']);
            }

        })
        .fail(function(data) {
            alertify.error(data);
        });
    });
</script>