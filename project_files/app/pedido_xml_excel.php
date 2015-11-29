<?php
include("phpExcel/PHPExcel.php");

$dir_in         = "../tmp/downloads/";
$dir_out        = "../tmp/downloads/";
$dir_template   = "../templates/";
$archivo        = (isset($_GET["arch"]) && $_GET["arch"]!="" && file_exists($dir_in.$_GET["arch"])?$_GET["arch"]:"");
$path        	= (isset($_GET["path"]) && $_GET["path"]!=""?$_GET["path"]:"");
$template       = "plantilla_pedido.xlsx";

if($archivo!="")
{
	$libro      = PHPExcel_IOFactory::load($dir_template.$template);
    $hoja       = $libro->getSheet();
    $hojaPart	= $libro->getSHeet(1);
    $xml		= new DOMDocument();
    $xml->load($dir_in.$_GET["arch"]);
    $partidas=array();
    foreach($xml->getElementsByTagName("pedido") as $k=>$ped)
    {
		$hoja->setCellValue("A".($k+2),$ped->getAttribute("idpedido"));
		$hoja->setCellValue("B".($k+2),$ped->getAttribute("idwinapp"));
		$hoja->setCellValue("C".($k+2),$ped->getAttribute("cteidwinapp"));
		$hoja->setCellValue("D".($k+2),$ped->getAttribute("cliente"));
		$hoja->setCellValue("E".($k+2),$ped->getAttribute("sucursalentrega"));
		$hoja->setCellValue("F".($k+2),$ped->getAttribute("sucursalcobro"));
		$hoja->setCellValue("G".($k+2),$ped->getAttribute("sucursalfacturacion"));
		$hoja->setCellValue("H".($k+2),$ped->getAttribute("fechapedido"));
		$hoja->setCellValue("I".($k+2),$ped->getAttribute("horapedido"));
		$hoja->setCellValue("J".($k+2),$ped->getAttribute("fechaentrega"));
		$hoja->setCellValue("K".($k+2),$ped->getAttribute("horaentrega"));
		$hoja->setCellValue("L".($k+2),$ped->getAttribute("estado"));
		foreach($ped->getElementsByTagName("partida") as $p)
		{
			array_push($partidas,array(
				$ped->getAttribute("idpedido"),
				$ped->getAttribute("idwinapp"),
				$p->getAttribute("idproducto"),
				$p->getAttribute("idwinappprod"),
				$p->getAttribute("producto"),
				$p->getAttribute("cantidad"),
				$p->getAttribute("precio"),
				$p->getAttribute("importe"),
				$p->getAttribute("estado")
			));
		}
    }
    foreach($partidas as $k=>$p)
    {
		$hojaPart->setCellValue("A".($k+2),$p[0]);
		$hojaPart->setCellValue("B".($k+2),$p[1]);
		$hojaPart->setCellValue("C".($k+2),$p[2]);
		$hojaPart->setCellValue("D".($k+2),$p[3]);
		$hojaPart->setCellValue("E".($k+2),$p[4]);
		$hojaPart->setCellValue("F".($k+2),$p[5]);
		$hojaPart->setCellValue("G".($k+2),$p[6]);
		$hojaPart->setCellValue("H".($k+2),$p[7]);
		$hojaPart->setCellValue("I".($k+2),$p[8]);
		$hojaPart->getStyle("G".($k+2))->getNumberFormat()->setFormatCode('_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-');
		$hojaPart->getStyle("H".($k+2))->getNumberFormat()->setFormatCode('_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-');
    }
    $hoja->getColumnDimension('A')->setAutoSize(true);
    $hoja->getColumnDimension('B')->setAutoSize(true);
    $hoja->getColumnDimension('C')->setAutoSize(true);
    $hoja->getColumnDimension('D')->setAutoSize(true);
    $hoja->getColumnDimension('E')->setAutoSize(true);
    $hoja->getColumnDimension('F')->setAutoSize(true);
    $hoja->getColumnDimension('G')->setAutoSize(true);
    $hoja->getColumnDimension('H')->setAutoSize(true);
    $hoja->getColumnDimension('I')->setAutoSize(true);
    $hoja->getColumnDimension('J')->setAutoSize(true);
    $hoja->getColumnDimension('K')->setAutoSize(true);
    $hoja->getColumnDimension('L')->setAutoSize(true);
    $hojaPart->getColumnDimension('A')->setAutoSize(true);
    $hojaPart->getColumnDimension('B')->setAutoSize(true);
    $hojaPart->getColumnDimension('C')->setAutoSize(true);
    $hojaPart->getColumnDimension('D')->setAutoSize(true);
    $hojaPart->getColumnDimension('E')->setAutoSize(true);
    $hojaPart->getColumnDimension('F')->setAutoSize(true);
    $hojaPart->getColumnDimension('G')->setAutoSize(true);
    $hojaPart->getColumnDimension('H')->setAutoSize(true);
    $hojaPart->getColumnDimension('I')->setAutoSize(true);
    if(file_exists($dir_out.str_replace(".xml",".xlsx",$archivo)))
        unlink($dir_out.str_replace(".xml",".xlsx",$archivo));
    $objWriter = PHPExcel_IOFactory::createWriter($libro, 'Excel2007'); 
    $objWriter->save($dir_out.str_replace(".xml",".xlsx",$archivo));
    header("location: $path/".str_replace(".xml",".xlsx",$archivo));
}
else
{
	?>
	<script type="text/javascript">
		alert("No hay pedidos para exportar.");
		window.close();
	</script>
	<?php
}
?>