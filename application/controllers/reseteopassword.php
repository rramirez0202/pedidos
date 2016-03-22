<?php
class Reseteopassword extends CI_Controller
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
		$body=$this->load->view('reseteopassword/index',array("menumain"=>$menumain),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function resetear()
	{
		$usr=trim($this->input->post('usr'));
		if($usr!="")
		{
			$usuario=$this->modsesion->getdata($usr);
			if($usuario===false)
				echo "El usuario no se encuentra registrado en el sistema.";
			else
			{
				$this->load->model('modusuario');
				$this->modusuario->getFromDatabase($usuario["idusuario"]);
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
				$this->load->library('email');
				$this->email->from($this->config->item("noreplyemail"),$this->config->item("noreplyname"));
				$this->email->to($this->modusuario->getEmail());
				$this->email->message($cuerpomail);
				$this->email->subject('Alta en Sistema: Control de Pedidos');
				if($this->email->send())
				{
					$this->modsesion->addLog(
						'enviomail',
						$this->modusuario->getIdusuario(),
						$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
						"usuario",
						""
					);
					echo "Se ha envíado un correo con los nuevos datos de acceso a {$this->modusuario->getEmail()}";
				}
				else
				{
					$this->modsesion->addLog(
						'errorenviomail',
						$this->modusuario->getIdusuario(),
						$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
						"",
						""
					);
					echo "Ocurrió un error al enviar los nuevos datos de acceso a {$this->modusuario->getEmail()}";
				}
			}
		}
		else
			echo "Debe ingresar el nombre de usuario";
	}
}
?>
