<nav id='sidebar' class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid container-sidebar">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header header-sidebar">
			<a><span id='close-sidebar' class='glyphicon glyphicon-remove'></span></a>
			<?= $this->Html->link('accessGo', ['controller' => 'Users', 'action' => 'home'], ['class' => 'nombre']) ?>
			<!-- <a class="navbar-brand" href="#"><?= $current_user['name']. ''. $current_user['surname']?></a> -->
		</div>
		<div id='gradient-line'>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'home']);?>"><span class='glyphicon glyphicon-home iconos-sidebar'></span>Inicio<span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>
				<li class="sidebar-dropdown" id='sidebar-dropdown-invitados'>
					<a href="#"><span class='glyphicon glyphicon-user iconos-sidebar'></span>Invitados<span class="glyphicon glyphicon-menu-down menu-down-invitados"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
					<div class="sidebar-submenu">
						<ul class="forAnimate">
							<li><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'index']);?>">Cena</a></li>
							<li class='ultimo'><a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'listClients']);?>">Despues de Cena</a></li>
						</ul>
					</div>	
				</li>
				<li class="sidebar-dropdown" id='sidebar-dropdown-ingresados'>
					<a href="#"><span class='glyphicon glyphicon-check iconos-sidebar'></span>Ingresados<span class="glyphicon glyphicon-menu-down menu-down-ingresados"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
					<div class="sidebar-submenu">
						<ul class="forAnimate">
							<li><a href="<?= $this->Url->build(['controller' => 'events', 'action' => 'add']);?>">Cena</a></li>
							<li class='ultimo'><a href="<?= $this->Url->build(['controller' => 'events', 'action' => 'nextEventsList']);?>">Despues de Cena</a></li>
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
