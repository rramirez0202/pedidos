<?php 
$ca=array();
if($clientesActual!==false) 
	foreach($clientesActual as $cteAs)
		array_push($ca,$cteAs["idcliente"]);
?>
<table>
	<tr>
		<td>
			<div class="input-group" style="width: 100%; margin-bottom: 5px;">
				<input type="text" class="form-control" id="txtBuscar" />
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" onclick="Usuario.BuscaCte()">
						Buscar
					</button>
				</span>
				<input type="hidden" id="frmAssignIdUsr" value="<?= $idusr; ?>">
			</div>
		</td>
	</tr>
	<tr>
	    <td>
	    	<ul class="list-group listaclientes">
	    		<?php if($clientes!==false) foreach($clientes as $cte): 
	    			$assigned=false;
	    			if($clientesActual!==false) 
	    				foreach($clientesActual as $cteAs)
	    					if($cteAs["idcliente"]==$cte["idcliente"])
	    					{
								$assigned=true;
								break;
	    					}
	    			?>
	    			<li class="list-group-item<?= $assigned?" active":"" ?>" id="itemCte<?= $cte["idcliente"]; ?>" onclick="Usuario.SeleccionaCte('<?= $cte["idcliente"]; ?>')"><?= $cte["razonsocial"]." (".$cte["nombre"].")"; ?></li>
	    		<?php endforeach; ?>
	    	</ul>
	    	<input type="hidden" id="ctesSelected" name="ctesSelected" value="<?= implode(",",$ca); ?>" />
	    </td>
	</tr>
</table>