<form class="form-horizontal" role="form" id="frm_sucursales" method="post" enctype="multipart/form-data" style="min-width: 650px;">
	<input type="hidden" id="frm_sucursal_idcliente" name="frm_sucursal_idcliente" value="<?= $objeto->getIdcliente(); ?>" />
	<input type="hidden" id="frm_sucursal_idsucursal" name="frm_sucursal_idsucursal" value="<?= $objeto->getIdsucursal(); ?>" />
	<input type="hidden" id="frm_sucursal_pais" name="frm_sucursal_pais" value="México" />
	<div class="form-group">
        <label for="frm_sucursal_nombre" class="col-sm-2 control-label">Sucursal <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        <div class="col-sm-10">
        	<p class="form-control-static"><?= $objeto->getNombre(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_contactonombre" class="col-sm-2 control-label">Contacto</label>
        <div class="col-sm-10">
        	<p class="form-control-static"><?= $objeto->getContactonombre(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_contactotelefono1" class="col-sm-2 control-label">Teléfono</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getContactotelefono1(); ?></p>
        </div>
        <label for="frm_sucursal_contactoextension1" class="col-sm-2 control-label">Extensión</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getContactoextension1(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_contactotelefono2" class="col-sm-2 control-label">Teléfono</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getContactotelefono2(); ?></p>
        </div>
        <label for="frm_sucursal_contactoextension2" class="col-sm-2 control-label">Extensión</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getContactoextension2(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_contactoemail" class="col-sm-2 control-label">E-Mail</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getContactoemail(); ?></p>
        </div>
        <label for="frm_sucursal_contactofax" class="col-sm-2 control-label">Fax</label>
        <div class="col-sm-4">
        	<p class="form-control-static"><?= $objeto->getContactofax(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_calle" class="col-sm-2 control-label">Calle</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getCalle(); ?></p>
        </div>
        <label for="frm_sucursal_noexterior" class="col-sm-2 control-label">Número Exterior</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getNoexterior(); ?></p>
        </div>
        <label for="frm_sucursal_nointerior" class="col-sm-2 control-label">Número Interior</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getNointerior(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_colonia" class="col-sm-2 control-label">Colonia</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getColonia(); ?></p>
        </div>
        <label for="frm_sucursal_municipio" class="col-sm-2 control-label">Municipio</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getMunicipio(); ?></p>
        </div>
        <label for="frm_sucursal_estado" class="col-sm-2 control-label">Estado</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getEstado(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_cp" class="col-sm-2 control-label">Código Postal</label>
        <div class="col-sm-2">
        	<p class="form-control-static"><?= $objeto->getCp(); ?></p>
        </div>
        <label for="frm_sucursal_referencias" class="col-sm-2 control-label">Referencias</label>
        <div class="col-sm-6">
        	<p class="form-control-static"><?= $objeto->getReferencias(); ?></p>
        </div>
	</div>
	<div class="form-group">
        <label for="frm_sucursal_observaciones" class="col-sm-2 control-label">Obs.</label>
        <div class="col-sm-10">
        	<p class="form-control-static"><?= $objeto->getObservaciones(); ?></p>
        </div>
	</div>
</form>