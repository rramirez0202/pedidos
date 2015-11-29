<?php
class Perfiles extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modperfil');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$perfiles=$this->modperfil->getAll();
		$body=$this->load->view('perfiles/index',array(
			"menumain"=>$menumain,
			"perfiles"=>$perfiles
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function nuevo()
	{
		$this->load->model('modperfil');
		$this->load->model('modpermiso');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$permisos=$this->modpermiso->getAllStructured();
		$body=$this->load->view('perfiles/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modperfil,
			"permisos"=>$permisos
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function add()
	{
		$this->load->model('modperfil');
		$this->modperfil->getFromInput();
		$this->modperfil->addToDatabase();
		echo $this->modperfil->getIdperfil();
		$this->modsesion->addLog(
			'agregar',
			$this->modperfil->getIdperfil(),
			$this->modperfil->getNombre(),
			"perfil",
			"relpermperf"
		);
	}
	public function update()
	{
		$this->load->model('modperfil');
		$this->modperfil->getFromInput();
		$this->modperfil->updateToDatabase();
		echo $this->modperfil->getIdperfil();
		$this->modsesion->addLog(
			'actualizar',
			$this->modperfil->getIdperfil(),
			$this->modperfil->getNombre(),
			"perfil",
			"relpermperf"
		);
	}
	public function ver($id)
	{
		$this->load->model('modperfil');
		$this->load->model('modpermiso');
		$this->modperfil->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$permisos=$this->modpermiso->getAllStructured();
		$body=$this->load->view('perfiles/vista',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modperfil,
			"permisos"=>$permisos
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
		$this->modsesion->addLog(
			'verdetalle',
			$this->modperfil->getIdperfil(),
			$this->modperfil->getNombre(),
			"",
			""
		);
	}
	public function actualizar($id)
	{
		$this->load->model('modperfil');
		$this->load->model('modpermiso');
		$this->modperfil->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$permisos=$this->modpermiso->getAllStructured();
		$body=$this->load->view('perfiles/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modperfil,
			"permisos"=>$permisos
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function eliminar($id)
	{
		$this->load->model('modperfil');
		$this->modperfil->delete($id);
		$this->modsesion->addLog(
			'eliminar',
			$this->modperfil->getIdperfil(),
			$this->modperfil->getNombre(),
			"perfil",
			"relpermperf, relperusu"
		);
	}
}
?>
