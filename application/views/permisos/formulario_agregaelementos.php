<h3>(<?= $permiso->getIdpermiso(); ?>) <?= $permiso->getNombre(); ?></h3>
<p><?= $permiso->getDescripcion(); ?></p>
<p>Permisos para agregar:</p>
<form id="elementosMenu">
	<input type="hidden" name="idpermiso" id="idpermiso" value="<?= $permiso->getIdpermiso(); ?>" />
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripción</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" name="elemento1" id="elemento1" value="" /></td>
					<td><input type="text" name="descripcion1" id="descripcion1" value="" /></td>
				</tr>
				<tr>
					<td><input type="text" name="elemento2" id="elemento2" value="" /></td>
					<td><input type="text" name="descripcion2" id="descripcion2" value="" /></td>
				</tr>
				<tr>
					<td><input type="text" name="elemento3" id="elemento3" value="" /></td>
					<td><input type="text" name="descripcion3" id="descripcion3" value="" /></td>
				</tr>
				<tr>
					<td><input type="text" name="elemento4" id="elemento4" value="" /></td>
					<td><input type="text" name="descripcion4" id="descripcion4" value="" /></td>
				</tr>
				<tr>
					<td><input type="text" name="elemento5" id="elemento5" value="" /></td>
					<td><input type="text" name="descripcion5" id="descripcion5" value="" /></td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
<br />
&nbsp;