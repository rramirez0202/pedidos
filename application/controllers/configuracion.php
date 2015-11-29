<?php
class Configuracion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('configuracion/index',array(
			"menumain"=>$menumain
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
}
?>