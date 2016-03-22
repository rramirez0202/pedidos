<?php
class Pedidos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modpedido');
		$this->load->model('modusuario');
		$this->load->model('modcliente');
		$this->load->model('modflujo');
		$pedidos=array();
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
		$pedidos=$this->modpedido->getAll($idusr);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('pedidos/index',array(
			"menumain"=>$menumain,
			"pedidos"=>$pedidos
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function nuevo()
	{
		$this->load->model('modpedido');
		$this->load->model('modcliente');
		$this->load->model('modsucursal');
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
		$clientes=$this->modcliente->getAll($idusr);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('pedidos/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modpedido,
			"clientes"=>$clientes,
			"cliente"=>$this->modcliente,
			"sucursal"=>$this->modsucursal
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function add()
	{
		$this->load->model('modpedido');
		$this->load->model('modflujo');
		$this->load->model('modcliente');
		$this->modpedido->getFromInput();
		$this->modcliente->getFromDatabase($this->modpedido->getIdcliente());
		$this->modpedido->setDescuentoporcentaje($this->modcliente->getDescuento());
		$this->modpedido->setDescuentomonto($this->modcliente->getDescuento()/100*$this->modpedido->getSubtotal());
		$this->modpedido->setTotal($this->modpedido->getSubtotal()-$this->modpedido->getDescuentomonto()+$this->modpedido->getIvamonto());
		$this->modpedido->setFechapedido(Today());
		$this->modpedido->setHorapedido(date('H:i:s'));
		$this->modpedido->setStatus($this->modflujo->getEstadoInicial($this->config->item('idflujopedido'))["idestado"]);
		$this->modpedido->setIdusuario($this->session->userdata('idusuario'));
		$this->modpedido->addToDatabase();
		echo $this->modpedido->getIdpedido();
		$this->modsesion->addLog(
			'agregar',
			$this->modpedido->getIdpedido(),
			$this->modpedido->getIdpedido(),
			"pedido",
			""
		);
	}
	public function update()
	{
		$this->load->model('modpedido');
		$this->load->model('modcliente');
		$this->modpedido->getFromInput();
		$this->modcliente->getFromDatabase($this->modpedido->getIdcliente());
		$this->modpedido->setDescuentoporcentaje($this->modcliente->getDescuento());
		$this->modpedido->setDescuentomonto($this->modcliente->getDescuento()/100*$this->modpedido->getSubtotal());
		$this->modpedido->setTotal($this->modpedido->getSubtotal()-$this->modpedido->getDescuentomonto()+$this->modpedido->getIvamonto());
		$this->modpedido->updateToDatabase();
		echo $this->modpedido->getIdpedido();
		$this->modsesion->addLog(
			'actualizar',
			$this->modpedido->getIdpedido(),
			$this->modpedido->getIdpedido(),
			"pedido",
			""
		);
	}
	public function ver($id)
	{
		$this->load->model('modpedido');
		$this->load->model('modcliente');
		$this->load->model('modsucursal');
		$this->load->model('modflujo');
		$this->load->model('modpartida');
		$this->load->model('modproducto');
		$this->modpedido->setIdpedido($id);
		$this->modpedido->getFromDatabase();
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('pedidos/vista',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modpedido,
			"acciones"=>$this->modflujo->getAcciones($this->config->item('idflujopedido'),$this->modpedido->getStatus())
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function actualizar($id)
	{
		$this->load->model('modpedido');
		$this->load->model('modcliente');
		$this->load->model('modsucursal');
		$this->modpedido->setIdpedido($id);
		$this->modpedido->getFromDatabase();
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
		$clientes=$this->modcliente->getAll($idusr);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('pedidos/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modpedido,
			"clientes"=>$clientes,
			"cliente"=>$this->modcliente,
			"sucursal"=>$this->modsucursal
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function eliminar($id)
	{
		$this->load->model('modpedido');
		$this->modpedido->setIdpedido($id);
		$this->modpedido->delete($id);
		$this->modsesion->addLog(
			'eliminar',
			$this->modpedido->getIdpedido(),
			$this->modpedido->getIdpedido(),
			"pedido",
			"'relusuped,relcliped,relpedpar,relsucped"
		);
	}
	public function cambiaEstado()
	{
		$idpedido=$this->input->post('idpedido');
		$idaccion=$this->input->post('idaccion');
		$this->load->model('modpedido');
		$this->load->model('modflujo');
		$this->modpedido->setIdpedido($idpedido);
		$this->modpedido->getFromdatabase();
		$estado=$this->modflujo->getEstadoSiguiente($this->config->item('idflujopedido'),$this->modpedido->getStatus(),$idaccion);
		$this->modpedido->setStatus($estado["idestado"]);
		if(in_array($estado["idestado"],$this->config->item('estadospedidocambiofechacreacion')))
		{
			$this->modpedido->setFechapedido(Today());
			$this->modpedido->setHorapedido(date('H:i:s'));
		}
		if(in_array($estado["idestado"],$this->config->item('estadospedidocambiofechaentrega')))
		{
			$this->modpedido->setFechaentrega(Today());
			$this->modpedido->setHoraentrega(date('H:i:s'));
		}
		$this->modpedido->actualizaEstado();
		echo json_encode($estado);
	}
	public function cambiaEstadoPartida()
	{
		$idpartida=$this->input->post('idpartida');
		$idaccion=$this->input->post('idaccion');
		$this->load->model('modpartida');
		$this->load->model('modflujo');
		$this->modpartida->setIdpartida($idpartida);
		$this->modpartida->getFromdatabase();
		$estado=$this->modflujo->getEstadoSiguiente($this->config->item('idflujopartida'),$this->modpartida->getStatus(),$idaccion);
		$this->modpartida->setStatus($estado["idestado"]);
		if(in_array($estado["idestado"],$this->config->item('estadospedidoactualizapartidas')))
		{
			$this->modpartida->setFecha(Today());
			$this->modpartida->setHora(date('H:i:s'));
		}
		$this->modpartida->actualizaEstado();
		echo json_encode(array(
			"estado"=>$estado,
			"acciones"=>$this->modflujo->getAcciones($this->config->item('idflujopartida'),$this->modpartida->getStatus())
		));
	}
	public function productos($idpedido)
	{
		$this->load->model('modpedido');
		$this->load->model('modproducto');
		$this->load->model('modcliente');
		$this->load->model('modpartida');
		$this->modpedido->setIdpedido($idpedido);
		$this->modpedido->getFromDatabase();
		$this->modcliente->setIdcliente($this->modpedido->getIdcliente());
		$this->modcliente->getFromdatabase();
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('pedidos/vistapartidas',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modpedido,
			"productos"=>$this->modproducto->getAll(),
			"cliente"=>$this->modcliente
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function agregarpartida()
	{
		$this->load->model('modpedido');
		$this->load->model('modproducto');
		$this->load->model('modpartida');
		$this->load->model('modflujo');
		$idpedido=$this->input->post('idpedido');
		$idproducto=$this->input->post('idproducto');
		$this->modpedido->setIdpedido($idpedido);
		$this->modpedido->getFromDatabase();
		$this->modproducto->setIdproducto($idproducto);
		$this->modproducto->getFromDatabase();
		$part=$this->modpedido->incrementarPartida($this->modproducto);
		$this->modpedido->getFromDatabase();
		$this->modpedido->recalculaMontos();
		$this->modpedido->updateToDatabase();
		echo json_encode(array(
			"totalpartidas"	=> $this->modpedido->getTotalpartidas(),
			"total"			=> '$ '.number_format($this->modpedido->getTotal(),2),
			"cantidad"		=> $part->getCantidad()
		));
	}
	public function eliminarpartida()
	{
		$this->load->model('modpedido');
		$this->load->model('modproducto');
		$this->load->model('modpartida');
		$this->load->model('modflujo');
		$idpedido=$this->input->post('idpedido');
		$idproducto=$this->input->post('idproducto');
		$this->modpedido->setIdpedido($idpedido);
		$this->modpedido->getFromDatabase();
		$this->modproducto->setIdproducto($idproducto);
		$this->modproducto->getFromDatabase();
		$part=$this->modpedido->decrementarPartida($this->modproducto);
		$this->modpedido->getFromDatabase();
		$this->modpedido->recalculaMontos();
		$this->modpedido->updateToDatabase();
		echo json_encode(array(
			"totalpartidas"	=> $this->modpedido->getTotalpartidas(),
			"total"			=> '$ '.number_format($this->modpedido->getTotal(),2),
			"cantidad"		=> $part->getCantidad()
		));
	}
	public function frmExport()
	{
		$this->load->model('modflujo');
		$this->load->view("pedidos/formularioexportar",array("estados"=>$this->modflujo->getEstados($this->config->item('idflujopedido'))));
	}
	public function frmIdWinApp($idpedido)
	{
		$this->load->model('modflujo');
		$this->load->view("pedidos/formularioidwinapp",array("idpedido"=>$idpedido));
	}
	public function exportarXML($inicio,$fin,$estado)
	{
		$this->load->library('zip');
		$archivo=$this->crearXML($inicio,$fin,$estado);
		if($archivo!="")
		{
			$this->zip->read_file($this->config->item('ruta_downloads').$archivo);
		}
		$this->zip->download(str_replace(".xml",".zip",$archivo));
	}
	public function exportarExcel($inicio,$fin,$estado)
	{
		$archivo=$this->crearXML($inicio,$fin,$estado);
		header("location: ".base_url("project_files/app/pedido_xml_excel.php?arch=$archivo&path=".base_url("pedidos/descargarExcel")));
	}
	public function crearXML($inicio,$fin,$estado)
	{
		$this->load->model('modpedido');
		$this->load->model('modpartida');
		$this->load->model('modflujo');
		$this->load->model('modcliente');
		$this->load->model('modsucursal');
		$this->load->model('modproducto');
		$pedidos=$this->modpedido->getAllForExport($inicio,$fin,$estado);
		if($pedidos!==false)
		{
			$doc=new DOMDocument("1.0","utf-8");
			$raiz=$doc->createElement("pedidos");
			foreach($pedidos as $p)
			{
				$this->modpedido->setIdpedido($p["idpedido"]);
				$this->modpedido->getFromDatabase();
				$this->modcliente->setIdcliente($this->modpedido->getIdcliente());
				$this->modcliente->getFromDatabase();
				$elemento=$doc->createElement("pedido");
				$elemento->setAttribute("idpedido",$p["idpedido"]);
				$elemento->setAttribute("idwinapp",$p["idwinapp"]);
				$elemento->setAttribute("cteidwinapp",$this->modcliente->getIdWinapp());
				$elemento->setAttribute("cliente",$this->modcliente->getNombre());
				$this->modsucursal->setIdsucursal($this->modpedido->getSucursalentrega());
				$this->modsucursal->getFromDatabase();
				$elemento->setAttribute("sucursalentrega",$this->modsucursal->getNombre());
				$this->modsucursal->setIdsucursal($this->modpedido->getSucursalpago());
				$this->modsucursal->getFromDatabase();
				$elemento->setAttribute("sucursalcobro",$this->modsucursal->getNombre());
				$this->modsucursal->setIdsucursal($this->modpedido->getSucursaldireccion());
				$this->modsucursal->getFromDatabase();
				$elemento->setAttribute("sucursalfacturacion",$this->modsucursal->getNombre());
				$elemento->setAttribute("fechapedido",DateToMx($p["fechapedido"]));
				$elemento->setAttribute("horapedido",$p["horapedido"]);
				$elemento->setAttribute("fechaentrega",DateToMx($p["fechaentrega"]));
				$elemento->setAttribute("horaentrega",$p["horaentrega"]);
				$elemento->setAttribute("estado",$this->modflujo->getEstado($p["status"])["nombre"]);
				if($this->modpedido->getPartidas()!==false) foreach($this->modpedido->getPartidas() as $part)
				{
					$this->modpartida->setidPartida($part);
					$this->modpartida->getFromDatabase();
					$this->modproducto->setidproducto($this->modpartida->getidproducto());
					$this->modproducto->getFromDatabase();
					$partida=$doc->createElement("partida");
					$partida->setAttribute("idpedido",$p["idpedido"]);
					$partida->setAttribute("idwinapp",$p["idwinapp"]);
					$partida->setAttribute("idproducto",$this->modproducto->getIdProducto());
					$partida->setAttribute("idwinappprod",$this->modproducto->getIdwinapp());
					$partida->setAttribute("producto",$this->modpartida->getConcepto());
					$partida->setAttribute("cantidad",$this->modpartida->getCantidad());
					$partida->setAttribute("precio",$this->modpartida->getPrecioUnitario());
					$partida->setAttribute("importe",$this->modpartida->getImporte());
					$partida->setAttribute("estado",$this->modflujo->getEstado($this->modpartida->getStatus())["nombre"]);
					$elemento->appendChild($partida);
				}
				$raiz->appendChild($elemento);
			}
			$doc->appendChild($raiz);
			$doc->formatOutput=true;
			$archivo="pedidos_".time().".xml";
			$doc->save($this->config->item("ruta_downloads").$archivo);
			return $archivo;
		}
		return "";
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
			header("location: ".base_url("project_files/app/pedido_excel_xml.php?arch=$archivo&path=".base_url("pedidos/importaXML")));
		}
	}
	public function importaXML($archivo)
	{
		$this->load->model("modpedido");
		$this->load->model("modpartida");
		$doc=new DOMDocument();
		$doc->load($this->config->item("ruta_uploads").$archivo);
		foreach($doc->getElementsByTagName("pedido") as $pedaux)
		{
			$ped=new Modpedido();
			if($pedaux->getAttribute('idpedido')!="")
			{
				if($ped->getIdFromId($pedaux->getAttribute('idpedido'))!==false)
				{
					$ped->setIdpedido($pedaux->getAttribute('idpedido'));
					$ped->getFromDatabase();
					
				}
			}
		}
	}
	public function getIdWinApp()
	{
		$idpedido=$this->input->post("idpedido");
		$idwinapp=$this->input->post("idwinapp");
		$this->load->model('modpedido');
		$this->modpedido->getFromDatabase($idpedido);
		$this->modpedido->setIdWinApp($idwinapp);
		$this->modpedido->updateToDatabase();
	}
	public function agregarpartidaCantidad()
	{
		$this->load->model('modpedido');
		$this->load->model('modproducto');
		$this->load->model('modpartida');
		$this->load->model('modflujo');
		$idpedido=$this->input->post('idpedido');
		$idproducto=$this->input->post('idproducto');
		$cantidad=$this->input->post('cantidad');
		$this->modpedido->setIdpedido($idpedido);
		$this->modpedido->getFromDatabase();
		$this->modproducto->setIdproducto($idproducto);
		$this->modproducto->getFromDatabase();
		$part=$this->modpedido->establecePartidaCatidad($this->modproducto,$cantidad);
		$this->modpedido->getFromDatabase();
		$this->modpedido->recalculaMontos();
		$this->modpedido->updateToDatabase();
		echo json_encode(array(
			"totalpartidas"	=> $this->modpedido->getTotalpartidas(),
			"total"			=> '$ '.number_format($this->modpedido->getTotal(),2),
			"cantidad"		=> $part->getCantidad()
		));
	}
}
?>