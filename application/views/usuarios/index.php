<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<?php if($this->modsesion->hasPermisoHijo(18)): ?>
		<div class="btn-group">
			<button type="button" class="btn btn-default" title="Nuevo Usuario" onclick="location.href='<?= base_url('usuarios/nuevo');?>';">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
		</div>
		<?php endif; ?>
	</div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("usuarios"); ?>'">
					<h1>Usuarios</h1>
				</div>
			</td>
			<td>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Usuario</th>
								<th>E-Mail</th>
								<th>Activo</th>
								<th>Id WinApp</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nombre</th>
								<th>Usuario</th>
								<th>E-Mail</th>
								<th>Activo</th>
								<th>Id WinApp</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if($usuarios!==false) foreach($usuarios as $usuario): ?>
								<tr>
									<td>
										<?php if($this->modsesion->hasPermisoHijo(19)): ?>
										<a href="<?= base_url('usuarios/ver/'.$usuario["idusuario"])?>">
										<?php endif; ?>
											<?= $usuario["nombre"]; ?> <?= $usuario["apaterno"]; ?> <?= $usuario["amaterno"]; ?>
										<?php if($this->modsesion->hasPermisoHijo(19)): ?>
										</a>
										<?php endif; ?>
									</td>
									<td><?= $usuario["usuario"]?></td>
									<td>
										<a href="mailto: <?= $usuario["email"]?>">
											<?= $usuario["email"]?>
										</a>
									</td>
									<td>
										<input type="checkbox" <?= ($usuario["activo"]==1?'checked="checked"':''); ?> disabled="disabled" />
									</td>
									<td><?= $usuario["idwinapp"]; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
	
	<div class="col-sm-11">
		
	</div>
</div>