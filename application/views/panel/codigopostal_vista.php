<p>Buscador de Códigos Postales</p>
<div class="fuente_reducida">
	<form class="form-horizontal" role="form" method="post" id="frm_cp">
		<div class="form-group">
			<label for="frm_cp_cp" class="col-sm-4 control-label">Código Postal</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" id="frm_cp_cp" name="frm_cp_cp" value="<?= $cp; ?>" placeholder="Código Postal" />
			</div>
		</div>
		<div class="form-group">
			<label for="frm_cp_cp" class="col-sm-4 control-label">Colonia</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="frm_cp_colonia" name="frm_cp_colonia" value="<?= $colonia; ?>" placeholder="Colonia" />
			</div>
		</div>
		<div class="form-group">
			<label for="frm_cp_cp" class="col-sm-4 control-label">Delegación / Municipio</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="frm_cp_municipio" name="frm_cp_municipio" value="<?= $municipio; ?>" placeholder="Delegación / Municipio" />
			</div>
		</div>
		<div class="form-group">
			<label for="frm_cp_cp" class="col-sm-4 control-label">Estado</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="frm_cp_estado" name="frm_cp_estado" value="<?= $estado; ?>" placeholder="Estado" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-3"></div>
			<div class="col-sm-3">
				<button type="button" class="btn btn-success" id="btnBuscarCP">Buscar</button>
			</div>
			<div class="col-sm-3">
				<button type="button" class="btn btn-danger" id="btnCancelarCP">Cancelar</button>
			</div>
		</div>
	</form>
	<div class="table-responsive">
		<table class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th>CP</th>
					<th>Colonia</th>
					<th>Delegación / Municipio</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>CP</th>
					<th>Colonia</th>
					<th>Delegación / Municipio</th>
					<th>Estado</th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach($elementos as $elem): ?>
					<tr>
						<td>
							<a href="#" onclick="<?= $fnSelecciona; ?>('<?= $elem["cp"]; ?>','<?= $elem["asentamiento"]; ?>','<?= $elem["municipio"]; ?>','<?= $elem["estado"]; ?>')">
								<?= $elem["cp"]; ?>
							</a>
						</td>
						<td><?= $elem["asentamiento"]; ?></td>
						<td><?= $elem["municipio"]; ?></td>
						<td><?= $elem["estado"]; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>