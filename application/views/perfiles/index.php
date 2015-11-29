<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(13)): ?>
			<button type="button" class="btn btn-default" title="Nuevo Perfil" onclick="location.href='<?= base_url('perfiles/nuevo');?>';">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("configuracion"); ?>'">
					<h1>Configuración</h1>
				</div>
				<div class="list-group">
					<?php if($this->modsesion->hasPermisoHijo(6)): ?>
					<a href="<?= base_url("cambiopassword"); ?>" class="list-group-item">Cambiar Contraseña</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(7)): ?>
					<a href="<?= base_url("reseteopassword"); ?>" class="list-group-item">Resetar Contraseña</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(8)): ?>
					<a href="<?= base_url("catalogos"); ?>" class="list-group-item">Catalogos</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(10)): ?>
					<a href="<?= base_url("perfiles"); ?>" class="list-group-item active">Perfiles</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(11)): ?>
					<a href="<?= base_url("permisos"); ?>" class="list-group-item">Permisos</a>
					<?php endif; ?>
				</div>
			</td>
			<td>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nombre</th>
								<th>Descripción</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if($perfiles!==false) foreach($perfiles as $perfil): ?>
								<tr>
									<td>
										<?php if($this->modsesion->hasPermisoHijo(14)): ?>
										<a href="<?= base_url('perfiles/ver/'.$perfil["idperfil"])?>">
										<?php endif; ?>
											<?= $perfil["nombre"]; ?>
										<?php if($this->modsesion->hasPermisoHijo(14)): ?>
										</a>
										<?php endif; ?>
									</td>
									<td><?= $perfil["observaciones"]; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>