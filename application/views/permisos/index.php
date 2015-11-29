<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(15)): ?>
			<button type="button" class="btn btn-default" title="Nuevo Permiso" onclick="Permiso.CapturarNuevosElementos()">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(16)): ?>
			<button type="button" class="btn btn-default" title="Actualizar Permiso" onclick="Permiso.ActualizarElementos()">
				<span class="glyphicon glyphicon-edit"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(17)): ?>
			<button type="button" class="btn btn-default" title="Borrar Permiso" onclick="Permiso.EliminarConfirm()">
				<span class="glyphicon glyphicon-trash"></span>
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
					<a href="<?= base_url("perfiles"); ?>" class="list-group-item">Perfiles</a>
					<?php endif;
					if($this->modsesion->hasPermisoHijo(11)): ?>
					<a href="<?= base_url("permisos"); ?>" class="list-group-item active">Permisos</a>
					<?php endif; ?>
				</div>
			</td>
			<td>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Permiso</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Permiso</th>
								<th>Descripción</th>
							</tr>
						</tfoot>
						<tbody id="elementosMenu">
							<?php if($permisos!==false) foreach($permisos as $permiso) PrintPermiso($permiso); ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>
<?php
function PrintPermiso($permiso,$level=0)
{
	$levelStr="";
	for($x=1;$x<=$level;$x++)
		$levelStr.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	?>
	<tr>
		<td>
			<div class="checkbox">
				<?= $levelStr; ?>
				<label>
					<input type="checkbox" value="<?= $permiso["idpermiso"]; ?>" />
					(<?= $permiso["idpermiso"]; ?>) <?= $permiso["nombre"]; ?>
				</label>
			</div>
		</td>
		<td>
			<?= $permiso["descripcion"]; ?>
		</td>
	</tr>
	<?php
	if($permiso["hijos"]!==false)
		foreach($permiso["hijos"] as $p)
			PrintPermiso($p,$level+1);
}
?>