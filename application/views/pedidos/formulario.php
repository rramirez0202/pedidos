<?= $menumain; ?>
<?php
$cliente=new Modcliente();
$sucursal=new Modsucursal();
$jscte=array();
if($clientes!==false) foreach($clientes as $cte)
{
	$cliente->setIdcliente($cte["idcliente"]);
	$cliente->getFromDatabase();
	$sucs=$cliente->getSucursales();
	$jscte[$cte["idcliente"]]=array();
	if($sucs!==false) foreach($sucs as $suc)
	{
		$sucursal->setIdsucursal($suc);
		$sucursal->getFromDatabase();
		array_push($jscte[$cte["idcliente"]],array(
			"idsucursal"=>$sucursal->getIdsucursal(),
			"display"=>$sucursal->getNombre()." - ".$sucursal->getCalle().", ".$sucursal->getColonia().", ".$sucursal->getMunicipio(),
		));
	}
}
?>
<div class="container">
	<table class="contenidos">
		<tr>
			<td class="primero">
				<div class="notePostIt" style="background-image: url('<?= base_url("project_files/img/sistema/post-it.png"); ?>');" onclick="location.href='<?= base_url("pedidos"); ?>'">
					<h1>Pedidos</h1>
				</div>
			</td>
			<td>
				<form class="form-horizontal" role="form" id="frm_pedidos">
			        <input type="hidden" id="frm_pedido_idpedido" name="frm_pedido_idpedido" value="<?= $objeto->getIdpedido(); ?>" />
			        <input type="hidden" id="frm_pedido_fechapedido" name="frm_pedido_fechapedido" value="<?= $objeto->getFechapedido(); ?>" />
			        <input type="hidden" id="frm_pedido_horapedido" name="frm_pedido_horapedido" value="<?= $objeto->getHorapedido(); ?>" />
			        <input type="hidden" id="frm_pedido_fechaentrega" name="frm_pedido_fechaentrega" value="<?= $objeto->getFechaentrega(); ?>" />
			        <input type="hidden" id="frm_pedido_horaentrega" name="frm_pedido_horaentrega" value="<?= $objeto->getHoraentrega(); ?>" />
			        <input type="hidden" id="frm_pedido_totalpartidas" name="frm_pedido_totalpartidas" value="<?= $objeto->getTotalpartidas(); ?>" />
			        <input type="hidden" id="frm_pedido_descuentoporcentaje" name="frm_pedido_descuentoporcentaje" value="<?= $objeto->getDescuentoporcentaje(); ?>" />
			        <input type="hidden" id="frm_pedido_descuentomonto" name="frm_pedido_descuentomonto" value="<?= $objeto->getDescuentomonto(); ?>" />
			        <input type="hidden" id="frm_pedido_subtotal" name="frm_pedido_subtotal" value="<?= $objeto->getSubtotal(); ?>" />
			        <input type="hidden" id="frm_pedido_ivaporcentaje" name="frm_pedido_ivaporcentaje" value="<?= $objeto->getIvaporcentaje(); ?>" />
			        <input type="hidden" id="frm_pedido_ivamonto" name="frm_pedido_ivamonto" value="<?= $objeto->getIvamonto(); ?>" />
			        <input type="hidden" id="frm_pedido_total" name="frm_pedido_total" value="<?= $objeto->getTotal(); ?>" />
			        <input type="hidden" id="frm_pedido_status" name="frm_pedido_status" value="<?= $objeto->getStatus(); ?>" />
			        <input type="hidden" id="frm_pedido_idusuario" name="frm_pedido_idusuario" value="<?= $objeto->getidusuario(); ?>" />
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_idcliente">Cliente <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
			        	<div class="col-sm-8">
			        		<select class="form-control" id="frm_pedido_idcliente" name="frm_pedido_idcliente" onchange="Pedido.AjustaSucursales(this.value)">
			        			<option value=""></option>
			        			<?php if($clientes!==false) foreach($clientes as $cte): ?>
			        				<option value="<?= $cte["idcliente"]; ?>" <?= ($cte["idcliente"]==$objeto->getIdcliente()?'selected="selected"':''); ?>><?= $cte["nombre"]; ?></option>
			        			<?php endforeach; ?>
			        		</select>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_sucursaldireccion">Sucursal para facturación <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
			        	<div class="col-sm-8">
			        		<select class="form-control" id="frm_pedido_sucursaldireccion" name="frm_pedido_sucursaldireccion">
			        			<?php if($objeto->getIdcliente()>0 && isset($jscte[$objeto->getIdcliente()])) foreach($jscte[$objeto->getIdcliente()] as $suc): ?>
			        				<option value="<?= $suc["idsucursal"]; ?>" <?= ($suc["idsucursal"]==$objeto->getsucursaldireccion()?'selected="selected"':''); ?>><?= $suc["display"]; ?></option>
			        			<?php endforeach; ?>
			        		</select>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_sucursalentrega">Sucursal para entregar <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
			        	<div class="col-sm-8">
			        		<select class="form-control" id="frm_pedido_sucursalentrega" name="frm_pedido_sucursalentrega">
			        			<?php if($objeto->getIdcliente()>0 && isset($jscte[$objeto->getIdcliente()])) foreach($jscte[$objeto->getIdcliente()] as $suc): ?>
			        				<option value="<?= $suc["idsucursal"]; ?>" <?= ($suc["idsucursal"]==$objeto->getsucursalentrega()?'selected="selected"':''); ?>><?= $suc["display"]; ?></option>
			        			<?php endforeach; ?>
			        		</select>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_sucursalpago">Sucursal para cobro <abbr class="text-danger" title="Campo Obligatorio">(*)</abbr></label>
			        	<div class="col-sm-8">
			        		<select class="form-control" id="frm_pedido_sucursalpago" name="frm_pedido_sucursalpago">
			        			<?php if($objeto->getIdcliente()>0 && isset($jscte[$objeto->getIdcliente()])) foreach($jscte[$objeto->getIdcliente()] as $suc): ?>
			        				<option value="<?= $suc["idsucursal"]; ?>" <?= ($suc["idsucursal"]==$objeto->getsucursalpago()?'selected="selected"':''); ?>><?= $suc["display"]; ?></option>
			        			<?php endforeach; ?>
			        		</select>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label class="col-sm-4 control-label" for="frm_pedido_idwinapp">Id WinApp</label>
			        	<div class="col-sm-8">
			        		<input type="text" class="form-control" id="frm_pedido_idwinapp" name="frm_pedido_idwinapp" value="<?= $objeto->getIdwinapp(); ?>" />
			        	</div>
			        </div>
			        <div class="form-group">
						<div class="col-sm-8"></div>
						<div class="col-sm-2">
			                <button type="button" class="btn btn-success" onclick="Pedido.Enviar(<?= ($objeto->getIdpedido()!="" && $objeto->getIdpedido()!=0?'false':'true'); ?>)" >Guardar</button>
			            </div>
			            <div class="col-sm-2">
			                <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('pedidos'); ?>'">Cancelar</button>
			            </div>
					</div>
			    </form>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	var clientesSucursales = <?= json_encode($jscte); ?>;
</script>