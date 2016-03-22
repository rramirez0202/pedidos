<?php
class Sesiones extends CI_Controller
{
	public function login()
	{
		$this->load->model('modsesion');
		$usr=trim($this->input->post('usr'));
		$pwd=trim($this->input->post('pwd'));
		if($usr=="")
		{
			echo "Debe ingresar su usuario.";
		}
		else if($pwd=="")
		{
			echo "Debe ingresar su contraseña.";
		}
		else
		{
			$usuario=$this->modsesion->getAcceso($usr,$pwd);
			if($usuario===false)
			{
				echo "El usuario y contraseña no corresponden";
				$this->load->model('modlog');
				$this->modsesion->addLog(
					'accesofallido',
					0,
					"$usr / $pwd",
					"",
					"",
					0,
					"$usr / $pwd"
				);
			}
			else
			{
				$this->session->set_userdata('idusuario',$usuario["idusuario"]);
				$this->session->set_userdata('datausr',$usuario);
				$this->modsesion->addLog(
					'acceso',
					$this->session->userdata('idusuario'),
					"{$this->session->userdata('datausr')["nombre"]} {$this->session->userdata('datausr')["apaterno"]} ($usr)",
					"",
					""
				);
			}
		}
	}
	public function logout()
	{
		if($this->session->userdata('idusuario')!==false)
			$this->modsesion->addLog(
				'salidasistema',
				$this->session->userdata('idusuario'),
				"{$this->session->userdata('datausr')["nombre"]} {$this->session->userdata('datausr')["apaterno"]} ({$this->session->userdata('datausr')["usuario"]})",
				"",
				""
			);
		$this->session->sess_destroy();
		header('location: '.base_url());
	}
	public function obtenercontrasena()
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