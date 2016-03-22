<?php
class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!($this->modsesion->logedin()))
			header("location: ".base_url("sesiones/logout"));
	}
	public function index()
	{
		$this->load->model('modusuario');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
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
		$usuarios=array();
		if($idusr==0)
			$usuarios=$this->modusuario->getAll();
		else
			$usuarios=$this->modusuario->getAllFromAssignedClients($idusr);
		$body=$this->load->view('usuarios/index',array(
			"menumain"=>$menumain,
			"usuarios"=>$usuarios
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function nuevo()
	{
		$this->load->model('modusuario');
		$this->load->model('modperfil');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('usuarios/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modusuario,
			"perfiles"=>$this->modperfil->getAll()
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function add($idcliente=0)
	{
		$this->load->model('modusuario');
		$this->modusuario->getFromInput();
		$this->modusuario->addToDatabase();
		echo $this->modusuario->getIdusuario();
		$this->modsesion->addLog(
			'agregar',
			$this->modusuario->getIdusuario(),
			$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
			"usuario",
			"relperusu,relcliusu"
		);
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
			$this->modsesion->addLog(
				'enviomail',
				$this->modusuario->getIdusuario(),
				$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
				"usuario",
				""
			);
		else
			$this->modsesion->addLog(
				'errorenviomail',
				$this->modusuario->getIdusuario(),
				$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
				"",
				""
			);
		if($idcliente>0)
		{
			$this->modusuario->asociarACliente($idcliente);
		}
	}
	public function update($idcliente=0)
	{
		$this->load->model('modusuario');
		$this->modusuario->getFromInput();
		$this->modusuario->updateToDatabase();
		echo $this->modusuario->getIdusuario();
		$this->modsesion->addLog(
			'actualizar',
			$this->modusuario->getIdusuario(),
			$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
			"usuario",
			"relperusu"
		);
	}
	public function ver($id,$idcliente=0)
	{
		$this->load->model('modusuario');
		$this->load->model('modperfil');
		$this->load->model('modcliente');
		$this->modusuario->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('usuarios/vista',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modusuario,
			"perfiles"=>$this->modperfil->getAll(),
			"idcliente"=>$idcliente,
			"clientes"=>$this->modcliente->getAll($id)
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
		$this->modsesion->addLog(
			'verdetalle',
			$this->modusuario->getIdusuario(),
			$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
			"",
			""
		);
	}
	public function actualizar($id,$idcliente=0)
	{
		$this->load->model('modusuario');
		$this->load->model('modperfil');
		$this->modusuario->getFromDatabase($id);
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('usuarios/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modusuario,
			"perfiles"=>$this->modperfil->getAll(),
			"clienteIdPerfil"=>($idcliente>0?$this->config->item('idperfilcliente'):false),
			"idCliente"=>$idcliente
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}
	public function eliminar($id)
	{
		$this->load->model('modusuario');
		$this->modusuario->getFromDatabase($id);
		$this->modusuario->delete();
		$this->modsesion->addLog(
			'eliminar',
			$this->modusuario->getIdusuario(),
			$this->modusuario->getNombre()." ".$this->modusuario->getApaterno(),
			"usuario",
			"relperusu,relusuped,relparusu,relcliusu"
		);
	}
	public function crear($idcliente)
	{
		$this->load->model('modusuario');
		$this->load->model('modperfil');
		$head=$this->load->view('html/head',array(),true);
		$menumain=$this->load->view('menu/menumain',array(),true);
		$body=$this->load->view('usuarios/formulario',array(
			"menumain"=>$menumain,
			"objeto"=>$this->modusuario,
			"clienteIdPerfil"=>$this->config->item('idperfilcliente'),
			"idCliente"=>$idcliente
			),true);
		$this->load->view('html/html',array("head"=>$head,"body"=>$body));
	}                        
	public function frmasignaclientes($id)
	{
		$this->load->model("modcliente");
		$this->load->view("clientes/formularioasignar",array(
			"idusr"=>$id,
			"clientesActual"=>$this->modcliente->getAll($id),
			"clientes"=>$this->modcliente->getAll()
			));
	}
	public function asignaclientes($id)
	{
		$this->load->model('modusuario');
		$ctes=$this->input->post("ctes");
		$ctes=explode(",",$ctes);
		$this->modusuario->eliminarClientes($id);
		foreach($ctes as $cte) if(intval($cte)>0)
		{
			$this->modusuario->agregarCliente($id,$cte);
		}
	}
}
?>
