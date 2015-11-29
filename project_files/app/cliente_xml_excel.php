<?php
include("phpExcel/PHPExcel.php");

$dir_in         = "../tmp/downloads/";
$dir_out        = "../tmp/downloads/";
$dir_template   = "../templates/";
$archivo        = (isset($_GET["arch"]) && $_GET["arch"]!="" && file_exists($dir_in.$_GET["arch"])?$_GET["arch"]:"");
$path        	= (isset($_GET["path"]) && $_GET["path"]!=""?$_GET["path"]:"");
$template       = "plantilla_cliente_out.xlsx";

if($archivo!="")
{
    $libro      = PHPExcel_IOFactory::load($dir_template.$template);
    $hoja       = $libro->getSheet();
    $hojaSuc    = $libro->getSheet(1);
    $hojaUsrs   = $libro->getSheet(2);
    $xml        = new DOMDocument();
    $xml->load($dir_in.$_GET["arch"]);
    $sucursales=array();
    $usuarios=array();
    foreach($xml->getElementsByTagName("cliente") as $k=>$cte)
    {
        $hoja->setCellValue("A".($k+2),$cte->getAttribute("cliente"));
        $hoja->setCellValue("B".($k+2),$cte->getAttribute("razonsocial"));
        $hoja->setCellValue("C".($k+2),$cte->getAttribute("rfc"));
        $hoja->setCellValue("D".($k+2),$cte->getAttribute("curp"));
        $hoja->setCellValue("F".($k+2),$cte->getAttribute("idwinapp"));
        if(strtolower($cte->getAttribute("activo"))=="true")
            $hoja->setCellValue("G".($k+2),"SI");
        else
            $hoja->setCellValue("G".($k+2),"NO");
        $obs=$cte->getElementsByTagName("observaciones");
        if($obs->length>0 && trim($obs->item(0)->nodeValue)!="")
        {
            $hoja->setCellValue("E".($k+2),trim($obs->item(0)->nodeValue));
            $hoja->getStyle("E".($k+2))->getAlignment()->setWrapText(true);
        }
        $hoja->getStyle("A".($k+2).":G".($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $hoja->getColumnDimension('A')->setAutoSize(true);
        $hoja->getColumnDimension('B')->setAutoSize(true);
        $hoja->getColumnDimension('C')->setAutoSize(true);
        $hoja->getColumnDimension('D')->setAutoSize(true);
        $hoja->getColumnDimension('E')->setAutoSize(true);
        $hoja->getColumnDimension('F')->setAutoSize(true);
        $hoja->getColumnDimension('G')->setAutoSize(true);
        $hoja->getStyle("G".($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sucs=$cte->getElementsByTagName("sucursal");
        if($sucs->length>0) foreach($sucs as $suc)
        {
            $elem=array();
            $elem["cliente"]=$cte->getAttribute("cliente");
            $elem["idwinapp"]=$cte->getAttribute("idwinapp");
            $elem["sucursal"]=$suc->getAttribute("sucursal");
            $elem["activo"]=(strtolower($suc->getAttribute("activo")=="true")?"SI":"NO");
            $contacto=$suc->getElementsByTagName("contacto");
            if($contacto->length>0)
            {
                foreach($contacto as $cont)
                {
                    $elem["contacto"]=$cont->getAttribute("nombre");
                    $elem["telefono1"]=$cont->getAttribute("telefono1");
                    $elem["extension1"]=$cont->getAttribute("extension1");
                    $elem["telefono2"]=$cont->getAttribute("telefono2");
                    $elem["extension2"]=$cont->getAttribute("extension2");
                    $elem["fax"]=$cont->getAttribute("fax");
                    $elem["email"]=$cont->getAttribute("email");
                }
            }
            else
            {
                $elem["contacto"]="";
                $elem["telefono1"]="";
                $elem["extension1"]="";
                $elem["telefono2"]="";
                $elem["extension2"]="";
                $elem["fax"]="";
                $elem["email"]="";
            }
            $direccion=$suc->getElementsByTagName("direccion");
            if($direccion->length>0)
            {
                foreach($direccion as $dir)
                {
                    $elem["calle"]=$dir->getAttribute("calle");
                    $elem["numexterior"]=$dir->getAttribute("noexterior");
                    $elem["numinterior"]=$dir->getAttribute("nointerior");
                    $elem["cp"]=$dir->getAttribute("cp");
                    $elem["colonia"]=$dir->getAttribute("colonia");
                    $elem["municipio"]=$dir->getAttribute("municipio");
                    $elem["estado"]=$dir->getAttribute("estado");
                    $elem["pais"]=$dir->getAttribute("pais");
                    $refs=$dir->getElementsByTagName("referencias");
                    if($refs->length>0 && trim($refs->item(0)->nodeValue)!="")
                    {
						$elem["referencias"]=trim($refs->item(0)->nodeValue);
                    }
                    else
                    {
						$elem["referencias"]="";
                    }
                }
            }
            else
            {
                $elem["calle"]="";
                $elem["numexterior"]="";
                $elem["numinterior"]="";
                $elem["cp"]="";
                $elem["colonia"]="";
                $elem["municipio"]="";
                $elem["estado"]="";
                $elem["pais"]="";
                $elem["referencias"]="";
            }
            $obs=$suc->getElementsByTagName("observaciones");
            if($obs->length>0 && trim($obs->item(0)->nodeValue)!="")
            {
				$elem["observaciones"]=trim($obs->item(0)->nodeValue);
            }
            else
            {
				$elem["observaciones"]="";
            }
            array_push($sucursales,$elem);
        }
        $usrs=$cte->getElementsByTagName("usuario");
        if($usrs->length>0) foreach($usrs as $usr)
        {
			$elem=array();
			$elem["cliente"]=$cte->getAttribute("cliente");
            $elem["idwinapp"]=$cte->getAttribute("idwinapp");
			$elem["nombre"]=$usr->getAttribute("nombre");
			$elem["apaterno"]=$usr->getAttribute("apaterno");
			$elem["amaterno"]=$usr->getAttribute("amaterno");
			$elem["usuario"]=$usr->getAttribute("usuario");
			$elem["email"]=$usr->getAttribute("email");
			$elem["idwinapp2"]=$usr->getAttribute("idwinapp");
			$elem["activo"]=(strtolower($usr->getAttribute("activo"))=="true"?"SI":"NO");
			array_push($usuarios,$elem);
        }
        foreach($sucursales as $k=>$suc)
        {
			$hojaSuc->setCellValue("A".($k+2),$suc["cliente"]);
			$hojaSuc->setCellValue("B".($k+2),$suc["idwinapp"]);
			$hojaSuc->setCellValue("C".($k+2),$suc["sucursal"]);
			$hojaSuc->setCellValue("D".($k+2),$suc["contacto"]);
			$hojaSuc->getCell("E".($k+2))->setValueExplicit($suc["telefono1"],PHPExcel_Cell_Datatype::TYPE_STRING);
			$hojaSuc->getCell("F".($k+2))->setValueExplicit($suc["extension1"],PHPExcel_Cell_Datatype::TYPE_STRING);
			$hojaSuc->getCell("G".($k+2))->setValueExplicit($suc["telefono2"],PHPExcel_Cell_Datatype::TYPE_STRING);
			$hojaSuc->getCell("H".($k+2))->setValueExplicit($suc["extension2"],PHPExcel_Cell_Datatype::TYPE_STRING);
			$hojaSuc->setCellValue("I".($k+2),$suc["email"]);
			$hojaSuc->setCellValue("J".($k+2),$suc["fax"]);
			$hojaSuc->setCellValue("K".($k+2),$suc["calle"]);
			$hojaSuc->setCellValue("L".($k+2),$suc["numexterior"]);
			$hojaSuc->setCellValue("M".($k+2),$suc["numinterior"]);
			$hojaSuc->setCellValue("N".($k+2),$suc["cp"]);
			$hojaSuc->setCellValue("O".($k+2),$suc["colonia"]);
			$hojaSuc->setCellValue("P".($k+2),$suc["municipio"]);
			$hojaSuc->setCellValue("Q".($k+2),$suc["estado"]);
			$hojaSuc->setCellValue("R".($k+2),$suc["referencias"]);
			$hojaSuc->setCellValue("S".($k+2),$suc["observaciones"]);
			$hojaSuc->setCellValue("T".($k+2),$suc["activo"]);
			$hojaSuc->getStyle("A".($k+2).":T".($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$hojaSuc->getColumnDimension('A')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('B')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('C')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('D')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('E')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('F')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('G')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('H')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('I')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('J')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('K')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('L')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('M')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('N')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('O')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('P')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('Q')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('R')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('S')->setAutoSize(true);
	        $hojaSuc->getColumnDimension('T')->setAutoSize(true);
	        $hojaSuc->getStyle("R".($k+2))->getAlignment()->setWrapText(true);
	        $hojaSuc->getStyle("S".($k+2))->getAlignment()->setWrapText(true);
			$hojaSuc->getStyle("T".($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
        foreach($usuarios as $k=>$usr)
        {
			$hojaUsrs->setCellValue("A".($k+2),$usr["cliente"]);
			$hojaUsrs->setCellValue("B".($k+2),$usr["idwinapp"]);
			$hojaUsrs->setCellValue("C".($k+2),$usr["nombre"]);
			$hojaUsrs->setCellValue("D".($k+2),$usr["apaterno"]);
			$hojaUsrs->setCellValue("E".($k+2),$usr["amaterno"]);
			$hojaUsrs->setCellValue("F".($k+2),$usr["usuario"]);
			$hojaUsrs->setCellValue("G".($k+2),$usr["email"]);
			$hojaUsrs->setCellValue("H".($k+2),$usr["idwinapp2"]);
			$hojaUsrs->setCellValue("I".($k+2),$usr["activo"]);
			$hojaUsrs->getColumnDimension('A')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('B')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('C')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('D')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('E')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('F')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('G')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('H')->setAutoSize(true);
	        $hojaUsrs->getColumnDimension('I')->setAutoSize(true);
			$hojaUsrs->getStyle("A".($k+2).":I".($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$hojaUsrs->getStyle("I".($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
    }
    if(file_exists($dir_out.str_replace(".xml",".xlsx",$archivo)))
        unlink($dir_out.str_replace(".xml",".xlsx",$archivo));
    $objWriter = PHPExcel_IOFactory::createWriter($libro, 'Excel2007'); 
    $objWriter->save($dir_out.str_replace(".xml",".xlsx",$archivo));
    header("location: $path/".str_replace(".xml",".xlsx",$archivo));
}
?>