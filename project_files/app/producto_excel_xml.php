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
			switch($celda->getColumn())
			{
				case "A":
					$elemento->setAttribute("producto",$celda->getValue());
					break;
				case "B":
					$elemento->appendChild($doc->createElement("descripcion",$celda->getValue()));
					break;
				case "C":
					$elemento->appendChild($doc->createElement("observaciones",$celda->getValue()));
					break;
				case "D":
					$elemento->setAttribute("precio",$celda->getValue());
					break;
				case "E":
					$elemento->setAttribute("idwinapp",$celda->getValue());
					break;
				case "F":
					$elemento->setAttribute("activo",(strtolower(trim($celda->getValue()))=="si"?"true":"false"));
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