<?= $menumain; ?>
<div class="container">
	<div class="interespaciado"></div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("clientes"); ?>'">
					<h1>Clientes</h1>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_clientes" method="post" enctype="multipart/form-data">
					<input type="hidden" id="frm_cliente_idcliente" name="frm_cliente_idcliente" value="<?= $objeto->getIdcliente(); ?>" />
					<div class="form-group">
        				<label for="frm_cliente_nombre" class="col-sm-2 control-label">Cliente <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_cliente_nombre" name="frm_cliente_nombre" value="<?= $objeto->getNombre(); ?>" placeholder="Nombre del cliente" maxlength="250" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_cliente_razonsocial" class="col-sm-2 control-label">Razón Social <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_cliente_razonsocial" name="frm_cliente_razonsocial" value="<?= $objeto->getRazonsocial(); ?>" placeholder="Razón social del cliente" maxlength="250" />
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_cliente_rfc" class="col-sm-2 control-label">RFC <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_cliente_rfc" name="frm_cliente_rfc" value="<?= $objeto->getRfc(); ?>" placeholder="RFC del cliente" maxlength="15" />
        				</div>
        				<label for="frm_cliente_curp" class="col-sm-2 control-label">CURP</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_cliente_curp" name="frm_cliente_curp" value="<?= $objeto->getCurp(); ?>" placeholder="CURP del cliente" maxlength="20" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_cliente_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<textarea rows="3" class="form-control" id="frm_cliente_observaciones" name="frm_cliente_observaciones"><?= $objeto->getObservaciones(); ?></textarea>
        				</div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_cliente_idwinapp" class="col-sm-2 control-label">Id WinApp</label>
			        	<div class="col-sm-4">
			        		<input type="text" class="form-control" id="frm_cliente_idwinapp" name="frm_cliente_idwinapp" value="<?= $objeto->getIdwinapp(); ?>" placeholder="Id WinApp" maxlength="255" />
			        	</div>
				        <div class="col-sm-6">
        					<div class="checkbox">
        						<label>
        							<input type="checkbox" value="1" id="frm_cliente_activo" name="frm_cliente_activo" <?= ($objeto->getActivo()==1?'checked="checked"':''); ?> />
        							Activo
        						</label>
        					</div>
				        </div>
			        </div>
			        <div class="form-group">
						<div class="col-sm-8"></div>
						<div class="col-sm-2">
			                <button type="button" class="btn btn-success" onclick="Cliente.Enviar(<?= ($objeto->getIdcliente()!="" && $objeto->getIdcliente()!=0?'false':'true'); ?>)" >Guardar</button>
			            </div>
			            <div class="col-sm-2">
			                <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('clientes'); ?>'">Cancelar</button>
			            </div>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>