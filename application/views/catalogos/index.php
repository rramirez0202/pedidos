<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(62)): ?>
			<button type="button" class="btn btn-default" title="Nuevo Catalogo" onclick="Catalogos.MuestraFrmNuevo()">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<h3>Catalogos</h3>
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
					<a href="<?= base_url("catalogos"); ?>" class="list-group-item active">Catalogos</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(10)): ?>
					<a href="<?= base_url("perfiles"); ?>" class="list-group-item">Perfiles</a>
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
								<th>Catalogo</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Catalogo</th>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach($catalogos as $catalogo): ?>
								<tr>
									<td>
										<?php if($this->modsesion->hasPermisoHijo(63)): ?>
										<a href="<?= base_url('catalogos/ver/'.$catalogo["idcatalogo"]); ?>">
										<?php endif; ?>
											<?= $catalogo["descripcion"]; ?>
										<?php if($this->modsesion->hasPermisoHijo(63)): ?>
										</a>
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>