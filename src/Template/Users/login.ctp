<?= $this->Html->css('login')?>
<!--Validacion para cerrar sesión cuando no se deslogea-->
<?php if (isset($current_user)){
		session_destroy();
		header("Refresh:0");
	} 
?>
<div class="container" id="loginContainer">
	<div class='container-center'>
		<div class="row" style="margin-top:20px">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<?= $this->Html->image('svg/login.svg', ['id' => 'login-background', 'alt' => 'Login']);?>	
				<div id='login-responsive-content'>
					<h1 class='nombre-login'>accessGo</h1>
					<div id='login-content'>
						<?= $this->Form->create();?>
							<fieldset>
								<?= $this->Form->control('username', [
									'class' => 'form-control input-lg', 
									'placeholder' => 'Usuario', 'label' => 'Usuario'])?>
								<?= $this->Form->control('password',	[
									'class' => 'form-control input-lg', 
									'placeholder' => 'Contraseña', 'label' => 'Contraseña'])?>
								<div class="row">
									<?= $this->Flash->render('auth')?>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<?= $this->Form->button('Ingresar', [
												'class' => 'btn btn-login'])?>
									</div>
								</div> 	
								<div class="row row1">
									<a id='registrarse' href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']); ?>">Registrarse</a>
								</div>
						<?= $this->Form->end();?>
					</div>
				</div>
			</div>
		</div>
		<a  href="#" target="_blank" rel="noopener noreferrer"><?= $this->Html->image('logo.png', ['id' => 'logo', 'alt' => 'AccessGo','height' => 45, 'width' => 180]);?></a>
	</div>
</div>
