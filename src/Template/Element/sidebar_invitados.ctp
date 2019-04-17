<nav id='sidebar' class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid container-sidebar">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header header-sidebar">
			<a><span id='close-sidebar' class='glyphicon glyphicon-remove'></span></a>
			<?= $this->Html->link('accessGo', [], ['class' => 'nombre']) ?>
			<!-- <a class="navbar-brand" href="#"><?= $current_user['name']. ''. $current_user['surname']?></a> -->
		</div>
		<div id='gradient-line'>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?= $this->Url->build(['controller' => '', 'action' => '']);?>"><span class='glyphicon glyphicon-home iconos-sidebar'></span>Sobre Nosotros<span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>
                <li><a href="<?= $this->Url->build(['controller' => '', 'action' => '']);?>"><span class='glyphicon glyphicon-home iconos-sidebar'></span>Contrataciones<span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>

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
