<?= $menumain; ?>
<?php
$flujo=new Modflujo();
?>
<div class="container">
	<div class="btn-toolbar pull-right" role="toolbar">
		<div class="btn-group">
			<?php if($this->modsesion->hasPermisoHijo(42)): ?>
			<button type="button" class="btn btn-default" title="Nuevo Pedido" onclick="location.href='<?= base_url('pedidos/nuevo');?>';">
				<span class="glyphicon glyphicon-list-alt"></span>
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(58)): ?>
			<button type="button" class="btn btn-default" title="Exportar a Excel" onclick="Pedido.Exportar(true)">
				<span class="glyphicon glyphicon-save"></span> Excel
			</button>
			<?php endif;
			if($this->modsesion->hasPermisoHijo(60)): ?>
			<!--<button type="button" class="btn btn-default" title="Importar desde Excel" onclick="Pedido.FrmImportar('excel')">
				<span class="glyphicon glyphicon-open"></span> Excel
			</button>-->
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(59)): ?>
			<button type="button" class="btn btn-default" title="Exportar a XML" onclick="Pedido.Exportar(false)">
				<span class="glyphicon glyphicon-download"></span> XML
			</button>
			<?php endif; 
			if($this->modsesion->hasPermisoHijo(61)): ?>
			<!--<button type="button" class="btn btn-default" title="Importar desde XML" onclick="Pedido.FrmImportar('xml')">
				<span class="glyphicon glyphicon-upload"></span> XML
			</button>-->
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
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Pedido</th>
								<th>Creado Por</th>
								<th>Cliente</th>
								<th>Fecha/Hora Pedido</th>
								<th>Fecha/Hora Entrega</th>
								<th>Total</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Pedido</th>
								<th>Creado Por</th>
								<th>Cliente</th>
								<th>Fecha/Hora Pedido</th>
								<th>Fecha/Hora Entrega</th>
								<th>Total</th>
								<th>Estado</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if($pedidos!==false) foreach($pedidos as $pedido): 
								$ped=new Modpedido();
								$ped->setIdpedido($pedido["idpedido"]);
								$ped->getFromDatabase();
								$usr=new Modusuario();
								$usr->setIdusuario($ped->getIdusuario());
								$usr->getFromDatabase();
								$cte=new Modcliente();
								$cte->setIdcliente($ped->getIdcliente());
								$cte->getFromDatabase();
							?>
								<tr>
									<td>
										<?php if($this->modsesion->hasPermisoHijo(43)): ?>
										<a href="<?= base_url("pedidos/ver/".$pedido["idpedido"])?>">
										<?php endif; ?>
											Pedido <?= $pedido["idpedido"]?>
										<?php if($this->modsesion->hasPermisoHijo(43)): ?>
										</a>
										<?php endif; ?>
									</td>
									<td><?= $usr->getNombre()." ".$usr->getApaterno()." ".$usr->getAmaterno(); ?></td>
									<td><?= $cte->getNombre(); ?></td>
									<td><?= DateToMx($ped->getFechapedido())." ".$ped->getHorapedido(); ?></td>
									<td><?= DateToMx($ped->getFechaentrega())." ".$ped->getHoraentrega(); ?></td>
									<td>$ <?= number_format($ped->getTotal(),2)?></td>
									<td><?= $flujo->getEstado($ped->getStatus())["nombre"]; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>