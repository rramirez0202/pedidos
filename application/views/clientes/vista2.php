<form class="form-horizontal" role="form" id="frm_clientes" method="post" enctype="multipart/form-data" style="min-width: 450px;">
	<input type="hidden" id="frm_producto_idcliente" name="frm_producto_idcliente" value="<?= $objeto->getIdcliente(); ?>" />
	<div class="form-group">
        <label for="frm_cliente_nombre" class="col-sm-2 control-label">Cliente </label>
        <div class="col-sm-10">
        	<p class="form-control-static"><?= $objeto->getNombre(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_cliente_razonsocial" class="col-sm-2 control-label">Razón Social </label>
        <div class="col-sm-10">
        	<p class="form-control-static"><?= $objeto->getRazonsocial(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_cliente_rfc" class="col-sm-2 control-label">RFC</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getRfc(); ?></p>
        </div>
        <label for="frm_cliente_curp" class="col-sm-2 control-label">CURP</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getCurp(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_cliente_observaciones" class="col-sm-2 control-label">Obs.</label>
        <div class="col-sm-10">
        	<p class="form-control-static"><?= $objeto->getObservaciones(); ?></p>
        </div>
	</div>
	<div class="form-group">
		<label for="frm_cliente_idwinapp" class="col-sm-2 control-label">Id WinApp </label>
		<div class="col-sm-4">
			<p class="form-control-static"><?= $objeto->getIdwinapp(); ?></p>
		</div>
		<div class="col-sm-6">
        	<div class="checkbox">
        		<label>
        			<input type="checkbox" value="1" id="frm_cliente_activo" name="frm_cliente_activo" <?= ($objeto->getActivo()==1?'checked="checked"':''); ?> disabled="disabled" />
        			Activo
        		</label>
        	</div>
		</div>
	</div>
</form>