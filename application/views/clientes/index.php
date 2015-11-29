<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(28)): ?>
			<button type="button" class="btn btn-default" title="Nuevo Cliente" onclick="location.href='<?= base_url('clientes/nuevo');?>';">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(50)): ?>
			<button type="button" class="btn btn-default" title="Exportar a Excel" onclick="window.open('<?= base_url("clientes/exportarExcel"); ?>')">
				<span class="glyphicon glyphicon-save"></span> Excel
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(52)): ?>
			<button type="button" class="btn btn-default" title="Importar desde Excel" onclick="Cliente.FrmImportar('excel')">
				<span class="glyphicon glyphicon-open"></span> Excel
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(51)): ?>
			<button type="button" class="btn btn-default" title="Exportar a XML" onclick="window.open('<?= base_url("clientes/exportarXML"); ?>')">
				<span class="glyphicon glyphicon-download"></span> XML
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(53)): ?>
			<button type="button" class="btn btn-default" title="Importar desde XML" onclick="Cliente.FrmImportar('xml')">
				<span class="glyphicon glyphicon-upload"></span> XML
			</button>
			<?php endif; ?>
		</div>
	</div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("productos"); ?>'">
					<h1>Clientes</h1>
				</div>
			</td>
			<td>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Razón Social</th>
								<th>RFC</th>
								<th>Activo</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Cliente</th>
								<th>Razón Social</th>
								<th>RFC</th>
								<th>Activo</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if($clientes!==false) foreach($clientes as $cliente): ?>
							<tr>
								<td>
									<?php if($this->modsesion->hasPermisoHijo(29)): ?>
									<a href="<?= base_url("/clientes/ver/".$cliente["idcliente"]); ?>">
									<?php endif; ?>
										<?= $cliente["nombre"]; ?>
									<?php if($this->modsesion->hasPermisoHijo(29)): ?>
									</a>
									<?php endif; ?>
								</td>
								<td><?= $cliente["razonsocial"]; ?></td>
								<td><?= $cliente["rfc"]; ?></td>
								<td><input type="checkbox" disabled="disabled" <?= $cliente["activo"]=="1"?'checked="checked"':''; ?> /></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>
