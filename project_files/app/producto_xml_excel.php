<?php
include("phpExcel/PHPExcel.php");

$dir_in         = "../tmp/downloads/";
$dir_out        = "../tmp/downloads/";
$dir_template   = "../templates/";
$archivo        = (isset($_GET["arch"]) && $_GET["arch"]!="" && file_exists($dir_in.$_GET["arch"])?$_GET["arch"]:"");
$path        	= (isset($_GET["path"]) && $_GET["path"]!=""?$_GET["path"]:"");
$template       = "plantilla_producto.xlsx";

if($archivo!="")
{
    $libro  = PHPExcel_IOFactory::load($dir_template.$template);
    $hoja   = $libro->getSheet();
    $xml    = new DOMDocument();
    $xml->load($dir_in.$_GET["arch"]);
    foreach($xml->getElementsByTagName("producto") as $k=>$prod)
    {
        $hoja->setCellValue("A".($k+2),$prod->getAttribute('producto'));
        $hoja->setCellValue("D".($k+2),$prod->getAttribute('precio'));
        $hoja->setCellValue("E".($k+2),$prod->getAttribute('idwinapp'));
        if(strtolower($prod->getAttribute('activo'))=="true")
            $hoja->setCellValue("F".($k+2),"SI");
        else
            $hoja->setCellValue("F".($k+2),"NO");
        $desc=$prod->getElementsByTagName("descripcion");
        $obs=$prod->getElementsByTagName("observaciones");
        if($desc->length>0 && trim($desc->item(0)->nodeValue)!="")
        {
            $hoja->setCellValue("B".($k+2),trim($desc->item(0)->nodeValue));
            $hoja->getStyle("B".($k+2))->getAlignment()->setWrapText(true);
        }
        if($obs->length>0 && trim($obs->item(0)->nodeValue)!="")
        {
            $hoja->setCellValue("C".($k+2),trim($obs->item(0)->nodeValue));
            $hoja->getStyle("C".($k+2))->getAlignment()->setWrapText(true);
        }
        $hoja->getStyle("A".($k+2).":F".($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $hoja->getColumnDimension('A')->setAutoSize(true);
        $hoja->getColumnDimension('B')->setAutoSize(true);
        $hoja->getColumnDimension('C')->setAutoSize(true);
        $hoja->getColumnDimension('D')->setAutoSize(true);
        $hoja->getColumnDimension('E')->setAutoSize(true);
        $hoja->getColumnDimension('F')->setAutoSize(true);
        $hoja->getStyle("D".($k+2))->getNumberFormat()->setFormatCode('_-$* #,##0.00_-;-$* #,##0.00_-;_-$* "-"??_-;_-@_-');
        $hoja->getStyle("F".($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
    if(file_exists($dir_out.str_replace(".xml",".xlsx",$archivo)))
        unlink($dir_out.str_replace(".xml",".xlsx",$archivo));
    $objWriter = PHPExcel_IOFactory::createWriter($libro, 'Excel2007'); 
    $objWriter->save($dir_out.str_replace(".xml",".xlsx",$archivo));
    header("location: $path/".str_replace(".xml",".xlsx",$archivo));
}
?>