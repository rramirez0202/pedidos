<form class="form-horizontal" role="form" id="frm_export">
	<div class="form-group">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">Exportar los pedidos que cumplan los siguientes criterios:</div>
		<div class="col-sm-1"></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Fecha Inicial</label>
		<div class="col-sm-4">
			<input class="form-control" type="date" id="fechainicio" name="fechainicio" value="<?= Today(); ?>" />
		</div>
		<label class="control-label col-sm-2">Fecha Final</label>
		<div class="col-sm-4">
			<input class="form-control" type="date" id="fechafin" name="fechafin" value="<?= Today(); ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Estado Actual</label>
		<div class="col-sm-10">
			<select class="form-control" id="estado" name="estado">
				<?php
				if($estados!==false) foreach($estados as $edo)
				{
					?>
					<option value="<?= $edo["idestado"]; ?>"><?= $edo["nombre"]; ?></option>
					<?php
				}
				?>
			</select>
		</div>
	</div>
</form>