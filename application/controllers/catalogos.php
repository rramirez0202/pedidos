<?php
class Catalogos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modcatalogo');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$catalogos=$this->modcatalogo->getAll();
		$catalogos=($catalogos!==false?$catalogos:array());
		$body=$this->load->view('catalogos/index',array(
			"menumain"=>$menumain,
			"catalogos"=>$catalogos
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function ver($idcatalogo)
	{
		$this->load->model('modcatalogo');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$catalgo=$this->modcatalogo->getCatalogo($idcatalogo);
		$body=$this->load->view('catalogos/vista',array(
			"menumain"=>$menumain,
			"catalogo"=>$catalgo
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
		$this->modsesion->addLog(
			'verdetalle',
			$idcatalogo,
			$catalgo["descripcion"],
			"",
			""
		);
	}
	public function catalogofrm($idcatalogo=0)
	{
		$this->load->model('modcatalogo');
		$catalogoname="";
		if($idcatalogo>0)
			$catalogoname=$this->modcatalogo->getCatalogo($idcatalogo)["descripcion"];
		$this->load->view('catalogos/formulario_catalogo.php',array("catalogoname"=>$catalogoname));
	}
	public function nuevo($catalogoname)
	{
		$this->load->model('modcatalogo');
		$catalogoname=urldecode($catalogoname);
		$id=$this->modcatalogo->addNewCatalog($catalogoname);
		$this->modsesion->addLog(
			'agregar',
			$id,
			$catalogoname,
			"catalogo",
			""
		);
		header("location: ".base_url('catalogos/ver/'.$id));
	}
	public function opcionesfrm($idcatalogo)
	{
		$this->load->model('modcatalogo');
		$this->load->view('catalogos/formulario_opciones.php',array('idcatalogo'=>$idcatalogo));
	}
	public function agregarOpciones($idcatalogo)
	{
		$this->load->model('modcatalogo');
		$opc=$this->input->post('option1');
		if($opc!==false && $opc!="") $this->modcatalogo->addNewOption($idcatalogo,$opc);
		$opc=$this->input->post('option2');
		if($opc!==false && $opc!="") $this->modcatalogo->addNewOption($idcatalogo,$opc);
		$opc=$this->input->post('option3');
		if($opc!==false && $opc!="") $this->modcatalogo->addNewOption($idcatalogo,$opc);
		$opc=$this->input->post('option4');
		if($opc!==false && $opc!="") $this->modcatalogo->addNewOption($idcatalogo,$opc);
		$opc=$this->input->post('option5');
		if($opc!==false && $opc!="") $this->modcatalogo->addNewOption($idcatalogo,$opc);
		$catalgo=$this->modcatalogo->getCatalogo($idcatalogo);
		$this->modsesion->addLog(
			'agregar',
			$idcatalogo,
			$catalgo["descripcion"],
			"catalogodet",
			"relcatcatdet"
		);
		header("location: ".base_url('catalogos/ver/'.$idcatalogo));
	}
	public function actualiza($idcatalogo,$catalogoname)
	{
		$this->load->model('modcatalogo');
		$catalogoname=urldecode($catalogoname);
		$this->modcatalogo->updateCatalog($idcatalogo,$catalogoname);
		$this->modsesion->addLog(
			'actualizar',
			$idcatalogo,
			$catalogoname,
			"catalogo",
			""
		);
		header("location: ".base_url('catalogos/ver/'.$idcatalogo));
	}
	public function borraropciones($idcatalogo)
	{
		$this->load->model('modcatalogo');
		$opcs=$this->input->post('opciones');
		if($opcs!="")
		{
			$opcs=explode(",",$opcs);
			foreach($opcs as $opc)
				$this->modcatalogo->deleteOption($opc);
		}
		$catalgo=$this->modcatalogo->getCatalogo($idcatalogo);
		$this->modsesion->addLog(
			'eliminar',
			$idcatalogo,
			$catalgo["descripcion"],
			"catalogodet",
			"relcatcatdet"
		);
	}
}
?>
