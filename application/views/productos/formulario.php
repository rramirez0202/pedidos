<?= $menumain; ?>
<div class="container">
	<div class="interespaciado"></div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("productos"); ?>'">
					<h1>Productos</h1>
				</div>
				<div class="contenedorImagen">
					<img src="<?= base_url('project_files/img/'.($objeto->getImagen()!=""?"productos/".$objeto->getImagen():"sistema/imagen-no-disponible.png")); ?>" class="productoDetalle" />
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_productos" method="post" enctype="multipart/form-data">
					<input type="hidden" id="frm_producto_idproducto" name="frm_producto_idproducto" value="<?= $objeto->getIdproducto(); ?>" />
					<div class="form-group">
        				<label for="frm_producto_nombre" class="col-sm-2 control-label">Producto <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
        				<div class="col-sm-10">
        					<input type="text" class="form-control" id="frm_producto_nombre" name="frm_producto_nombre" value="<?= $objeto->getNombre(); ?>" placeholder="Nombre del producto" maxlength="250" />
        				</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label" for="frm_producto_categoria">Categoría</label>
			        	<div class="col-sm-4">
			        		<select class="form-control" id="frm_producto_categoria" name="frm_producto_categoria">
			        			<option value=""></option>
			        			<?php if($categoria!==false) foreach($categoria["opciones"] as $opc): ?>
									<option value="<?= $opc["idcatalogodet"]; ?>" <?= ($opc["idcatalogodet"]==$objeto->getCategoria()?'selected="selected"':''); ?> >
										<?= $opc["descripcion"]; ?>
									</option>
								<?php endforeach; ?>
			        		</select>
			        	</div>
			        	<label class="col-sm-2 control-label" for="frm_producto_marca">Marca</label>
			        	<div class="col-sm-4">
			        		<select class="form-control" id="frm_producto_marca" name="frm_producto_marca">
			        			<option value=""></option>
			        			<?php if($marca!==false) foreach($marca["opciones"] as $opc): ?>
									<option value="<?= $opc["idcatalogodet"]; ?>" <?= ($opc["idcatalogodet"]==$objeto->getMarca()?'selected="selected"':''); ?> >
										<?= $opc["descripcion"]; ?>
									</option>
								<?php endforeach; ?>
			        		</select>
			        	</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_descripcion" class="col-sm-2 control-label">Descripción</label>
        				<div class="col-sm-10">
        					<textarea rows="3" class="form-control" id="frm_producto_descripcion" name="frm_producto_descripcion"><?= $objeto->getDescripcion(); ?></textarea>
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<textarea rows="3" class="form-control" id="frm_producto_observaciones" name="frm_producto_observaciones"><?= $objeto->getObservaciones(); ?></textarea>
        				</div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_producto_precio" class="col-sm-2 control-label">Precio <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
			        	<div class="col-sm-4">
			        		<input type="text" class="form-control" id="frm_producto_precio" name="frm_producto_precio" value="<?= $objeto->getPrecio(); ?>" placeholder="Precio" maxlength="255" />
			        	</div>
				        <div class="col-sm-6">
        					<div class="checkbox">
        						<label>
        							<input type="checkbox" value="1" id="frm_producto_activo" name="frm_producto_activo" <?= ($objeto->getActivo()==1?'checked="checked"':''); ?> />
        							Activo
        						</label>
        					</div>
				        </div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_producto_impuesto" class="col-sm-2 control-label">Impuesto</label>
			        	<div class="col-sm-4">
			        		<input type="text" class="form-control" id="frm_producto_impuesto" name="frm_producto_impuesto" value="<?= $objeto->getImpuesto(); ?>" placeholder="0.00" maxlength="5" />
			        	</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_fechacarga" class="col-sm-2 control-label">Fecha de Carga</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_producto_fechacarga" name="frm_producto_fechacarga" value="<?= $objeto->getFechacarga(); ?>" readonly="readonly" />
        				</div>
        				<label for="frm_producto_horacarga" class="col-sm-2 control-label">Hora de Carga</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_producto_horacarga" name="frm_producto_horacarga" value="<?= $objeto->getHoracarga(); ?>" readonly="readonly" />
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_fechaactualizacion" class="col-sm-2 control-label">Fecha de Actualización</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_producto_fechaactualizacion" name="frm_producto_fechaactualizacion" value="<?= $objeto->getFechaactualizacion(); ?>" readonly="readonly" />
        				</div>
        				<label for="frm_producto_horaactualizacion" class="col-sm-2 control-label">Hora de Actualización</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_producto_horaactualizacion" name="frm_producto_horaactualizacion" value="<?= $objeto->getHoraactualizacion(); ?>" readonly="readonly" />
        				</div>
			        </div>
			         <div class="form-group">
        				<label for="frm_producto_imagen" class="col-sm-2 control-label">fotografía</label>
        				<div class="col-sm-4">
        					<input type="file" class="form-control" id="frm_producto_imagen_file" name="frm_producto_imagen_file" value="" />
        					<input type="hidden" class="form-control" id="frm_producto_imagen" name="frm_producto_imagen" value="<?= $objeto->getImagen(); ?>" />
        				</div>
        				<label for="frm_producto_idwinapp" class="col-sm-2 control-label">Id WinApp</label>
        				<div class="col-sm-4">
        					<input type="text" class="form-control" id="frm_producto_idwinapp" name="frm_producto_idwinapp" value="<?= $objeto->getIdwinapp(); ?>" placeholder="Id WinApp" maxlength="255" />
        				</div>
			        </div>
			        <div class="form-group">
						<div class="col-sm-8"></div>
						<div class="col-sm-2">
			                <button type="button" class="btn btn-success" onclick="Producto.Enviar(<?= ($objeto->getIdproducto()!="" && $objeto->getIdproducto()!=0?'false':'true'); ?>)" >Guardar</button>
			            </div>
			            <div class="col-sm-2">
			                <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('productos'); ?>'">Cancelar</button>
			            </div>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>