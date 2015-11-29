<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(8)): ?>
			<button type="button" class="btn btn-default" title="Ver todos las Catalogos" onclick="location.href='<?= base_url('catalogos'); ?>';">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(64)):?>
			<button type="button" class="btn btn-default" title="Actualizar Catalogo" onclick="Catalogos.MuestraFrmUpd()">
				<span class="glyphicon glyphicon-edit"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(65)):?>
			<button type="button" class="btn btn-default" title="Agregar Opciones al Catalogo" onclick="Catalogos.MuestraFrmOpcs()">
				<span class="glyphicon glyphicon-plus"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(66)):?>
			<button type="button" class="btn btn-default" title="Borrar Opciones del Catalogo" onclick="Catalogos.BorrarOpciones()">
				<span class="glyphicon glyphicon-trash"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<h3>Catalogos <small><?= $catalogo["descripcion"]; ?></small></h3>
	<input type="hidden" name="idcatalogo" id="idcatalogo" value="<?= $catalogo["idcatalogo"]; ?>" />
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
								<td></td>
								<th>Opción</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td></td>
								<th>Opción</th>
							</tr>
						</tfoot>
						<tbody id="tablaOpciones">
							<?php if($catalogo["opciones"]!==false) foreach($catalogo["opciones"] as $opc): ?>
								<tr>
									<td>
										<input type="checkbox" value="<?= $opc["idcatalogodet"] ?>" />
									</td>
									<td>
										<?= $opc["descripcion"]; ?>
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