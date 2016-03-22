<?= $menumain; ?>
<div class="container">
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("pedidos"); ?>'">
					<h1>Pedidos</h1>
				</div>
				<form class="form-horizontal" role="form" >
					<div class="form-group">
						<label class="control-label col-sm-2">Pedido </label>
						<div class="col-sm-10">
							<p class="form-control-static"><?= $objeto->getIdpedido(); ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Cliente </label>
						<div class="col-sm-10">
							<p class="form-control-static"><?= $cliente->getNombre(); ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Fecha </label>
						<div class="col-sm-10">
							<p class="form-control-static"><?= DateToMx($objeto->getFechapedido()); ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Hora </label>
						<div class="col-sm-10">
							<p class="form-control-static"><?= $objeto->getHorapedido(); ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Partidas </label>
						<div class="col-sm-6">
							<p class="form-control-static"><span class="badge pull-right" id="totalPartidas"><?= $objeto->getTotalPartidas(); ?></span></p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Total </label>
						<div class="col-sm-6">
							<p class="form-control-static"><span class="badge pull-right" id="totalCosto">$ <?= number_format($objeto->getTotal(),2); ?></span></p>
						</div>
					</div>
					<div class="centrar">
						<button type="button" class="btn btn-success" onclick="location.href='<?= base_url('pedidos/ver/'.$objeto->getIdpedido()); ?>'">Terminar</button>
					</div>
				</form>
			</td>
			<td>
				<div class="row">
					<div class="col-sm-5">
						<input type="search" class="form-control" placeholder="Buscar Producto" id="txtBusqueda" name="txtBusqueda" />
					</div>
					<div class="col-sm-1">
						<button type="button" class="btn btn-default" onclick="Pedido.Buscar()">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</div>
				</div>
				<!--<table><tr>-->
				<?php
					$productMaster=array();
					$h=1;
					foreach($productos as $k=>$prod) if($prod["activo"]==1)
					{
						$productMaster[$prod["idproducto"]]=$prod;
						?><!--<td>-->
						<div class="pull-left vistaProducto" id="panelProd<?= $prod["idproducto"]; ?>">
							<div class="panel panel-success">
								<div class="panel-heading">
									<?= $prod["nombre"]; ?>
								</div>
								<div class="panel-body">
									<table class="ancho100porciento">
										<tr>
											<td class="centrar">
												<img src="<?= base_url('project_files/img/'.($prod["imagen"]!=""?"productos/".$prod["imagen"]:"sistema/imagen-no-disponible.png")); ?>" class="productoVisuzalizacion" />
											</td>
										</tr>
										<tr><td><?= $prod["descripcion"]; ?></td></tr>
										<!--<tr><td><?= $prod["observaciones"]; ?></td></tr>-->
										<tr><td>Costo: $ <?= number_format($prod["precio"]*(1+($prod["impuesto"]/100.0)),2); ?></td></tr>
									</table>
									<?php //var_dump($prod); ?>
								</div>
								<div class="panel-footer">
									<table class="ancho100porciento">
										<tr>
											<td class="centrar centrarHorizontal ancho20porciento">
												<?php if($this->modsesion->hasPermisoHijo(47) || $this->modsesion->hasPermisoHijo(48)): ?>
												<button type="button" class="btn btn-default" onclick="Pedido.EliminaPartida(<?= $objeto->getIdpedido(); ?>,<?= $prod["idproducto"]?>)">
													<span class="glyphicon glyphicon-minus-sign"></span>
												</button>
												<?php endif; ?>
											</td>
											<td class="centrar centrarHorizontal ancho20porciento">												
												<?php if($this->modsesion->hasPermisoHijo(46) || $this->modsesion->hasPermisoHijo(47)): ?>
												<button type="button" class="btn btn-default" onclick="Pedido.AgregaPartida(<?= $objeto->getIdpedido(); ?>,<?= $prod["idproducto"]?>)">
													<span class="glyphicon glyphicon-plus-sign"></span>
												</button>
												<?php endif; ?>
											</td>
											<td class="centrar centrarHorizontal ancho40porciento">												
												<?php if($this->modsesion->hasPermisoHijo(46) || $this->modsesion->hasPermisoHijo(47)): ?>
												<input class="txtQty" type="text" id="txtQty_<?= $prod["idproducto"]?>" value="" size="2" maxlength="2" onkeypress="Pedido.AgregaPartidaCantidad(event,<?= $objeto->getIdpedido(); ?>,<?= $prod["idproducto"]?>,this.value,this)" />
												<?php endif; ?>
											</td>
											<td class="centrar centrarHorizontal ancho20porciento">
												<span class="badge" id="cantidad<?= $prod["idproducto"]?>">0</span>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<!--</td>--><?php
						if($h%4==0)
						{
							?><!--</tr><tr>--><?php
						}
						$h++;
					}
				?>
				</tr></table>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	var ProductMaster = <?= json_encode($productMaster); ?>;
	$(document).ready(function(){
		<?php if($objeto->getPartidas()!== false) foreach($objeto->getPartidas() as $p): 
			$part=new Modpartida();
			$part->setIdpartida($p);
			$part->getFromDatabase();
			?>
			Pedido.ActualizaPartidaCantidad(<?= $part->getIdproducto(); ?>,<?= $part->getCantidad(); ?>);
		<?php endforeach; ?>
	});
</script>