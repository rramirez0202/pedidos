<?= $menumain; ?>
<div class="container">
	<div class="interespaciado"></div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("clientes/ver/".$objeto->getIdcliente()); ?>'">
					<h1>Sucursales</h1>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_sucursales" method="post" enctype="multipart/form-data">
					<input type="hidden" id="frm_sucursal_idcliente" name="frm_sucursal_idcliente" value="<?= $objeto->getIdcliente(); ?>" />
					<input type="hidden" id="frm_sucursal_idsucursal" name="frm_sucursal_idsucursal" value="<?= $objeto->getIdsucursal(); ?>" />
					<input type="hidden" id="frm_sucursal_pais" name="frm_sucursal_pais" value="México" />
					<div class="form-group">
        				<label for="frm_sucursal_nombre" class="col-sm-2 control-label">Sucursal <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_sucursal_nombre" name="frm_sucursal_nombre" value="<?= $objeto->getNombre(); ?>" placeholder="Sucursal del cliente" maxlength="250" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_sucursal_contactonombre" class="col-sm-2 control-label">Contacto</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_sucursal_contactonombre" name="frm_sucursal_contactonombre" value="<?= $objeto->getContactonombre(); ?>" placeholder="Nombre del Contacto" maxlength="250" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_sucursal_contactotelefono1" class="col-sm-2 control-label">Teléfono</label>
        				<div class="col-sm-4">
        					<input type="tel" class="form-control" id="frm_sucursal_contactotelefono1" name="frm_sucursal_contactotelefono1" value="<?= $objeto->getContactotelefono1(); ?>" placeholder="Telefono del Contacto" maxlength="20" />
        				</div>
        				<label for="frm_sucursal_contactoextension1" class="col-sm-2 control-label">Extensión</label>
        				<div class="col-sm-4">
        					<input type="tel" class="form-control" id="frm_sucursal_contactoextension1" name="frm_sucursal_contactoextension1" value="<?= $objeto->getContactoextension1(); ?>" placeholder="Extension" maxlength="10" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_sucursal_contactotelefono2" class="col-sm-2 control-label">Teléfono</label>
        				<div class="col-sm-4">
        					<input type="tel" class="form-control" id="frm_sucursal_contactotelefono2" name="frm_sucursal_contactotelefono2" value="<?= $objeto->getContactotelefono2(); ?>" placeholder="Telefono del Contacto" maxlength="20" />
        				</div>
        				<label for="frm_sucursal_contactoextension2" class="col-sm-2 control-label">Extensión</label>
        				<div class="col-sm-4">
        					<input type="tel" class="form-control" id="frm_sucursal_contactoextension2" name="frm_sucursal_contactoextension2" value="<?= $objeto->getContactoextension2(); ?>" placeholder="Extension" maxlength="10" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_sucursal_contactoemail" class="col-sm-2 control-label">E-Mail</label>
        				<div class="col-sm-4">
        					<input type="email" class="form-control" id="frm_sucursal_contactoemail" name="frm_sucursal_contactoemail" value="<?= $objeto->getContactoemail(); ?>" placeholder="E-Mail" maxlength="250" />
        				</div>
        				<label for="frm_sucursal_contactofax" class="col-sm-2 control-label">Fax</label>
        				<div class="col-sm-4">
        					<input type="tel" class="form-control" id="frm_sucursal_contactofax" name="frm_sucursal_contactofax" value="<?= $objeto->getContactofax(); ?>" placeholder="Fax" maxlength="20" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_sucursal_calle" class="col-sm-2 control-label">Calle</label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_sucursal_calle" name="frm_sucursal_calle" value="<?= $objeto->getCalle(); ?>" placeholder="Calle" maxlength="250" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_sucursal_noexterior" class="col-sm-2 control-label">Número Exterior</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_sucursal_noexterior" name="frm_sucursal_noexterior" value="<?= $objeto->getNoexterior(); ?>" placeholder="Número Exterior" maxlength="10" />
        				</div>
        				<label for="frm_sucursal_nointerior" class="col-sm-2 control-label">Número Interior</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_sucursal_nointerior" name="frm_sucursal_nointerior" value="<?= $objeto->getNointerior(); ?>" placeholder="Número Interior" maxlength="10" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_sucursal_cp" class="col-sm-2 control-label">Código Postal</label>
        				<div class="col-sm-3">
        					<input type="number" class="form-control" id="frm_sucursal_cp" name="frm_sucursal_cp" value="<?= $objeto->getCp(); ?>" placeholder="CP" maxlength="5" min="1" max="99999" />
        				</div>
        				<div class="col-sm-1">
        					<button type="button" class="btn btn-default" onclick="Sucursal.DisplayFrmCP()">
        						<span class="glyphicon glyphicon-search"></span>
        					</button>
        				</div>
        				<label for="frm_sucursal_colonia" class="col-sm-2 control-label">Colonia</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_sucursal_colonia" name="frm_sucursal_colonia" value="<?= $objeto->getColonia(); ?>" placeholder="Colonia" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_sucursal_municipio" class="col-sm-2 control-label">Municipio</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_sucursal_municipio" name="frm_sucursal_municipio" value="<?= $objeto->getMunicipio(); ?>" placeholder="Municipio" maxlength="250" />
        				</div>
        				<label for="frm_sucursal_estado" class="col-sm-2 control-label">Estado</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_sucursal_estado" name="frm_sucursal_estado" value="<?= $objeto->getEstado(); ?>" placeholder="Estado" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_sucursal_referencias" class="col-sm-2 control-label">Referencias</label>
        				<div class="col-sm-10">
        					<textarea rows="3" class="form-control" id="frm_sucursal_referencias" name="frm_sucursal_referencias"><?= $objeto->getReferencias(); ?></textarea>
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_sucursal_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<textarea rows="3" class="form-control" id="frm_sucursal_observaciones" name="frm_sucursal_observaciones"><?= $objeto->getObservaciones(); ?></textarea>
        				</div>
			        </div>
			        <div class="form-group">
			        	<div class="col-sm-2"></div>
						<div class="col-sm-6">
							<div class="checkbox">
        						<label>
        							<input type="checkbox" value="1" id="frm_sucursal_activo" name="frm_sucursal_activo" <?= ($objeto->getActivo()==1?'checked="checked"':''); ?> />
        							Activo
        						</label>
        					</div>
						</div>
						<div class="col-sm-2">
			                <button type="button" class="btn btn-success" onclick="Sucursal.Enviar(<?= ($objeto->getIdsucursal()!="" && $objeto->getIdsucursal()!=0?'false':'true'); ?>)" >Guardar</button>
			            </div>
			            <div class="col-sm-2">
			                <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url("clientes/ver/".$objeto->getIdcliente()); ?>'">Cancelar</button>
			            </div>
					</div>
			    </form>
			</td>
		</tr>
	</table>
</div>