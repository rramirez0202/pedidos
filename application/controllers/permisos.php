<?php
class Permisos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modpermiso');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$permisos=$this->modpermiso->getAllStructured();
		$body=$this->load->view('permisos/index',array(
			"menumain"=>$menumain,
			"permisos"=>$permisos
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function elementosfrm($idpermiso)
	{
		$this->load->model('modpermiso');
		$this->modpermiso->getFromDatabase($idpermiso);
		$body=$this->load->view('permisos/formulario_agregaelementos',array(
			"permiso"=>$this->modpermiso
			));
	}
	public function salvarelementos($idpermiso)
	{
		$this->load->model('modpermiso');
		$nombre=$this->input->post("elemento1");
		$descripcion=$this->input->post("descripcion1");
		$id=0;
		if($idpermiso>0 && trim($nombre)!="") 
		{
			$id=$this->modpermiso->addPermiso($nombre,$descripcion,$idpermiso);
			$this->modsesion->addLog(
				'agregar',
				$id,
				$nombre,
				"permiso",
				""
			);
		}
		$nombre=$this->input->post("elemento2");
		$descripcion=$this->input->post("descripcion2");
		if($idpermiso>0 && trim($nombre)!="") 
		{
			$id=$this->modpermiso->addPermiso($nombre,$descripcion,$idpermiso);
			$this->modsesion->addLog(
				'agregar',
				$id,
				$nombre,
				"permiso",
				""
			);
		}
		$nombre=$this->input->post("elemento3");
		$descripcion=$this->input->post("descripcion3");
		if($idpermiso>0 && trim($nombre)!="") 
		{
			$id=$this->modpermiso->addPermiso($nombre,$descripcion,$idpermiso);
			$this->modsesion->addLog(
				'agregar',
				$id,
				$nombre,
				"permiso",
				""
			);
		}
		$nombre=$this->input->post("elemento4");
		$descripcion=$this->input->post("descripcion4");
		if($idpermiso>0 && trim($nombre)!="") 
		{
			$id=$this->modpermiso->addPermiso($nombre,$descripcion,$idpermiso);
			$this->modsesion->addLog(
				'agregar',
				$id,
				$nombre,
				"permiso",
				""
			);
		}
		$nombre=$this->input->post("elemento5");
		$descripcion=$this->input->post("descripcion5");
		if($idpermiso>0 && trim($nombre)!="") 
		{
			$id=$this->modpermiso->addPermiso($nombre,$descripcion,$idpermiso);
			$this->modsesion->addLog(
				'agregar',
				$id,
				$nombre,
				"permiso",
				""
			);
		}
	}
	public function elementosfrmupd($idpermiso)
	{
		$this->load->model('modpermiso');
		$this->modpermiso->getFromDatabase($idpermiso);
		$body=$this->load->view('permisos/formulario_actualizaelemento',array(
			"permiso"=>$this->modpermiso
			));
	}
	public function salvarelementosupd($idpermiso)
	{
		$this->load->model('modpermiso');
		$this->modpermiso->getFromDatabase($idpermiso);
		$this->modpermiso->setNombre($this->input->post('elemento'));
		$this->modpermiso->setDescripcion($this->input->post('descripcion'));
		$this->modpermiso->updateToDatabase();
		$this->modsesion->addLog(
			'actualizar',
			$this->modpermiso->getIdpermiso(),
			$this->modpermiso->getNombre(),
			"permiso",
			""
		);
	}
	public function eliminar()
	{
		$this->load->model('modpermiso');
		$permisos=trim($this->input->post('permisos'));
		if($permisos!="")
			foreach(explode(",",$permisos) as $idpermiso)
			{
				$this->modpermiso->setIdpermiso($idpermiso);
				$this->modpermiso->getFromDatabase();
				$this->modpermiso->delete();
				$this->modsesion->addLog(
					'eliminar',
					$this->modpermiso->getIdpermiso(),
					$this->modpermiso->getNombre(),
					"permiso",
					"relpermperf"
				);
			}
	}
}
?>
