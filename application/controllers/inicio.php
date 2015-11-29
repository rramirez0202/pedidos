<?php
class Inicio extends CI_Controller
{
	public function index()
	{
		$this->load->view('inicio/acceso');
	}
	public function principal()
	{
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('inicio/administracion_index.php',array("menumain"=>$menumain),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function recuperarcontrasena()
	{
		$this->load->view('inicio/recuperapwd');
	}
	public function maildatosacceso()
	{
		$this->load->view('inicio/dataaccesmail');
	}
}
?>