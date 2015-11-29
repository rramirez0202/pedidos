<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(24)): ?>
			<button type="button" class="btn btn-default" title="Nuevo Producto" onclick="location.href='<?= base_url('productos/nuevo');?>';">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(54)): ?>
			<button type="button" class="btn btn-default" title="Exportar a Excel" onclick="window.open('<?= base_url("productos/exportarExcel"); ?>')">
				<span class="glyphicon glyphicon-save"></span> Excel
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(56)): ?>
			<button type="button" class="btn btn-default" title="Importar desde Excel" onclick="Producto.FrmImportar('excel')">
				<span class="glyphicon glyphicon-open"></span> Excel
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(55)): ?>
			<button type="button" class="btn btn-default" title="Exportar a XML" onclick="window.open('<?= base_url("productos/exportarXML"); ?>')">
				<span class="glyphicon glyphicon-download"></span> XML
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(57)): ?>
			<button type="button" class="btn btn-default" title="Importar desde XML" onclick="Producto.FrmImportar('xml')">
				<span class="glyphicon glyphicon-upload"></span> XML
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
			</td>
			<td>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Descripcion</th>
								<th>Precio</th>
								<th>Activo</th>
								<th>Imagen</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Producto</th>
								<th>Descripcion</th>
								<th>Precio</th>
								<th>Activo</th>
								<th>Imagen</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if($productos!==false) foreach($productos as $producto): ?>
							<tr>
								<td>
									<?php if($this->modsesion->hasPermisoHijo(5)): ?>
									<a href="<?= base_url("/productos/ver/".$producto["idproducto"]); ?>">
									<?php endif; ?>
										<?= $producto["nombre"]; ?>
									<?php if($this->modsesion->hasPermisoHijo(5)): ?>
									</a>
									<?php endif; ?>
								</td>
								<td><?= $producto["descripcion"]; ?></td>
								<td>$ <?= number_format($producto["precio"],2); ?></td>
								<td><input type="checkbox" disabled="disabled" <?= ($producto["activo"]=="1"?'checked="checked"':'')?> /></td>
								<td class="centrar">
									<img src="<?= base_url('project_files/img/'.($producto["imagen"]!=""?"productos/".$producto["imagen"]:"sistema/imagen-no-disponible.png")); ?>" class="productoCatalogo" />
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>