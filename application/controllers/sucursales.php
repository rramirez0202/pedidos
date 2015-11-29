<?php
class Sucursales extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function nuevo($idcliente)
	{
		$this->load->model('modsucursal');
		$this->modsucursal->setIdcliente($idcliente);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('sucursales/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modsucursal
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function add()
	{
		$this->load->model('modsucursal');
		$this->modsucursal->getFromInput();
		$this->modsucursal->addToDatabase();
		echo $this->modsucursal->getIdsucursal();
		$this->modsesion->addLog(
			'agregar',
			$this->modsucursal->getIdsucursal(),
			$this->modsucursal->getNombre(),
			"sucursal",
			"relclisuc"
		);
	}
	public function update()
	{
		$this->load->model('modsucursal');
		$this->modsucursal->getFromInput();
		$this->modsucursal->updateToDatabase();
		echo $this->modsucursal->getIdsucursal();
		$this->modsesion->addLog(
			'actualizar',
			$this->modsucursal->getIdsucursal(),
			$this->modsucursal->getNombre(),
			"sucursal",
			""
		);
	}
	public function ver($id)
	{
		$this->load->model('modsucursal');
		$this->modsucursal->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('sucursales/vista',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modsucursal
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
		$this->modsesion->addLog(
			'verdetalle',
			$this->modsucursal->getIdsucursal(),
			$this->modsucursal->getNombre(),
			"",
			""
		);
	}
	public function ver2($id)
	{
		$this->load->model('modsucursal');
		$this->modsucursal->getFromDatabase($id);
		$this->load->view('sucursales/vista2',array(
			"objeto"=>$this->modsucursal
			));
	}
	public function actualizar($id)
	{
		$this->load->model('modsucursal');
		$this->modsucursal->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('sucursales/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modsucursal
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function eliminar($id)
	{
		$this->load->model('modsucursal');
		$this->modsucursal->delete($id);
		$this->modsesion->addLog(
			'eliminar',
			$this->modsucursal->getIdsucursal(),
			$this->modsucursal->getNombre(),
			"sucursal",
			"relclisuc,relsucped"
		);
	}
}
?>