<?php
	if(!isset($showMenu)) $showMenu=true;
	$rnd=rand(1,6);
	$imgheader="header-$rnd.jpg";
	$imglogo="logo-white.png";
	if(in_array($rnd,array(1,2,5,6)))
		$imglogo="logo.png";
?>
<div class="barra_navegacion" style="background-image: url('<?= base_url("project_files/img/sistema/$imgheader"); ?>');">
	<div class="container">
		<img src="<?= base_url("project_files/img/sistema/$imglogo"); ?>" class="logo" onclick="location.href='<?= base_url("inicio/principal"); ?>'" />
		<div class="nombreAcceso">
			<?php if($this->session->userdata('idusuario')!==false): ?>
			Bienvenido <?= $this->session->userdata('datausr')["nombre"]; ?> <?= $this->session->userdata('datausr')["apaterno"]; ?> <?= $this->session->userdata('datausr')["amaterno"]; ?>
			<?php endif; ?>
		</div>
		<div class="btn-group pull-right menu_principal">
			<?php if($showMenu): ?>
				<?php if($this->modsesion->hasPermisoHijo(1)): ?>
				<div class="btn-group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Administración">
						Administración <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php if($this->modsesion->hasPermisoHijo(4)): ?>
						<li><a href="<?= base_url('clientes'); ?>">Clientes</a></li>
						<?php endif;
						if($this->modsesion->hasPermisoHijo(5)): ?>
						<li><a href="<?= base_url('productos'); ?>">Productos</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif;
				if($this->modsesion->hasPermisoHijo(2)): ?>
				<div class="btn-group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Administración">
						Operación <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php if($this->modsesion->hasPermisoHijo(12)): ?>
						<li><a href="<?= base_url('pedidos'); ?>">Pedidos</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif;
				if($this->modsesion->hasPermisoHijo(3)): ?>
				<div class="btn-group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Configuración">
						Configuracion <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php if($this->modsesion->hasPermisoHijo(6)): ?>
						<li><a href="<?= base_url('cambiopassword'); ?>">Cambiar Contraseña</a></li>
						<?php endif;
						if($this->modsesion->hasPermisoHijo(7)): ?>
						<li><a href="<?= base_url('reseteopassword'); ?>">Resetear Contraseña</a></li>
						<?php endif;
						if($this->modsesion->hasPermisoHijo(8)): ?>
						<li><a href="<?= base_url('catalogos'); ?>">Catalogos</a></li>
						<?php endif;
						if($this->modsesion->hasPermisoHijo(9)): ?>
						<li><a href="<?= base_url('usuarios'); ?>">Usuarios</a></li>
						<?php endif;
						if($this->modsesion->hasPermisoHijo(10)): ?>
						<li><a href="<?= base_url('perfiles'); ?>">Perfiles</a></li>
						<?php endif;
						if($this->modsesion->hasPermisoHijo(11)): ?>
						<li><a href="<?= base_url('permisos'); ?>">Permisos</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
			<?php endif; ?>
			<!--<button type="button" class="btn btn-default" title="Ayuda" onclick="window.open('<?= base_url('ayuda'); ?>','help_window')">
				<span class="glyphicon glyphicon-question-sign"></span>
			</button>-->
			<button type="button" class="btn btn-default" title="Salir" onclick="location.href='<?= base_url('sesiones/logout'); ?>'">
				<span class="glyphicon glyphicon-off"></span>
			</button>
		</div>
	</div>
</div>
<div style="clear: both;"></div>
