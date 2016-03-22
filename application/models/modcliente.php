<?php
class Modcliente extends CI_Model
{
	private $idcliente;
	private $nombre;
	private $razonsocial;
	private $rfc;
	private $curp;
	private $observaciones;
	private $activo;
	private $sucursales;
	private $usuarios;
	private $pedidos;
	private $idwinapp;
	private $descuento;
	public function __construct()
	{
		parent::__construct();
		$this->Inicializar();
	}
	public function getIdcliente() { return $this->idcliente; }
	public function getNombre() { return $this->nombre; }
	public function getRazonsocial() { return $this->razonsocial; }
	public function getRfc() { return $this->rfc; }
	public function getCurp() { return $this->curp; }
	public function getObservaciones() { return $this->observaciones; }
	public function getActivo() { return $this->activo; }
	public function getSucursales() { return $this->sucursales; }
	public function getUsuarios() { return $this->usuarios; }
	public function getPedidos() { return $this->pedidos; }
	public function getIdwinapp() { return $this->idwinapp; }
	public function getDescuento() { return $this->descuento; }
	public function setIdcliente($valor) { $this->idcliente= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setRazonsocial($valor) { $this->razonsocial= "".$valor; }
	public function setRfc($valor) { $this->rfc= "".$valor; }
	public function setCurp($valor) { $this->curp= "".$valor; }
	public function setObservaciones($valor) { $this->observaciones= "".$valor; }
	public function setActivo($valor) { $this->activo= intval($valor); }
	public function setSucursales($valor) { if(is_array($valor)) $this->sucursales=$valor; else array_push($this->sucursales,$valor); }
	public function setUsuarios($valor) { if(is_array($valor)) $this->usuarios=$valor; else array_push($this->usuarios,$valor); }
	public function setPedidos($valor) { if(is_array($valor)) $this->pedidos=$valor; else array_push($this->pedidos,$valor); }
	public function setIdwinapp($valor) { $this->idwinapp= "".$valor; }
	public function setDescuento($valor) { $this->descuento= "".$valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idcliente==""||$this->idcliente==0)
		{
			if($id>0)
				$this->idcliente=$id;
			else
				return false;
		}
		$this->db->where('idcliente',$this->idcliente);
		$regs=$this->db->get('cliente');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdcliente($reg["idcliente"]);
		$this->setNombre($reg["nombre"]);
		$this->setRazonsocial($reg["razonsocial"]);
		$this->setRfc($reg["rfc"]);
		$this->setCurp($reg["curp"]);
		$this->setObservaciones($reg["observaciones"]);
		$this->setActivo($reg["activo"]);
		$this->setIdwinapp($reg["idwinapp"]);
		$this->setSucursales(array());
		$this->setUsuarios(array());
		$this->setPedidos(array());
		$this->setDescuento($reg["descuento"]);
		$this->db->where('idcliente',$this->idcliente);
		$regs=$this->db->get('relclisuc');
		if($regs!==false && $regs->num_rows()>0) 
		{
			foreach($regs->result_array() as $reg)
				$this->setSucursales($reg["idsucursal"]);
		}
		$this->db->where('idcliente',$this->idcliente);
		$regs=$this->db->get('relcliusu');
		if($regs!==false && $regs->num_rows()>0) 
		{
			foreach($regs->result_array() as $reg)
				$this->setUsuarios($reg["idusuario"]);
		}
		$this->db->where('idcliente',$this->idcliente);
		$regs=$this->db->get('relcliped');
		if($regs!==false && $regs->num_rows()>0) 
		{
			foreach($regs->result_array() as $reg)
				$this->setPedidos($reg["idpedido"]);
		}
		return true;
	}
	public function getFromInput()
	{
		$this->setIdcliente($this->input->post("frm_cliente_idcliente"));
		$this->setNombre($this->input->post("frm_cliente_nombre"));
		$this->setRazonsocial($this->input->post("frm_cliente_razonsocial"));
		$this->setRfc($this->input->post("frm_cliente_rfc"));
		$this->setCurp($this->input->post("frm_cliente_curp"));
		$this->setObservaciones($this->input->post("frm_cliente_observaciones"));
		$this->setActivo($this->input->post("frm_cliente_activo"));
		$this->setSucursales(explode(",",$this->input->post("frm_cliente_sucursales")));
		$this->setUsuarios(explode(",",$this->input->post("frm_cliente_usuarios")));
		$this->setPedidos(explode(",",$this->input->post("frm_cliente_pedidos")));
		$this->setIdwinapp($this->input->post("frm_cliente_idwinapp"));
		$this->setDescuento($this->input->post("frm_cliente_descuento"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"razonsocial"=>$this->razonsocial,
			"rfc"=>$this->rfc,
			"curp"=>$this->curp,
			"observaciones"=>$this->observaciones,
			"activo"=>$this->activo,
			"idwinapp"=>$this->idwinapp,
			"descuento"=>$this->descuento
		);
		$this->db->insert('cliente',$data);
		$this->setIdcliente($this->db->insert_id());
	}
	public function updateToDatabase($id=0)
	{
		if($this->idcliente==""||$this->idcliente==0)
		{
			if($id>0)
				$this->idcliente=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"razonsocial"=>$this->razonsocial,
			"rfc"=>$this->rfc,
			"curp"=>$this->curp,
			"observaciones"=>$this->observaciones,
			"activo"=>$this->activo,
			"idwinapp"=>$this->idwinapp,
			"descuento"=>$this->descuento
		);
		$this->db->where('idcliente',$this->idcliente);
		$this->db->update('cliente',$data);
		return true;
	}
	public function getAll($idusuario=0)
	{
		if($idusuario>0)
		{
			$this->db->where("idcliente in (select idcliente from relcliusu where idusuario = $idusuario)");
		}
		$this->db->order_by('nombre');
		$regs=$this->db->get('cliente');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function delete($id=0)
	{
		if($this->idcliente==""||$this->idcliente==0)
		{
			if($id>0)
				$this->idcliente=$id;
			else
				return false;
		}
		$this->getFromDatabase();
		foreach($this->sucursales as $reg)
		{
			$this->modsucursal->setIdSucursal($reg);
			$this->modsucursal->delete();
		}
		foreach($this->usuarios as $reg)
		{
			$this->modusuario->setIdusuario($reg);
			$this->modusuario->delete();
		}
		foreach($this->pedidos as $reg)
		{
			$this->modpedido->setIdpedido($reg);
			$this->modpedido->delete();
		}
		$this->db->where('idcliente',$this->idcliente);
		$this->db->delete(array('relcliusu','relclisuc','relcliped','cliente'));
	}
	public function Inicializar()
	{
		$this->idcliente=0;
		$this->nombre="";
		$this->razonsocial="";
		$this->rfc="";
		$this->curp="";
		$this->observaciones="";
		$this->activo=0;
		$this->sucursales=array();
		$this->usuarios=array();
		$this->pedidos=array();
		$this->idwinapp="";
		$this->descuento="";
	}
}
?>
