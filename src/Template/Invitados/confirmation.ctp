<?php 
    if(isset($eticket)){
        echo json_encode($eticket);
        if($eticket->confirmation == true){
            echo $eticket->qr;
        }else{?>
            <h1>Mi cumpleaños de 15 se realizará el día 15/05/19 a las 22hs ¿Deseas confirmar asistencia?</h1>
            <button type= "button">Confirmar</button>
        <?php }
    ?>
        

<?php }else{
    echo 'Bienvenido a AccessGo, organiza tu evento de la manera más fácil y rápida';
}
?>