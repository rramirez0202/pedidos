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
			$valor=$celda->getValue();
			$valor=str_replace("&","&amp;",$valor);
			switch($celda->getColumn())
			{
				case "A":
					$elemento->setAttribute("cliente",$valor);
					break;
				case "B":
					$elemento->setAttribute("razonsocial",$valor);
					break;
				case "C":
					$elemento->setAttribute("rfc",$valor);
					break;
				case "D":
					$elemento->setAttribute("curp",$valor);
					break;
				case "E":
					$elemento->appendChild($doc->createElement("observaciones",$valor));
					break;
				case "F":
					$elemento->setAttribute("idwinapp",$valor);
					break;
				case "G":
					$elemento->setAttribute("activo",(strtolower(trim($valor))=="si"?"true":"false"));
					break;
				case "H":
					$sucursal->setAttribute("sucursal",$valor);
					break;
				case "I":
					$contactoSuc->setAttribute("nombre",$valor);
					break;
				case "J":
					$contactoSuc->setAttribute("telefono1",$valor);
					break;
				case "K":
					$contactoSuc->setAttribute("extension1",$valor);
					break;
				case "L":
					$contactoSuc->setAttribute("telefono2",$valor);
					break;
				case "M":
					$contactoSuc->setAttribute("extension2",$valor);
					break;
				case "N":
					$contactoSuc->setAttribute("email",$valor);
					break;
				case "O":
					$contactoSuc->setAttribute("fax",$valor);
					break;
				case "P":
					$direccionSuc->setAttribute("calle",$valor);
					break;
				case "Q":
					$direccionSuc->setAttribute("noexterior",$valor);
					break;
				case "R":
					$direccionSuc->setAttribute("nointerior",$valor);
					break;
				case "S":
					$direccionSuc->setAttribute("cp",$valor);
					break;
				case "T":
					$direccionSuc->setAttribute("colonia",$valor);
					break;
				case "U":
					$direccionSuc->setAttribute("municipio",$valor);
					break;
				case "V":
					$direccionSuc->setAttribute("estado",$valor);
					break;
				case "W":
					$direccionSuc->appendChild($doc->createElement("referencias",$valor));
					break;
				case "X":
					$sucursal->appendChild($doc->createElement("observaciones",$valor));
					break;
				case "Y":
					$sucursal->setAttribute("activo",(strtolower(trim($valor))=="si"?"true":"false"));
					break;
				case "Z":
					$usuario->setAttribute("nombre",$valor);
					break;
				case "AA":
					$usuario->setAttribute("apaterno",$valor);
					break;
				case "AB":
					$usuario->setAttribute("amaterno",$valor);
					break;
				case "AC":
					$usuario->setAttribute("usuario",$valor);
					break;
				case "AD":
					$usuario->setAttribute("email",$valor);
					break;
				case "AE":
					$usuario->setAttribute("idwinapp",$valor);
					break;
				case "AF":
					$usuario->setAttribute("activo",(strtolower(trim($valor))=="si"?"true":"false"));
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