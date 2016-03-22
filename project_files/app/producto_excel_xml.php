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
	$raiz	= $doc->createElement("productos");
    foreach($hoja->getRowIterator() as $fila)
    {
    	if($fila->getRowIndex()==1)
			continue;
		$cellIterator=$fila->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false);
		$elemento=$doc->createElement("producto");
		foreach($cellIterator as $celda)
		{
			$valor=$celda->getValue();
			$valor=str_replace("&","&amp;",$valor);
			switch($celda->getColumn())
			{
				case "A":
					$elemento->setAttribute("producto",$valor);
					break;
				case "B":
					$elemento->appendChild($doc->createElement("descripcion",$valor));
					break;
				case "C":
					$elemento->appendChild($doc->createElement("observaciones",$valor));
					break;
				case "D":
					$elemento->setAttribute("precio",$valor);
					break;
				case "E":
					$elemento->setAttribute("idwinapp",$valor);
					break;
				case "F":
					$elemento->setAttribute("activo",(strtolower(trim($valor))=="si"?"true":"false"));
					break;
				case "G":
					$elemento->setAttribute("impuesto",$valor);
					break;
				case "H":
					$elemento->setAttribute("marca",$valor);
					break;
				case "I":
					$elemento->setAttribute("categoria",$valor);
					break;
			}
		}
		$raiz->appendChild($elemento);
    }
    $doc->appendChild($raiz);
    $doc->formatOutput=true;
    $doc->save($dir_out.str_replace(".","_",$archivo).".xml");
	header("location: $path/".str_replace(".","_",$archivo).".xml");
}
?>