<?= $menumain; ?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(25)): ?>
			<button type="button" class="btn btn-default" title="Ver todos los Clientes" onclick="location.href='<?= base_url('clientes'); ?>';">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(26)): ?>
			<button type="button" class="btn btn-default" title="Actualizar Cliente" onclick="location.href='<?= base_url('clientes/actualizar/'.$objeto->getIdcliente()); ?>';">
				<span class="glyphicon glyphicon-edit"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(27)): ?>
			<button type="button" class="btn btn-default" title="Borrar Cliente" onclick="Cliente.Eliminar(<?= $objeto->getIdcliente(); ?>)">
				<span class="glyphicon glyphicon-trash"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("clientes"); ?>'">
					<h1>Clientes</h1>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_clientes" method="post" enctype="multipart/form-data">
					<input type="hidden" id="frm_producto_idcliente" name="frm_producto_idcliente" value="<?= $objeto->getIdcliente(); ?>" />
					<div class="form-group">
        				<label for="frm_cliente_nombre" class="col-sm-2 control-label">Cliente</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getNombre(); ?></p>
        				</div>
			        </div>
					<div class="form-group">
        				<label for="frm_cliente_razonsocial" class="col-sm-2 control-label">Razón Social</label>
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
        				<label for="frm_cliente_observaciones" class="col-sm-2 control-label">Observaciones</label>
        				<div class="col-sm-10">
        					<p class="form-control-static"><?= $objeto->getObservaciones(); ?></p>
        				</div>
			        </div>
			        <div class="form-group">
			        	<label for="frm_cliente_idwinapp" class="col-sm-2 control-label">Id WinApp</label>
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
			        <div class="form-group">
			        	<label for="frm_cliente_descuento" class="col-sm-2 control-label">Descuento</label>
			        	<div class="col-sm-10">
			        		<p class="form-control-static"><?= $objeto->getDescuento(); ?></p>
			        	</div>
			        </div>
				</form>
				<?php if($this->modsesion->hasPermisoHijo(32)): ?>
					<div class="btn-toolbar pull-right" role="toolbar">
						<div class="btn-group">
							<?php if($this->modsesion->hasPermisoHijo(34)): ?>
							<button type="button" class="btn btn-default" title="Nueva Sucursal" onclick="location.href='<?= base_url("sucursales/nuevo/".$objeto->getIdcliente()); ?>'">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<?php endif; ?>
						</div>
					</div>
					<h3>Sucursales</h3>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Contacto</th>
									<th>Ubicación</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Nombre</th>
									<th>Contacto</th>
									<th>Ubicación</th>
									<th>Activo</th>
								</tr>
							</tfoot>
							<tbody>
								<?php if($sucursales!==false) foreach($sucursales as $sucursal): ?>
									<tr>
										<td>
											<?php if($this->modsesion->hasPermisoHijo(35)): ?>
											<a href="<?= base_url("sucursales/ver/".$sucursal["idsucursal"]); ?>">
											<?php endif; ?>
												<?= $sucursal["nombre"]; ?>
											<?php if($this->modsesion->hasPermisoHijo(35)): ?>
											</a>
											<?php endif; ?>
										</td>
										<td>
											<?= $sucursal["contactonombre"]; ?><br />
											<?= $sucursal["contactotelefono1"]; ?> Ext. <?= $sucursal["contactoextension1"]; ?><br />
											<?= $sucursal["contactotelefono2"]; ?> Ext. <?= $sucursal["contactoextension2"]; ?><br />
											<a href="mailto:<?= $sucursal["contactoemail"]; ?>"><?= $sucursal["contactoemail"]; ?></a>
										</td>
										<td>
											<?= $sucursal["colonia"]; ?><br />
											<?= $sucursal["municipio"]; ?><br />
											<?= $sucursal["estado"]; ?><br />
										</td>
										<td><input type="checkbox" disabled="disabled" <?= ($sucursal["activo"]=="1"?'checked="checked"':''); ?> /></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
				<?php if($this->modsesion->hasPermisoHijo(33)): ?>
					<div class="btn-toolbar pull-right" role="toolbar">
						<div class="btn-group">
							<?php if($this->modsesion->hasPermisoHijo(36)): ?>
							<button type="button" class="btn btn-default" title="Nuevo Usuario" onclick="location.href='<?= base_url('usuarios/crear/'.$objeto->getIdcliente()); ?>'">
								<span class="glyphicon glyphicon-list-alt"></span>
							</button>
							<?php endif; ?>
						</div>
					</div>
					<h3>Usuarios</h3>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Usuario</th>
									<th>E-Mail</th>
									<th>Activo</th>
									<th>Id WindApp</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Nombre</th>
									<th>Usuario</th>
									<th>E-Mail</th>
									<th>Activo</th>
									<th>Id WindApp</th>
								</tr>
							</tfoot>
							<tbody>
								<?php if($usuarios!==false) foreach($usuarios as $usuario): ?>
									<tr>
										<td>
											<?php if($this->modsesion->hasPermisoHijo(37)): ?>
											<a href="<?= base_url("usuarios/ver/".$usuario["idusuario"]."/".$objeto->getIdcliente()); ?>">
											<?php endif; ?>
												<?= $usuario["nombre"]; ?> <?= $usuario["apaterno"]; ?> <?= $usuario["amaterno"]; ?>
											<?php if($this->modsesion->hasPermisoHijo(37)): ?>
											</a>
											<?php endif; ?>
										</td>
										<td><?= $usuario["usuario"]; ?></td>
										<td>
											<a href="mailto:<?= $usuario["email"]; ?>">
												<?= $usuario["email"]; ?>
											</a>
										</td>
										<td><input type="checkbox" disabled="disabled" <?= ($usuario["activo"]=="1"?'checked="checked"':''); ?> /></td>
										<td><?= $usuario["idwinapp"]; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			</td>
		</tr>
	</table>
</div>