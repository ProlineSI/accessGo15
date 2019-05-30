<?php  
	//Para mostrar menos cuando el evento termina
	$fecha_event = $current_user['events'][0]['endTime'];
	$fecha_event = $fecha_event->format('Y-m-d H:i:s');
	$fecha_event = new \DateTime($fecha_event);
	$fecha_event->add(new \DateInterval('P1D'));
	$fecha_event = strtotime($fecha_event->format('Y-m-d H:i:s'));
	$dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
	$today = (new \DateTime('now', $dateTimeZone));
	$today = strtotime($today->format('Y-m-d H:i:s'));
?>
<nav id='sidebar' class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid container-sidebar">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header header-sidebar">
			<a><span id='close-sidebar' class='glyphicon glyphicon-remove'></span></a>
			<!--<?//= $this->Html->link($name, ['controller' => 'Users', 'action' => 'home'], ['class' => 'nombre']) ?>-->
			<!--<a class="navbar-brand" href="#"><//?= $current_user['events'][0]['name']?></a>-->
		</div>
		<!--<div id='gradient-line'>
		</div>-->
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class='simple-link'><a id='stats-sidebar' href="<?= $this->Url->build(['controller' => 'Etickets', 'action' => 'getStats']);?>"><span class='glyphicon glyphicon-home iconos-sidebar'></span>Inicio</a></li>
				<?php  if($today >= $fecha_event){}else{ ?>
					<li class="sidebar-dropdown" id='sidebar-dropdown-invitados'>
						<a href="#"><span class='glyphicon glyphicon-user iconos-sidebar'></span>Invitados<span class="glyphicon glyphicon-menu-down menu-down-invitados"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
						<div class="sidebar-submenu">
							<ul class="forAnimate">
								<li><a id='cena' href="<?= $this->Url->build(['controller' => 'etickets', 'action' => 'tableCena']);?>">Cena</a></li>
								<li class='ultimo'><a id='desp-cena' href="<?= $this->Url->build(['controller' => 'etickets', 'action' => 'tableDespuesCena']);?>">Despues de Cena</a></li>
							</ul>
						</div>	
					</li>
					<li class="sidebar-dropdown" id='sidebar-dropdown-ingresados'>
						<a href="#"><span class='glyphicon glyphicon-check iconos-sidebar'></span>Ingresados<span class="glyphicon glyphicon-menu-down menu-down-ingresados"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
						<div class="sidebar-submenu">
							<ul class="forAnimate">
								<li><a id='ingresados-cena' href="<?= $this->Url->build(['controller' => 'etickets', 'action' => 'ingresadosCena']);?>">Cena</a></li>
								<li class='ultimo'><a id='ingresados-desp-cena' href="<?= $this->Url->build(['controller' => 'etickets', 'action' => 'ingresadosDespuesCena']);?>">Despues de Cena</a></li>
							</ul>
						</div>
					</li>
					<li class='simple-link'><a id='cuentas-scanners' href="<?= $this->Url->build(['controller' => 'users', 'action' => 'scannersIndex']);?>"><span class='glyphicon glyphicon-qrcode iconos-sidebar'></span>Cuentas Escaners</a></li>
					<li class='simple-link'><a id='config-event' href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'editEvent']);?>"><span class='glyphicon glyphicon-edit iconos-sidebar'></span>Configurar Evento</a></li>
				<?php  } ?>
			</ul>
		</div>
	</div>
	<div class='logo'>
		<a  href="https://accessgo.com.ar/" title='accessGo' target="_blank" rel="noopener noreferrer"><?= $this->Html->image('logo.png', ['id' => 'logo', 'alt' => 'AccessGo','height' => 40, 'width' => 170]);?></a>
	</div>
</nav> 
<?= $this->Html->script([
        'SideMenuFunctions.js'
    ]); ?>  


