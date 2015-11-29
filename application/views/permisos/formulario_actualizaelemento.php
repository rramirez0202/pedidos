<h3>(<?= $permiso->getIdpermiso(); ?>) <?= $permiso->getNombre(); ?></h3>
<p><?= $permiso->getDescripcion(); ?></p>
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
					<td><input type="text" name="elemento" id="elemento" value="<?= $permiso->getNombre(); ?>" /></td>
					<td><input type="text" name="descripcion" id="descripcion" value="<?= $permiso->getDescripcion(); ?>" /></td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
<br />
&nbsp;