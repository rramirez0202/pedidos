<?php
class Clientes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modcliente');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$idusr=0;
		foreach($this->config->item('idperfilvistaxclientesasignados') as $perf)
		{
			if($this->modsesion->getPerfil($perf)!==false)
			{
				$idusr=$this->session->userdata('idusuario');
				break;
			}
		}
		if($idusr==0 && $this->modsesion->getPerfil($this->config->item('idperfilcliente'))!==false)
			$idusr=$this->session->userdata('idusuario');
		$body=$this->load->view('clientes/index',array(
			"menumain"=>$menumain,
			"clientes"=>$this->modcliente->getAll($idusr)
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function nuevo()
	{
		$this->load->model('modcliente');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('clientes/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modcliente
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function add()
	{
		$this->load->model('modcliente');
		$this->load->model('modusuario');
		$this->modcliente->getFromInput();
		$this->modcliente->addToDatabase();
		$this->modusuario->agregarCliente($this->session->userdata('idusuario'),$this->modcliente->getIdcliente());
		echo $this->modcliente->getIdcliente();
		$this->modsesion->addLog(
			'agregar',
			$this->modcliente->getIdcliente(),
			$this->modcliente->getNombre(),
			"cliente",
			""
		);
	}
	public function update()
	{
		$this->load->model('modcliente');
		$this->modcliente->getFromInput();
		$this->modcliente->updateToDatabase();
		echo $this->modcliente->getIdcliente();
		$this->modsesion->addLog(
			'actualizar',
			$this->modcliente->getIdcliente(),
			$this->modcliente->getNombre(),
			"cliente",
			""
		);
	}
	public function ver($id)
	{
		$this->load->model('modcliente');
		$this->load->model('modsucursal');
		$this->load->model('modusuario');
		$this->modcliente->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('clientes/vista',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modcliente,
			"sucursales"=>$this->modsucursal->getAll($id),
			"usuarios"=>$this->modusuario->getAll($id)
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
		$this->modsesion->addLog(
			'verdetalle',
			$this->modsucursal->getIdcliente(),
			$this->modsucursal->getNombre(),
			"",
			""
		);
	}
	public function ver2($id)
	{
		$this->load->model('modcliente');
		$this->load->model('modsucursal');
		$this->load->model('modusuario');
		$this->modcliente->getFromDatabase($id);
		$this->load->view('clientes/vista2',array(
			"objeto"=>$this->modcliente,
			"sucursales"=>$this->modsucursal->getAll($id),
			"usuarios"=>$this->modusuario->getAll($id)
			));
	}
	public function actualizar($id)
	{
		$this->load->model('modcliente');
		$this->modcliente->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('clientes/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modcliente
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function eliminar($id)
	{
		$this->load->model('modcliente');
		$this->modcliente->delete($id);
		$this->modsesion->addLog(
			'eliminar',
			$this->modcliente->getIdcliente(),
			$this->modcliente->getNombre(),
			"cliente",
			"relcliusu,relclisuc,relcliped"
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
				"CLIENTES",
				"",
				""
			);
			$this->zip->download(str_replace(".xml",".zip",$archivo));
		}
	}
	public function crearXML()
	{
		$this->load->model("modcliente");
		$this->load->model("modsucursal");
		$this->load->model("modusuario");
		$clientes=$this->modcliente->getAll();
		if($clientes!==false)
		{
			$doc=new DOMDocument("1.0","utf-8");
			$raiz=$doc->createElement("clientes");
			foreach($clientes as $cliente)
			{
				$this->modcliente->setIdcliente($cliente["idcliente"]);
				$this->modcliente->getFromDatabase();
				$elemento=$doc->createElement("cliente");
				$elemento->setAttribute("cliente",$cliente["nombre"]);
				$elemento->setAttribute("razonsocial",$cliente["razonsocial"]);
				$elemento->setAttribute("rfc",$cliente["rfc"]);
				if($cliente["curp"]!="")
					$elemento->setAttribute("curp",$cliente["curp"]);
				if($cliente["idwinapp"]!="")
					$elemento->setAttribute("idwinapp",$cliente["idwinapp"]);
				if($cliente["activo"]!="")
					$elemento->setAttribute("activo",$cliente["activo"]=="1"?"true":"false");
				if($cliente["observaciones"]!="")
				{
					$elem=$doc->createElement("observaciones",$cliente["observaciones"]);
					$elemento->appendChild($elem);
				}
				if($this->modcliente->getSucursales()!==false && is_array($this->modcliente->getSucursales()) && count($this->modcliente->getSucursales())>0)
				{
					$sucursales=$doc->createElement("sucursales");
					foreach($this->modcliente->getSucursales() as $suc)
					{
						$sucursal=$doc->createElement("sucursal");
						$this->modsucursal->setidsucursal($suc);
						$this->modsucursal->getFromDatabase($suc);
						$sucursal->setAttribute("sucursal",$this->modsucursal->getNombre());
						if($this->modsucursal->getActivo()!="")
							$sucursal->setAttribute("activo",($this->modsucursal->getActivo()=="1"?"true":"false"));
						if($this->modsucursal->getObservaciones()!="")
							$sucursal->appendChild($doc->createElement("observaciones",$this->modsucursal->getObservaciones()));
						if($this->modsucursal->getContactonombre()!="" || $this->modsucursal->getContactotelefono1()!="" || $this->modsucursal->getContactoextension1()!="" || $this->modsucursal->getContactotelefono2()!="" || $this->modsucursal->getContactoextension2()!="" || $this->modsucursal->getContactofax()!="" || $this->modsucursal->getContactoemail()!="")
						{
							$elem=$doc->createElement("contacto");
							if($this->modsucursal->getContactonombre()!="")
								$elem->setAttribute("nombre",$this->modsucursal->getContactonombre());
							if($this->modsucursal->getContactotelefono1()!="")
								$elem->setAttribute("telefono1",$this->modsucursal->getContactotelefono1());
							if($this->modsucursal->getContactoextension1()!="")
								$elem->setAttribute("extension1",$this->modsucursal->getContactoextension1());
							if($this->modsucursal->getContactotelefono2()!="")
								$elem->setAttribute("telefono2",$this->modsucursal->getContactotelefono2());
							if($this->modsucursal->getContactoextension2()!="")
								$elem->setAttribute("extension2",$this->modsucursal->getContactoextension2());
							if($this->modsucursal->getContactofax()!="")
								$elem->setAttribute("fax",$this->modsucursal->getContactofax());
							if($this->modsucursal->getContactoemail()!="")
								$elem->setAttribute("email",$this->modsucursal->getContactoemail());
							$sucursal->appendChild($elem);
						}
						if($this->modsucursal->getCalle()!="" || $this->modsucursal->getNoexterior()!="" || $this->modsucursal->getNointerior()!="" || $this->modsucursal->getColonia()!="" || $this->modsucursal->getMunicipio()!="" || $this->modsucursal->getEstado()!="" || $this->modsucursal->getCp()!="")
						{
							$elem=$doc->createElement("direccion");
							if($this->modsucursal->getCalle()!="")
								$elem->setAttribute("calle",$this->modsucursal->getCalle());
							if($this->modsucursal->getNoexterior()!="")
								$elem->setAttribute("noexterior",$this->modsucursal->getNoexterior());
							if($this->modsucursal->getNointerior()!="")
								$elem->setAttribute("nointerior",$this->modsucursal->getNointerior());
							if($this->modsucursal->getColonia()!="")
								$elem->setAttribute("colonia",$this->modsucursal->getColonia());
							if($this->modsucursal->getMunicipio()!="")
								$elem->setAttribute("municipio",$this->modsucursal->getMunicipio());
							if($this->modsucursal->getEstado()!="")
								$elem->setAttribute("estado",$this->modsucursal->getEstado());
							if($this->modsucursal->getPais()!="")
								$elem->setAttribute("pais",$this->modsucursal->getPais());
							if($this->modsucursal->getCp()!="")
								$elem->setAttribute("cp",$this->modsucursal->getCp());
							if($this->modsucursal->getReferencias()!="")
								$elem->appendChild($doc->createElement("referencias",$this->modsucursal->getReferencias()));
							$sucursal->appendChild($elem);
						}
						$sucursales->appendChild($sucursal);
					}
					$elemento->appendChild($sucursales);
				}
				if($this->modcliente->getUsuarios()!==false && is_array($this->modcliente->getUsuarios()) && count($this->modcliente->getUsuarios())>0)
				{
					$usuarios=$doc->createElement("usuarios");
					foreach($this->modcliente->getUsuarios() as $usr)
					{
						$usuario=$doc->createElement("usuario");
						$this->modusuario->setidusuario($usr);
						$this->modusuario->getFromDatabase();
						$usuario->setAttribute("nombre",$this->modusuario->getNombre());
						if($this->modusuario->getApaterno()!="")
							$usuario->setAttribute("apaterno",$this->modusuario->getApaterno());
						if($this->modusuario->getAmaterno()!="")
							$usuario->setAttribute("amaterno",$this->modusuario->getAmaterno());
						$usuario->setAttribute("usuario",$this->modusuario->getUsuario());
						$usuario->setAttribute("email",$this->modusuario->getEmail());
						if($this->modusuario->getActivo()!="")
							$usuario->setAttribute("activo",$this->modusuario->getActivo()=="1"?"true":"false");
						if($this->modusuario->getIdwinapp()!="")
							$usuario->setAttribute("idwinapp",$this->modusuario->getIdwinapp());						
						$usuarios->appendChild($usuario);
					}
					$elemento->appendChild($usuarios);
				}
				$raiz->appendChild($elemento);
			}
			$doc->appendChild($raiz);
			$doc->formatOutput=true;
			$archivo="clientes_".time().".xml";
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
			"CLIENTES",
			"",
			""
		);
		header("location: ".base_url("project_files/app/cliente_xml_excel.php?arch=$archivo&path=".base_url("clientes/descargarExcel")));
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
				"CLIENTES",
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
				"CLIENTES",
				"",
				""
			);
			header("location: ".base_url("project_files/app/cliente_excel_xml.php?arch=$archivo&path=".base_url("clientes/importaXML")));
		}
	}
	public function importaXML($archivo)
	{
		$this->load->model("modcliente");
		$this->load->model("modsucursal");
		$this->load->model("modusuario");
		$doc=new DOMDocument();
		$doc->load($this->config->item("ruta_uploads").$archivo);
		foreach($doc->getElementsByTagName("cliente") as $cte)
		{
			$obs="";
			$naux=$cte->getElementsByTagName("observaciones");
			if($naux->length>0 && trim($naux->item(0)->nodeValue)!="")
				$obs=trim($naux->item(0)->nodeValue);
			$this->modcliente->Inicializar();
			$this->modcliente->setNombre($cte->getAttribute("cliente"));
			$this->modcliente->setRazonsocial($cte->getAttribute("razonsocial"));
			$this->modcliente->setRfc($cte->getAttribute("rfc"));
			$this->modcliente->setCurp($cte->getAttribute("curp"));
			$this->modcliente->setObservaciones($obs);
			$this->modcliente->setActivo($cte->getAttribute("activo")=="true"?1:0);
			$this->modcliente->setIdwinapp($cte->getAttribute("idwinapp"));
			$this->modcliente->addToDatabase();
			$this->modsesion->addLog(
				'agregar',
				$this->modcliente->getIdcliente(),
				$this->modcliente->getNombre(),
				"cliente",
				""
			);
			foreach($cte->getElementsByTagName("sucursal") as $suc)
			{
				$contacto=array(
					"nombre"=>"",
					"telefono1"=>"",
					"extension1"=>"",
					"telefono2"=>"",
					"extension2"=>"",
					"fax"=>"",
					"email"=>""
				);
				$direccion=array(
					"calle"=>"",
					"noexterior"=>"",
					"nointerior"=>"",
					"colonia"=>"",
					"municipio"=>"",
					"estado"=>"",
					"pais"=>"",
					"cp"=>"",
					"referencias"=>""
				);
				$obs="";
				foreach($suc->getElementsByTagName("contacto") as $naux)
				{
					$contacto["nombre"]=$naux->getAttribute("nombre");
					$contacto["telefono1"]=$naux->getAttribute("telefono1");
					$contacto["extension1"]=$naux->getAttribute("extension1");
					$contacto["telefono2"]=$naux->getAttribute("telefono2");
					$contacto["extension2"]=$naux->getAttribute("extension2");
					$contacto["fax"]=$naux->getAttribute("fax");
					$contacto["email"]=$naux->getAttribute("email");
				}
				foreach($suc->getElementsByTagName("direccion") as $naux)
				{
					$direccion["calle"]=$naux->getAttribute("calle");
					$direccion["noexterior"]=$naux->getAttribute("noexterior");
					$direccion["nointerior"]=$naux->getAttribute("nointerior");
					$direccion["colonia"]=$naux->getAttribute("colonia");
					$direccion["municipio"]=$naux->getAttribute("municipio");
					$direccion["estado"]=$naux->getAttribute("estado");
					$direccion["pais"]=$naux->getAttribute("pais");
					$direccion["cp"]=$naux->getAttribute("cp");
					$naux2=$naux->getElementsByTagName("referencias");
					if($naux2->length>0 && trim($naux2->item(0)->nodeValue)!="")
						$direccion["referencias"]=trim($naux2->item(0)->nodeValue);
				}
				$naux=$suc->getElementsByTagName("observaciones");
				if($naux->length>0 && trim($naux->item(0)->nodeValue)!="")
					$obs=trim($naux->item(0)->nodeValue);
				$this->modsucursal->Inicializar();
				$this->modsucursal->setNombre($suc->getAttribute("sucursal"));
				$this->modsucursal->setContactonombre($contacto["nombre"]);
				$this->modsucursal->setContactotelefono1($contacto["telefono1"]);
				$this->modsucursal->setContactoextension1($contacto["extension1"]);
				$this->modsucursal->setContactotelefono1($contacto["telefono2"]);
				$this->modsucursal->setContactoextension1($contacto["extension2"]);
				$this->modsucursal->setContactofax($contacto["fax"]);
				$this->modsucursal->setContactoemail($contacto["email"]);
				$this->modsucursal->setCalle($direccion["calle"]);
				$this->modsucursal->setNoexterior($direccion["noexterior"]);
				$this->modsucursal->setNointerior($direccion["nointerior"]);
				$this->modsucursal->setColonia($direccion["colonia"]);
				$this->modsucursal->setMunicipio($direccion["municipio"]);
				$this->modsucursal->setEstado($direccion["estado"]);
				$this->modsucursal->setPais($direccion["pais"]);
				$this->modsucursal->setCp($direccion["cp"]);
				$this->modsucursal->setReferencias($direccion["referencias"]);
				$this->modsucursal->setActivo($suc->getAttribute("activo")=="true"?1:0);
				$this->modsucursal->setObservaciones($obs);
				$this->modsucursal->setIdcliente($this->modcliente->getIdcliente());
				$this->modsucursal->addToDatabase();
				$this->modsesion->addLog(
					'agregar',
					$this->modsucursal->getIdsucursal(),
					$this->modsucursal->getNombre(),
					"sucursal",
					"relclisuc"
				);
			}
			foreach($cte->getElementsByTagName("usuario") as $usr)
			{
				$this->modusuario->Inicializar();
				$this->modusuario->setNombre($usr->getAttribute("nombre"));
				$this->modusuario->setApaterno($usr->getAttribute("apaterno"));
				$this->modusuario->setAmaterno($usr->getAttribute("amaterno"));
				$this->modusuario->setUsuario($usr->getAttribute("usuario"));
				$this->modusuario->setPerfiles($this->config->item("idperfilcliente"));
				$this->modusuario->setEmail($usr->getAttribute("email"));
				$this->modusuario->setActivo($usr->getAttribute("activo")=="true"?1:0);
				$this->modusuario->setIdwinapp($usr->getAttribute("idwinapp"));
				$this->modusuario->addToDatabase();
				$this->modsesion->addLog(
					'agregar',
					$this->modusuario->getIdusuario(),
					$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
					"usuario",
					"relperusu,relcliusu"
				);
				$pwd=$this->modusuario->generaPassword();
				$this->modsesion->addLog(
					'reseteopassword',
					$this->modusuario->getIdusuario(),
					$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
					"usuario",
					""
				);
				$cuerpomail=$this->load->view('inicio/dataaccesmail',array(
					"usr"=>$this->modusuario->getUsuario(),
					"pwd"=>$pwd
					),true);
				try
				{
					$this->load->library('email');
					$this->email->from($this->config->item("noreplyemail"),$this->config->item("noreplyname"));
					$this->email->to($this->modusuario->getEmail());
					$this->email->message($cuerpomail);
					$this->email->subject('Alta en Sistema: Control de Pedidos');
					if($this->email->send())
						$this->modsesion->addLog(
							'enviomail',
							$this->modusuario->getIdusuario(),
							$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
							"usuario",
							""
						);
					else
						$this->modsesion->addLog(
							'errorenviomail',
							$this->modusuario->getIdusuario(),
							$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
							"",
							""
						);
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
				$this->modusuario->asociarACliente($this->modcliente->getIdcliente());
			}
		}
	}
}
?>