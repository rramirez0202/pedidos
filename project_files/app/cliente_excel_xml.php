<?php
include("phpExcel/PHPExcel.php");

$dir_in         = "../tmp/uploads/";
$dir_out        = "../tmp/uploads/";
$dir_template   = "../templates/";
$archivo        = (isset($_GET["arch"]) && $_GET["arch"]!="" && file_exists($dir_in.$_GET["arch"])?$_GET["arch"]:"");
$path        	= (isset($_GET["path"]) && $_GET["path"]!=""?$_GET["path"]:"");

if($archivo!="")
{
	$libro  = PHPExcel_IOFactory::load($dir_in.$archivo);
    $hoja   = $libro->getSheet();
	$doc	= new DOMDocument("1.0","utf-8");
	$raiz	= $doc->createElement("clientes");
    foreach($hoja->getRowIterator() as $fila)
    {
    	if($fila->getRowIndex()==1)
			continue;
		$cellIterator=$fila->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false);
		$elemento=$doc->createElement("cliente");
		$sucursales=$doc->createElement("sucursales");
		$sucursal=$doc->createElement("sucursal");
		$contactoSuc=$doc->createElement("contacto");
		$direccionSuc=$doc->createElement("direccion");
		$usuarios=$doc->createElement("usuarios");
		$usuario=$doc->createElement("usuario");
		foreach($cellIterator as $celda)
		{
			switch($celda->getColumn())
			{
				case "A":
					$elemento->setAttribute("cliente",$celda->getValue());
					break;
				case "B":
					$elemento->setAttribute("razonsocial",$celda->getValue());
					break;
				case "C":
					$elemento->setAttribute("rfc",$celda->getValue());
					break;
				case "D":
					$elemento->setAttribute("curp",$celda->getValue());
					break;
				case "E":
					$elemento->appendChild($doc->createElement("observaciones",$celda->getValue()));
					break;
				case "F":
					$elemento->setAttribute("idwinapp",$celda->getValue());
					break;
				case "G":
					$elemento->setAttribute("activo",(strtolower(trim($celda->getValue()))=="si"?"true":"false"));
					break;
				case "H":
					$sucursal->setAttribute("sucursal",$celda->getValue());
					break;
				case "I":
					$contactoSuc->setAttribute("nombre",$celda->getValue());
					break;
				case "J":
					$contactoSuc->setAttribute("telefono1",$celda->getValue());
					break;
				case "K":
					$contactoSuc->setAttribute("extension1",$celda->getValue());
					break;
				case "L":
					$contactoSuc->setAttribute("telefono2",$celda->getValue());
					break;
				case "M":
					$contactoSuc->setAttribute("extension2",$celda->getValue());
					break;
				case "N":
					$contactoSuc->setAttribute("email",$celda->getValue());
					break;
				case "O":
					$contactoSuc->setAttribute("fax",$celda->getValue());
					break;
				case "P":
					$direccionSuc->setAttribute("calle",$celda->getValue());
					break;
				case "Q":
					$direccionSuc->setAttribute("noexterior",$celda->getValue());
					break;
				case "R":
					$direccionSuc->setAttribute("nointerior",$celda->getValue());
					break;
				case "S":
					$direccionSuc->setAttribute("cp",$celda->getValue());
					break;
				case "T":
					$direccionSuc->setAttribute("colonia",$celda->getValue());
					break;
				case "U":
					$direccionSuc->setAttribute("municipio",$celda->getValue());
					break;
				case "V":
					$direccionSuc->setAttribute("estado",$celda->getValue());
					break;
				case "W":
					$direccionSuc->appendChild($doc->createElement("referencias",$celda->getValue()));
					break;
				case "X":
					$sucursal->appendChild($doc->createElement("observaciones",$celda->getValue()));
					break;
				case "Y":
					$sucursal->setAttribute("activo",(strtolower(trim($celda->getValue()))=="si"?"true":"false"));
					break;
				case "Z":
					$usuario->setAttribute("nombre",$celda->getValue());
					break;
				case "AA":
					$usuario->setAttribute("apaterno",$celda->getValue());
					break;
				case "AB":
					$usuario->setAttribute("amaterno",$celda->getValue());
					break;
				case "AC":
					$usuario->setAttribute("usuario",$celda->getValue());
					break;
				case "AD":
					$usuario->setAttribute("email",$celda->getValue());
					break;
				case "AE":
					$usuario->setAttribute("idwinapp",$celda->getValue());
					break;
				case "AF":
					$usuario->setAttribute("activo",(strtolower(trim($celda->getValue()))=="si"?"true":"false"));
					break;
			}
		}
		$direccionSuc->setAttribute("pais","MEXICO");
		$sucursal->appendChild($contactoSuc);
		$sucursal->appendChild($direccionSuc);
		$sucursales->appendChild($sucursal);
		$usuarios->appendChild($usuario);
		$elemento->appendChild($sucursales);
		$elemento->appendChild($usuarios);
		$raiz->appendChild($elemento);
    }
    $doc->appendChild($raiz);
	$doc->formatOutput=true;
    $doc->save($dir_out.str_replace(".","_",$archivo).".xml");
	header("location: $path/".str_replace(".","_",$archivo).".xml");
}
?>