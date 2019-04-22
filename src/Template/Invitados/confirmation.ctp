<?php if (isset($current_user)){
    session_destroy();
    header("Refresh:0");
    } 
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
                                <?= $this->Html->image('svg/entradas y eticket/eticket-qr.svg', ['id' => 'eticket', 'alt' => 'qr']); ?>
                                <div class="center" id='qr'><img src="<?=$qr->writeDataUri()?>" alt="tuQR"></div>
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
                                                    <p><?= date('j-n-y, H:i', strtotime($eticket->event->startTime)); ?> - Evento de <?= $eticket->event->name ?></p>
                                                <?php }else{?>
                                                    <p><?= date('j-n-y, 00:00', strtotime($eticket->event->startTime)); ?> - Evento de <?= $eticket->event->name ?></p>
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
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= $eticket->quantity ?></p>
                                                <?php }else{?>
                                                    <p>1</p>
                                                <?php }?>
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
                                <div class="row" id='screen'>
                                    <p>Para conservar esta entrada, puede, sacar captura de pantalla o bien ingresar a esta misma url para visualizar el qr</p>
                                </div>    
                            </div>            
                <?php   
                        }else{ ?>
                            <div id="confirmation-container">
                                <?php 
                                if($eticket->type == 'cena'){?>
                                    <?= $this->Html->image('svg/entradas y eticket/'.$eticket->event->name.'.svg', ['id' => 'tarjeta', 'alt' => 'tarjeta']);?>
                                <?php }else{?>
                                    <?= $this->Html->image('svg/entradas y eticket/'.$eticket->event->name.'.svg', ['id' => 'tarjeta', 'alt' => 'tarjeta']);?>
                                    <?php }?>
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
                                                    <p><?= date('H:i', strtotime($eticket->event->startTime)); ?></p>
                                                <?php }else{?>
                                                    <p>00:00</p>
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
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= $eticket->quantity ?></p>
                                                <?php }else{?>
                                                    <p>1</p>
                                                <?php }?>
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
                            </div>    
                        <?php }
                    ?>
                    <div id="map" style="width:100%; height:200px; margin-bottom:10px;"></div>
                <?php }else{
                    echo 'Error';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--Fin modal -->


<?php 
if($eticket->confirmation == true){}
    else{ ?>
<?= $this->html->script(['https://maps.google.com/maps/api/js?key=&sensor=false']); ?>
<?php echo "<script> var latlng = new google.maps.LatLng(".$eticket->event->lat.", ".$eticket->event->lng."); </script>";?>
<?= $this->html->script(['googlemapsview.js']); ?>
<?php } ?>
<script>
    $(document).ready(function(){
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