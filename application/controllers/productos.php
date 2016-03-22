<?php
class Productos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modproducto');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('productos/index',array(
			"menumain"=>$menumain,
			"productos"=>$this->modproducto->getAll()
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function nuevo()
	{
		$this->load->model('modproducto');
		$this->load->model('modcatalogo');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('productos/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modproducto,
			"categoria"=>$this->modcatalogo->getCatalogo(2),
			"marca"=>$this->modcatalogo->getCatalogo(3)
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function cargaimagen()
	{
		$config["upload_path"]=$this->config->item("ruta_uploads");
		$config["allowed_types"]="gif|jpg|png";
		$config["max_size"]="0";
		$config["max_height"]="0";
		$config["max_width"]="0";
		$this->load->library("upload",$config);
		if($this->upload->do_upload("imagen"))
		{
			$archivo=$this->upload->data()["file_name"];
			$partes=explode(".",$archivo);
			$copia=time().".".$partes[count($partes)-1];
			copy($this->config->item("ruta_uploads").$archivo,"./project_files/img/productos/".$copia);
			unlink($this->config->item("ruta_uploads").$archivo);
			echo $copia;
		}
	}
	public function add()
	{
		$this->load->model('modproducto');
		$this->modproducto->getFromInput();
		$this->modproducto->setFechacarga(Today());
		$this->modproducto->setHoracarga(Hora());
		$this->modproducto->setFechaactualizacion(Today());
		$this->modproducto->setHoraactualizacion(Hora());
		$this->modproducto->addToDatabase();
		echo $this->modproducto->getIdproducto();
		$this->modsesion->addLog(
			'agregar',
			$this->modproducto->getIdproducto(),
			$this->modproducto->getNombre(),
			"producto",
			""
		);
	}
	public function update()
	{
		$this->load->model('modproducto');
		$this->modproducto->getFromInput();		
		$this->modproducto->setFechaactualizacion(Today());
		$this->modproducto->setHoraactualizacion(Hora());
		$this->modproducto->updateToDatabase();
		echo $this->modproducto->getIdproducto();
		$this->modsesion->addLog(
			'actualizar',
			$this->modproducto->getIdproducto(),
			$this->modproducto->getNombre(),
			"producto",
			""
		);
	}
	public function ver($id)
	{
		$this->load->model('modproducto');
		$this->load->model('modcatalogo');
		$this->modproducto->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('productos/vista',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modproducto,
			"categoria"=>$this->modcatalogo->getCatalogo(2),
			"marca"=>$this->modcatalogo->getCatalogo(3)
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
		$this->modsesion->addLog(
			'verdetalle',
			$this->modproducto->getIdproducto(),
			$this->modproducto->getNombre(),
			"",
			""
		);
	}
	public function actualizar($id)
	{
		$this->load->model('modproducto');
		$this->load->model('modcatalogo');
		$this->modproducto->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('productos/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modproducto,
			"categoria"=>$this->modcatalogo->getCatalogo(2),
			"marca"=>$this->modcatalogo->getCatalogo(3)
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function eliminar($id)
	{
		$this->load->model('modproducto');
		$this->modproducto->delete($id);
		$this->modsesion->addLog(
			'eliminar',
			$this->modproducto->getIdproducto(),
			$this->modproducto->getNombre(),
			"producto",
			"relpropar"
		);
	}
	public function exportarXML()
	{
		$this->load->library('zip');
		$archivo=$this->crearXML();
		if($archivo!="")
		{
			$this->zip->read_file($this->config->item("ruta_downloads").$archivo);
			$this->modsesion->addLog(
				'DescargaXML',
				0,
				"PRODUCTOS",
				"",
				""
			);
			$this->zip->download(str_replace(".xml",".zip",$archivo));
		}
	}
	public function crearXML()
	{
		$this->load->model('modproducto');
		$productos=$this->modproducto->getAll();
		if($productos!==false)
		{
			$doc=new DOMDocument("1.0","utf-8");
			$raiz=$doc->createElement("productos");
			foreach($productos as $producto)
			{
				$elemento=$doc->createElement("producto");
				$elemento->setAttribute('producto',$producto["nombre"]);
				$elemento->setAttribute('precio',$producto["precio"]);
				if($producto["idwinapp"]!="")
					$elemento->setAttribute('idwinapp',$producto["idwinapp"]);
				if($producto["activo"]!="")
					$elemento->setAttribute('activo',$producto["activo"]==1?"true":"false");
				if($producto["descripcion"]!="")
				{
					$elem=$doc->createElement("descripcion",$producto["descripcion"]);
					$elemento->appendChild($elem);
				}
				if($producto["observaciones"]!="")
				{
					$elem=$doc->createElement("observaciones",$producto["observaciones"]);
					$elemento->appendChild($elem);
				}
				$raiz->appendChild($elemento);
			}
			$doc->appendChild($raiz);
			$doc->formatOutput=true;
			$archivo="productos_".time().".xml";
			$doc->save($this->config->item("ruta_downloads").$archivo);
			return $archivo;
		}
		return "";
	}
	public function exportarExcel()
	{
		$archivo=$this->crearXML();
		$this->modsesion->addLog(
			'DescargaExcel',
			0,
			"PRODUCTOS",
			"",
			""
		);
		header("location: ".base_url("project_files/app/producto_xml_excel.php?arch=$archivo&path=".base_url("productos/descargarExcel")));
	}
	public function descargarExcel($archivo)
	{
		if($archivo!="")
		{
			$this->load->library('zip');
			$this->zip->read_file($this->config->item("ruta_downloads").$archivo);
			$this->zip->download(str_replace(".xlsx",".zip",$archivo));
		}
	}
	public function cargaXML()
	{
		$config["upload_path"]=$this->config->item("ruta_uploads");
		$config["allowed_types"]="xml";
		$config["max_size"]="0";
		$config["max_height"]="0";
		$config["max_width"]="0";
		$this->load->library("upload",$config);
		if($this->upload->do_upload("archivo"))
		{
			$this->modsesion->addLog(
				'CargaXML',
				0,
				"PRODUCTOS",
				"",
				""
			);
			$this->importaXML($this->upload->data()["file_name"]);
		}
	}
	public function cargaExcel()
	{
		$config["upload_path"]=$this->config->item("ruta_uploads");
		$config["allowed_types"]="xls|xlsx";
		$config["max_size"]="0";
		$config["max_height"]="0";
		$config["max_width"]="0";
		$this->load->library("upload",$config);
		if($this->upload->do_upload("archivo"))
		{
			$archivo=$this->upload->data()["file_name"];
			$this->modsesion->addLog(
				'CargaExcel',
				0,
				"PRODUCTOS",
				"",
				""
			);
			header("location: ".base_url("project_files/app/producto_excel_xml.php?arch=$archivo&path=".base_url("productos/importaXML")));
		}
	}
	public function importaXML($archivo)
	{
		$this->load->model('modproducto');
		$this->load->model("modcatalogo");
		$doc=new DOMDocument();
		$doc->load($this->config->item("ruta_uploads").$archivo);
		foreach($doc->getElementsByTagName("producto") as $prod)
		{
			$id=0;
			$desc="";
			$obs="";
			$this->modproducto->Inicializar();
			if($prod->getAttribute("idwinapp")!="")
			{
				$id=$this->modproducto->getIdFromIdWinApp($prod->getAttribute("idwinapp"));
				if($id>0)
					$this->modproducto->getFromDatabase($id);
			}
			$naux=$prod->getElementsByTagName("descripcion");
			if($naux->length>0 && trim($naux->item(0)->nodeValue)!="")
				$desc=trim($naux->item(0)->nodeValue);
			$naux=$prod->getElementsByTagName("observaciones");
			if($naux->length>0 && trim($naux->item(0)->nodeValue)!="")
				$obs=trim($naux->item(0)->nodeValue);
			$this->modproducto->setNombre($prod->getAttribute("producto"));
			$this->modproducto->setDescripcion($desc);
			$this->modproducto->setObservaciones($obs);
			$this->modproducto->setPrecio($prod->getAttribute("precio"));
			$this->modproducto->setIdwinapp($prod->getAttribute("idwinapp"));
			$this->modproducto->setActivo($prod->getAttribute("activo")=="true"?1:0);
			$this->modproducto->setFechaactualizacion(Today());
			$this->modproducto->setHoraactualizacion(Hora());
			$this->modproducto->setImpuesto($prod->getAttribute("impuesto"));
			$this->modproducto->setCategoria($this->modcatalogo->getIdOption(2,$prod->getAttribute("categoria")));
			$this->modproducto->setMarca($this->modcatalogo->getIdOption(3,$prod->getAttribute("marca")));
			if($id>0)
			{
				$this->modproducto->updateToDatabase();
				$this->modsesion->addLog(
					'actualizar',
					$this->modproducto->getIdproducto(),
					$this->modproducto->getNombre(),
					"producto",
					""
				);
			}
			else
			{
				$this->modproducto->setFechacarga(Today());
				$this->modproducto->setHoracarga(Hora());
				$this->modproducto->addToDatabase();
				$this->modsesion->addLog(
					'agregar',
					$this->modproducto->getIdproducto(),
					$this->modproducto->getNombre(),
					"producto",
					""
				);
			}
		}
	}
}
?>