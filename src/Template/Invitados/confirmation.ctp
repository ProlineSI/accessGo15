<?php if (isset($current_user)){
    session_destroy();
    header("Refresh:0");
    } 
    echo $this->Html->script('qrcode.js/qrcode.min.js');
    //Para ver si el evento ya termino
    if($eticket != null){
        $fecha_event = $eticket->event->endTime;
        $fecha_event = $fecha_event->format('Y-m-d H:i:s');
        $fecha_event = new \DateTime($fecha_event);
        $fecha_event->add(new \DateInterval('P1D'));
        $fecha_event = strtotime($fecha_event->format('Y-m-d H:i:s'));
        $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
        $today = (new \DateTime('now', $dateTimeZone));
        $today = strtotime($today->format('Y-m-d H:i:s'));
    }
?>
<?= $this->Html->css(['confirmacion_eticket.css']) ?>

<div id='preloader' class="preloader js-preloader flex-center">
  <div class="dots">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </div>
</div>

<?php  if($eticket != null){ 
            if($today >= $fecha_event){?>
                <div id="error">
                    <h1>Evento de <?= $eticket->event->name?> terminado, no puede ingresar a esta URL.</h1>
                    <a  href="https://accessgo.com.ar/" target="_blank" rel="noopener noreferrer" title='accessGo'><?= $this->Html->image('logo.png', ['id' => 'logo', 'alt' => 'AccessGo','height' => 45, 'width' => 180]);?></a>
                </div>
            <?php }else { ?>
<!--Modal confirmacion de invitado -->
<div id="confirmEticketModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" aria-labbeledby="confirmEticketModal" class="modal fade" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <?php 
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
                                                <h6>Fecha y Hora</h6>
                                            </div>
                                            <div class="row">
                                                <?php if($eticket->type == 'cena'){?>
                                                    <p><?= date('j-n-y', strtotime($eticket->event->startTime)); ?>, <?= date('H:i', strtotime($eticket->event->cena_time)); ?> - Cena</p>
                                                <?php }else{?>
                                                    <p><?= date('j-n-y', strtotime($eticket->event->startTime)); ?>, <?= date('H:i', strtotime($eticket->event->despCena_time)); ?> - Despues de Cena</p>
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
                                <div class="row" id='btn-container'>
                 <button type="button" class="redirect" data-toggle="modal" data-target="#listaRegalosModal">Lista de regalos</button>  
                                </div>
                                <button type="button" id="moreInfo" data-toggle="modal" data-target="#confirmationEticketModal">Info</button>   
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
                                                    <p><?= date('H:i', strtotime($eticket->event->cena_time)); ?> - Cena</p>
                                                <?php }else{?>
                                                    <p><?= date('H:i', strtotime($eticket->event->despCena_time)); ?> - Despues de Cena</p>
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
                                        <button type= "button" id ="confirm-btn">Confirmar E-ticket</button>
                                    </div>    
                                </div>
                                <div id="map" class='confirmation-map' style="width:100%; height:200px; margin-bottom:10px;"></div>
                                <a href='https://accessgo.com.ar/' target='_blank' class='redirect-confirmation'></a>   
                            </div> 
                    <?php }
                        ?>
               
                
            </div>
        </div>
    </div>
</div>
<?php }}else{ ?>
    <div id="error">
        <h1>Usuario eliminado o no encontrado. Por favor, cree uno nuevo.</h1>
        <a  href="https://accessgo.com.ar/" target="_blank" rel="noopener noreferrer" title='accessGo'><?= $this->Html->image('logo.png', ['id' => 'logo', 'alt' => 'AccessGo','height' => 45, 'width' => 180]);?></a>
    </div>
<?php } ?>
<!--Fin modal -->




<!-- MODAL CONFIRMATION-->
<div id="confirmationEticketModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" aria-labbeledby="confirmEticketModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <?php 
            $file_path = WWW_ROOT . DS . 'img'. DS . 'svg' . DS . 'entradas-eticket'. DS . $eticket->event->name.'.svg';
            if(file_exists($file_path)){?>
                <?= $this->Html->image('svg/entradas-eticket/'.$eticket->event->name.'.svg', ['id' => 'tarjeta', 'alt' => 'tarjeta']);?>
            <?php }else{?>
                <?= $this->Html->image('svg/entradas-eticket/accessgo-confirmation.svg', ['id' => 'tarjeta', 'alt' => 'hola']);?>
                <h1 id='title'><?= $eticket->event->name ?></h1>
            <?php } ?>
            <button type="button" class="closeInfo" data-dismiss="modal">Atras</button>  

        <a href='https://accessgo.com.ar/' target='_blank' class='redirect-confirmation'></a>   
    </div> 

</div>

<!-- FIN MODAL-->


<!--LISTA DE REGALOS MODAL -->
<div class="modal fade" id="listaRegalosModal" tabindex="-1" role="dialog" aria-labelledby="listaRegalosModalLabel" aria-hidden="true" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="listaregaloscontent">
      <div class="modal-header">
        <h5 class="modal-title" id="listaRegalosModalLabel">Lista de regalos</h5>
      </div>
      <div class="modal-body">
        <div style="text-align:center;">Que estés es lo más importante, lo que quieras regalar estará bien y si quieres colaborar con nuestra luna de miel:</div><hr/>
                <div style="text-align:center"> Armando Azeglio CBU: 0720009088000015094218 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--FIN MODAL -->



<script  src="https://maps.googleapis.com/maps/api/js?key="></script>
<?php if($eticket != null){ echo "<script> var latlng = new google.maps.LatLng(".$eticket->event->lat.", ".$eticket->event->lng."); </script>"; }?>
<?= $this->html->script(['googlemapsview.js']); ?>
<?= $this->Html->script(['preloader/jquery.preloadinator.min.js'])?>

<script>
    $('#preloader').preloadinator();
    $(document).ready(function(){
        <?php if($eticket != null){?>
        var qrDiv = document.getElementById("qr");
            if(qrDiv != null){
                new QRCode(document.getElementById("qr"), {
                text: "<?=  h($eticket->qr)?>",
                width: 82,
                height: 82,
                border: 4,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
                });
            }
            $('#confirmEticketModal').modal({show:true});
        <?php }?>
    })

    var token = <?= json_encode($this->request->param('_csrfToken')) ?>;
    <?php if($eticket != null){?>
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
    <?php }?>
</script>