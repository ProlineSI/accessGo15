<nav id='sidebar' class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid container-sidebar">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header header-sidebar">
			<a><span id='close-sidebar' class='glyphicon glyphicon-remove'></span></a>
			<?= $this->Html->link('quattro', ['controller' => 'Users', 'action' => 'home'], ['class' => 'nombre']) ?>
			<!-- <a class="navbar-brand" href="#"><?= $current_user['name']. ''. $current_user['surname']?></a> -->
		</div>
		<div id='gradient-line'>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">	
				<li class="sidebar-dropdown" id='sidebar-dropdown-user'>
					<a href="#"><span class='glyphicon glyphicon-user iconos-sidebar'></span>Usuarios<span class="glyphicon glyphicon-menu-down menu-down-user"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
					<div class="sidebar-submenu">
						<ul class="forAnimate">
							<li><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'index']);?>">Todos</a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'listAdmins']);?>">Administradores</a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'listRrpps']);?>">Públicas</a></li>
							<li class='ultimo'><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'listClients']);?>">Clientes</a></li>
						</ul>
					</div>	
				</li>
				<li id=''><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'home']);?>"><span class='glyphicon glyphicon-stats iconos-sidebar'></span>Estadísticas<span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>
				<li><a href="<?= $this->Url->build(['controller' => 'addresses', 'action' => 'index']);?>"><span class='glyphicon glyphicon-road iconos-sidebar'></span>Direcciones<span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a></li>
				<li><a href="<?= $this->Url->build(['controller' => 'venues', 'action' => 'index']);?>"><span class='glyphicon glyphicon-home iconos-sidebar'></span>Sedes<span style="font-size:16px; margin-right: 5px;" class="pull-right hidden-xs showopacity "></span></a></li>
				<li class="sidebar-dropdown" id='sidebar-dropdown-events'>
					<a href="#"><span class='glyphicon glyphicon-calendar iconos-sidebar'></span>Eventos<span class="glyphicon glyphicon-menu-down menu-down-events"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
					<div class="sidebar-submenu">
						<ul class="forAnimate">
							<li><a href="<?= $this->Url->build(['controller' => 'events', 'action' => 'add']);?>">Añadir Evento</a></li>
							<li><a href="<?= $this->Url->build(['controller' => 'events', 'action' => 'index']);?>">Todos los Eventos</a></li>
							<li class='ultimo'><a href="<?= $this->Url->build(['controller' => 'events', 'action' => 'nextEventsList']);?>">Próximos Eventos</a></li>
						</ul>
					</div>
				</li>
				<li><a href="<?= $this->Url->build(['controller' => 'TicketTypes', 'action' => 'index']);?>"><span class='glyphicon glyphicon-list-alt iconos-sidebar'></span>Entradas<span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>
				<li>
					<a href="<?= $this->Url->build(['controller' => 'TicketRequests', 'action' => 'rrppTicketsRequests']);?>"><span><?= $this->Html->image('./svg/eticketblanco-01.svg', ['class' => 'iconos-sidebar', 'alt' => 'E-ticket', 'style' => 'width: 25px']);?></span><span style="margin-left: -7px;" class="showopacity "> Solicitudes</span></a>
					<span id='badge-sidebar' class="badge">0</span>
				</li>
				<li class="sidebar-dropdown" id='sidebar-dropdown-stats'>
					<a href="#"><span class='glyphicon glyphicon-cog iconos-sidebar'></span>Configuración<span class="glyphicon glyphicon-menu-down menu-down-stats"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a>
					<div class="sidebar-submenu">
						<ul class="forAnimate">
							<li><a href="<?= $this->Url->build(['controller' => 'genders', 'action' => 'index']);?>">Géneros</a></li>
							<li class='ultimo'><a href="<?= $this->Url->build(['controller' => 'sectors', 'action' => 'index']);?>">Sectores/Tipos de Entrada</a></li>
						</ul>
					</div>
				</li>
				
			</ul>
		</div>
	</div>
	<div class='logo'>
		<a  href="#" target="_blank" rel="noopener noreferrer"><?= $this->Html->image('logo.png', ['id' => 'logo', 'alt' => 'AccessGo','height' => 40, 'width' => 170]);?></a>
	</div>
</nav> 
<?= $this->Html->script([
        'SideMenuFunctions.js'
    ]); ?>  
