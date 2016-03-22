<?php
include("phpExcel/PHPExcel.php");

$dir_in         = "../tmp/uploads/";
$dir_out        = "../tmp/uploads/";
$dir_template   = "../templates/";
$archivo        = (isset($_GET["arch"]) && $_GET["arch"]!="" && file_exists($dir_in.$_GET["arch"])?$_GET["arch"]:"");
$path        	= (isset($_GET["path"]) && $_GET["path"]!=""?$_GET["path"]:"");

if($archivo!="")
{
	$libro  	= PHPExcel_IOFactory::load($dir_in.$archivo);
    $hoja	   	= $libro->getSheet();
    $hojaPart	= $libro->getSheet(1);
	$doc		= new DOMDocument("1.0","utf-8");
	$raiz		= $doc->createElement("pedidos");
	foreach($hoja->getRowIterator() as $fila)
	{
		if($fila->getRowIndex()==1)
			continue;
		$cellIterator=$fila->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false);
		$elemento=$doc->createElement("pedido");
		foreach($cellIterator as $celda)
		{
			$valor=$celda->getValue();
			$valor=str_replace("&","&amp;",$valor);
			switch($celda->getColumn())
			{
				case "A":
					$elemento->setAttribute("idpedido",$valor);
					break;
				case "B":
					$elemento->setAttribute("idwinapp",$valor);
					break;
				case "C":
					$elemento->setAttribute("cteidwinapp",$valor);
					break;
				case "D":
					$elemento->setAttribute("cliente",$valor);
					break;
				case "E":
					$elemento->setAttribute("sucursalentrega",$valor);
					break;
				case "F":
					$elemento->setAttribute("sucursalcobro",$valor);
					break;
				case "G":
					$elemento->setAttribute("sucursalfacturacion",$valor);
					break;
				case "H":
					$dato=$valor;
					$dato=substr($dato,1);
					$dato=substr($dato,0,strlen($dato)-1);
					$elemento->setAttribute("fechapedido",$dato);
					break;
				case "I":
					$dato=$valor;
					$dato=substr($dato,1);
					$dato=substr($dato,0,strlen($dato)-1);
					$elemento->setAttribute("horapedido",$dato);
					break;
				case "J":
					$dato=$valor;
					$dato=substr($dato,1);
					$dato=substr($dato,0,strlen($dato)-1);
					$elemento->setAttribute("fechaentrega",$dato);
					break;
				case "K":
					$dato=$valor;
					$dato=substr($dato,1);
					$dato=substr($dato,0,strlen($dato)-1);
					$elemento->setAttribute("horaentrega",$dato);
					break;
				case "L":
					$elemento->setAttribute("estado",$valor);
					break;
			}
		}
		foreach($hojaPart->getRowIterator() as $filaP)
		{
			if($filaP->getRowIndex()==1)
				continue;
			$cellIterator=$filaP->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false);
			$elementoP=$doc->createElement("partida");
			foreach($cellIterator as $celda)
			{
				$valor=$celda->getValue();
				$valor=str_replace("&","&amp;",$valor);
				switch($celda->getColumn())
				{
					case "A":
						$elementoP->setAttribute("idpedido",$valor);
						break;
					case "B":
						$elementoP->setAttribute("idwinapp",$valor);
						break;
					case "C":
						$elementoP->setAttribute("idproducto",$valor);
						break;
					case "D":
						$elementoP->setAttribute("idwinappprod",$valor);
						break;
					case "E":
						$elementoP->setAttribute("producto",$valor);
						break;
					case "F":
						$elementoP->setAttribute("cantidad",$valor);
						break;
					case "G":
						$elementoP->setAttribute("precio",$valor);
						break;
					case "H":
						$elementoP->setAttribute("importe",$valor);
						break;
					case "I":
						$elementoP->setAttribute("estado",$valor);
						break;
				}
			}
			if(	
				$elementoP->getAttribute("idpedido")==$elemento->getAttribute("idpedido") 
				&& 
				$elementoP->getAttribute("idwinapp")==$elemento->getAttribute("idwinapp")
				)
			{   
				echo "Cargado para {$elementoP->getAttribute("idpedido")}=={$elemento->getAttribute("idpedido")} && {$elementoP->getAttribute("idwinapp")}=={$elemento->getAttribute("idwinapp")}<br >";
				$elemento->appendChild($elementoP);
			}
			else
			{
				echo "NO CARGADO para {$elementoP->getAttribute("idpedido")}=={$elemento->getAttribute("idpedido")} && {$elementoP->getAttribute("idwinapp")}=={$elemento->getAttribute("idwinapp")}<br >";
			}
		}
		if($elemento->getAttribute("idpedido")!=""||$elemento->getAttribute("idwinapp")!="")
		$raiz->appendChild($elemento);
	}
	$doc->appendChild($raiz);
	$doc->formatOutput=true;
    $doc->save($dir_out.str_replace(".","_",$archivo).".xml");
    header("location: $path/".str_replace(".","_",$archivo).".xml");
}