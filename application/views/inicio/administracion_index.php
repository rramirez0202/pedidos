<?= $menumain; ?>
<div class="container">
	<div class="absoluto">
		<div class="contenedorPrincipal">
			<?php if($this->modsesion->hasPermisoHijo(12)): ?>
			<div class="notePostIt notePostItExtended" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("pedidos"); ?>'">
				<h1>Pedidos</h1>
			</div>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(4)): ?>
			<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("clientes"); ?>'">
				<h1>Clientes</h1>
			</div>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(9)): ?>
			<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("productos"); ?>'">
				<h1>Productos</h1>
			</div>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(5)): ?>
			<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("usuarios"); ?>'">
				<h1>Usuarios</h1>
			</div>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(3)): ?>
			<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("configuracion"); ?>'">
				<h1>Configuración</h1>
			</div>	
			<?php endif; ?>
		</div>
	</div>
</div>