<?php
class Generico extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function creaPanel()
	{
		$tipopanel=$this->input->post('tipopanel');
		$panelheading=$this->input->post('panelheading');
		$panelbody=$this->input->post('panelbody');
		$panelfooter=$this->input->post('panelfooter');
		$this->load->view('panel/panel',array(
		    "tipopanel"=>$tipopanel,
		    "panelheading"=>$panelheading,
		    "panelbody"=>$panelbody,
		    "panelfooter"=>$panelfooter
			));
	}
	public function creaFrmCP()
	{
		$this->load->model("modcodigopostal");
		$cp=$this->input->post('cp');
		$colonia=$this->input->post('colonia');
		$municipio=$this->input->post('municipio');
		$estado=$this->input->post('estado');
		$fnSelecciona=$this->input->post('fnSelecciona');
		$regs=$this->modcodigopostal->getFromDatabase($cp,$colonia,$municipio,$estado);
		$regs=($regs===false?array():$regs);
		$this->load->view('panel/codigopostal_vista',array(
			"cp"=>$cp,
			"colonia"=>$colonia,
			"municipio"=>$municipio,
			"estado"=>$estado,
			"elementos"=>$regs,
			"fnSelecciona"=>$fnSelecciona
		));
	}
	public function creaFrmGetFile($extraView="")
	{
		$extra="";
		if($extraView!="")
			$extra=$this->load->view("extraviews/$extraView",array(),true);
		$this->load->view('panel/get_file',array("extra"=>$extra));
	}
}
?>