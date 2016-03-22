<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(25)): ?>
			<button type="button" class="btn btn-default" title="Ver todos los Productos" onclick="location.href='<?= base_url('productos'); ?>';">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(26)): ?>
			<button type="button" class="btn btn-default" title="Actualizar Producto" onclick="location.href='<?= base_url('productos/actualizar/'.$objeto->getIdproducto()); ?>';">
				<span class="glyphicon glyphicon-edit"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(27)): ?>
			<button type="button" class="btn btn-default" title="Borrar Producto" onclick="Producto.Eliminar(<?= $objeto->getIdproducto(); ?>)">
				<span class="glyphicon glyphicon-trash"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
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
        				<label for="frm_producto_nombre" class="col-sm-2 control-label">Producto</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getNombre(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label" for="frm_producto_categoria">Categoría</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">
			        			<?php if($categoria!==false) foreach($categoria["opciones"] as $opc): ?>
			        				<?= $opc["idcatalogodet"]==$objeto->getCategoria()?$opc["descripcion"]:""; ?>
								<?php endforeach; ?>
			        		</p>
			        	</div>
			        	<label class="col-sm-2 control-label" for="frm_producto_marca">Marca</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">
			        			<?php if($marca!==false) foreach($marca["opciones"] as $opc): ?>
			        				<?= $opc["idcatalogodet"]==$objeto->getMarca()?$opc["descripcion"]:""; ?>
								<?php endforeach; ?>
			        		</p>
			        	</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_descripcion" class="col-sm-2 control-label">Descripción</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getDescripcion(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getObservaciones(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_producto_precio" class="col-sm-2 control-label">Precio</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">$ <?= number_format($objeto->getPrecio(),2); ?></p>
			        	</div>
				        <div class="col-sm-6">
        					<div class="checkbox">
        						<label>
        							<input type="checkbox" value="1" id="frm_producto_activo" name="frm_producto_activo" <?= ($objeto->getActivo()==1?'checked="checked"':''); ?> disabled="disabled" />
        							Activo
        						</label>
        					</div>
				        </div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_producto_impuesto" class="col-sm-2 control-label">Impuesto</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= $objeto->getImpuesto(); ?></p>
			        	</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_fechacarga" class="col-sm-2 control-label">Fecha de Carga</label>
        				<div class="col-sm-4">
        					<p class="form-control-static"><?= DateToMx($objeto->getFechacarga()); ?></p>
        				</div>
        				<label for="frm_producto_horacarga" class="col-sm-2 control-label">Hora de Carga</label>
        				<div class="col-sm-4">
        					<p class="form-control-static"><?= $objeto->getHoracarga(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
        				<label for="frm_producto_fechaactualizacion" class="col-sm-2 control-label">Fecha de Actualización</label>
        				<div class="col-sm-4">
        					<p class="form-control-static"><?= DateToMx($objeto->getFechaactualizacion()); ?></p>
        				</div>
        				<label for="frm_producto_horaactualizacion" class="col-sm-2 control-label">Hora de Actualización</label>
        				<div class="col-sm-4">
        					<p class="form-control-static"><?= $objeto->getHoraactualizacion(); ?></p>
        				</div>
			        </div>
			         <div class="form-group">
			         	<div class="col-sm-6"></div>
        				<label for="frm_producto_idwinapp" class="col-sm-2 control-label">Id WinApp</label>
        				<div class="col-sm-4">
        					<p class="form-control-static"><?= $objeto->getIdwinapp(); ?></p>
        				</div>
			        </div>
				</form>
			</td>
		</tr>
	</table>
</div>