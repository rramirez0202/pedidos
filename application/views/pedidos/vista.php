<?= $menumain; ?>
<?php
$cliente=new Modcliente();
$cliente->setIdcliente($objeto->getIdcliente());
$cliente->getFromDatabase();
$sucursal=new Modsucursal();
$flujo=new Modflujo();
$partida=new Modpartida();
$producto=new Modproducto();
?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(12)): ?>
			<button type="button" class="btn btn-default" title="Ver todos los Pedidos" onclick="location.href='<?= base_url('pedidos'); ?>';">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(67)): ?>
			<button type="button" class="btn btn-default" title="Actualizar Pedido" onclick="location.href='<?= base_url('pedidos/actualizar/'.$objeto->getIdpedido()); ?>';">
				<span class="glyphicon glyphicon-edit"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(67) && in_array($objeto->getStatus(),$this->config->item('estadospedidoactualizapartidas'))): ?>
			<button type="button" class="btn btn-default" title="Productos" onclick="location.href='<?= base_url('pedidos/productos/'.$objeto->getIdpedido()); ?>';">
				<span class="glyphicon glyphicon-shopping-cart"></span>
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(68)): ?>
			<button type="button" class="btn btn-default" title="Borrar Pedido" onclick="Pedido.Eliminar(<?= $objeto->getIdpedido(); ?>)">
				<span class="glyphicon glyphicon-trash"></span>
			</button>
			<?php endif; ?>
		</div>
	</div>
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("pedidos"); ?>'">
					<h1>Pedidos</h1>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_pedidos">
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_idcliente">Cliente</label>
			        	<div class="col-sm-8">
			        		<p class="form-control-static">
			        			<button type="button" class="btn btn-default btn-xs" title="Ver" onclick="Pedido.verCliente(<?= $cliente->getIdcliente(); ?>)">
			        				<span class="glyphicon glyphicon-eye-open"></span>
			        			</button>
			        			<?= $cliente->getNombre(); ?>
			        		</p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_sucursaldireccion">Sucursal para facturación</label>
			        	<div class="col-sm-8">
			        		<?php
			        		$sucursal->setIdsucursal($objeto->getSucursalDireccion());
			        		$sucursal->getFromDatabase();
			        		?>
			        		<p class="form-control-static">
			        			<button type="button" class="btn btn-default btn-xs" title="Ver" onclick="Pedido.verSucursal(<?= $sucursal->getIdsucursal(); ?>)">
			        				<span class="glyphicon glyphicon-eye-open"></span>
			        			</button>
			        			<?= $sucursal->getNombre().", ".$sucursal->getCalle().", ".$sucursal->getColonia().", ".$sucursal->getMunicipio(); ?>
			        		</p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_sucursalentrega">Sucursal para entregar</label>
			        	<div class="col-sm-8">
			        		<?php
			        		$sucursal->setIdsucursal($objeto->getSucursalentrega());
			        		$sucursal->getFromDatabase();
			        		?>
			        		<p class="form-control-static">
			        			<button type="button" class="btn btn-default btn-xs" title="Ver" onclick="Pedido.verSucursal(<?= $sucursal->getIdsucursal(); ?>)">
			        				<span class="glyphicon glyphicon-eye-open"></span>
			        			</button>
			        			<?= $sucursal->getNombre().", ".$sucursal->getCalle().", ".$sucursal->getColonia().", ".$sucursal->getMunicipio(); ?>
			        		</p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_sucursalpago">Sucursal para cobro</label>
			        	<div class="col-sm-8">
			        		<?php
			        		$sucursal->setIdsucursal($objeto->getSucursalpago());
			        		$sucursal->getFromDatabase();
			        		?>
			        		<p class="form-control-static">
			        			<button type="button" class="btn btn-default btn-xs" title="Ver" onclick="Pedido.verSucursal(<?= $sucursal->getIdsucursal(); ?>)">
			        				<span class="glyphicon glyphicon-eye-open"></span>
			        			</button>
			        			<?= $sucursal->getNombre().", ".$sucursal->getCalle().", ".$sucursal->getColonia().", ".$sucursal->getMunicipio(); ?>
			        		</p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_idwinapp">Id WinApp</label>
			        	<div class="col-sm-8">
			        		<p class="form-control-static"><?= $objeto->getIdwinapp(); ?></p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label">Fecha y Hora del Pedido</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= DateToMx($objeto->getFechapedido())." ".$objeto->getHorapedido(); ?></p>
			        	</div>
			        	<label class="col-sm-2 control-label">Fecha y Hora de Entrega</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= DateToMx($objeto->getFechaentrega())." ".$objeto->getHoraentrega(); ?></p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label">No. Partidas</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= $objeto->getTotalPartidas(); ?></p>
			        	</div>
			        	<label class="col-sm-2 control-label">Total</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">$ <?= number_format($objeto->getTotal(),2); ?></p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label">Descuento Porcentaje</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= number_format($objeto->getDescuentoporcentaje(),2); ?> %</p>
			        	</div>
			        	<label class="col-sm-2 control-label">Descuento Monto</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">$ <?= number_format($objeto->getdescuentomonto(),2); ?></p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label">I.V.A. Porcentaje</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= number_format($objeto->getivaporcentaje(),2); ?> %</p>
			        	</div>
			        	<label class="col-sm-2 control-label">I.V.A. Monto</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">$ <?= number_format($objeto->getivamonto(),2); ?></p>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-2 control-label">Estado Actual</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static"><?= $flujo->getEstado($objeto->getStatus())["nombre"]; ?> </p>
			        	</div>
			        	<label class="col-sm-2 control-label">Subtotal</label>
			        	<div class="col-sm-4">
			        		<p class="form-control-static">$ <?= number_format($objeto->getsubtotal(),2); ?></p>
			        	</div>
			        </div>
			    </form>
			    <?php if($acciones!==false): ?>
			    	<div class="btn-group">
			    		<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
			    			Acciones
			    			<span class="caret"></span>
			    		</button>
			    		<ul class="dropdown-menu" role="menu">
			    			<?php foreach($acciones as $acc): ?>
			    				<li onclick="Pedido.cambiaEstado(<?= $objeto->getIdpedido(); ?>,<?= $acc["idaccion"]; ?>)">
			    					<a href="#"><?= $acc["nombre"]; ?></a>
			    				</li>
						    <?php endforeach; ?>
			    		</ul>
			    	</div>
			    <?php endif;
			    if($objeto->getPartidas()!==false):
			    	$statusPartidaActualizable=false;
			    	foreach($objeto->getPartidas() as $p)
			    	{
						$partida->setIdpartida($p);
						$partida->getFromDatabase();
						if(
							in_array($partida->getStatus(),$this->config->item('estadospedidoactualizapartidasestado'))
							)
						{
							$statusPartidaActualizable=true;
							break;
						}
					}
			    	?>
			    	<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<?php if($this->modsesion->hasPermisoHijo(49) && $statusPartidaActualizable): ?>
									<th>Acción</th>
									<?php endif; ?>
									<th>Imagen</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Importe</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<?php if($this->modsesion->hasPermisoHijo(49) && $statusPartidaActualizable): ?>
									<th>Acción</th>
									<?php endif; ?>
									<th>Imagen</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Importe</th>
									<th>Estado</th>
								</tr>
							</tfoot>
							<tbody>
								<?php foreach($objeto->getPartidas() as $p):
								$partida->setIdpartida($p);
								$partida->getFromDatabase();
								$producto->setIdproducto($partida->getIdproducto());
								$producto->getFromDatabase();
								?>
								<tr>
									<?php if($this->modsesion->hasPermisoHijo(49) && $statusPartidaActualizable): ?>
									<td>
										<?php
										$acc2=$this->modflujo->getAcciones($this->config->item('idflujopartida'),$partida->getStatus());
										if($acc2!==false): ?>
			    							<div class="btn-group">
			    								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    									Acciones
			    									<span class="caret"></span>
			    								</button>
			    								<ul class="dropdown-menu" role="menu" id="accionesPartida<?= $partida->getIdpartida(); ?>">
			    									<?php foreach($acc2 as $acc): ?>
			    										<li onclick="Pedido.cambiaEstadoPartida(<?= $partida->getIdpartida(); ?>,<?= $acc["idaccion"]; ?>)">
			    											<a href="#"><?= $acc["nombre"]; ?></a>
			    										</li>
												    <?php endforeach; ?>
			    								</ul>
			    							</div>
									    <?php endif;?>
									</td>
									<?php endif; ?>
									<td class="centrar">
										<img src="<?= base_url('project_files/img/'.($producto->getImagen()!=""?"productos/".$producto->getImagen():"sistema/imagen-no-disponible.png")); ?>" class="productoCatalogo" />
									</td>
									<td><?= $partida->getConcepto(); ?></td>
									<td><?= $partida->getCantidad(); ?></td>
									<td>$ <?= number_format($partida->getPreciounitario(),2); ?></td>
									<td>$ <?= number_format($partida->getImporte(),2); ?></td>
									<td id="statusPartida<?= $partida->getIdpartida(); ?>">
										<?= $flujo->getEstado($partida->getStatus())["nombre"]; ?>
									</td>
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