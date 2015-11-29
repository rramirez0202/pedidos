<?php
class Modsucursal extends CI_Model
{
	private $idsucursal;
	private $nombre;
	private $contactonombre;
	private $contactotelefono1;
	private $contactoextension1;
	private $contactotelefono2;
	private $contactoextension2;
	private $contactofax;
	private $contactoemail;
	private $calle;
	private $noexterior;
	private $nointerior;
	private $colonia;
	private $municipio;
	private $estado;
	private $pais;
	private $cp;
	private $referencias;
	private $activo;
	private $observaciones;
	private $idcliente;
	private $pedidosentrega;
	private $pedidosdireccion;
	private $pedidospago;
	public function __construct()
	{
		parent::__construct();
		$this->Inicializar();
	}
	public function getIdsucursal() { return $this->idsucursal; }
	public function getNombre() { return $this->nombre; }
	public function getContactonombre() { return $this->contactonombre; }
	public function getContactotelefono1() { return $this->contactotelefono1; }
	public function getContactoextension1() { return $this->contactoextension1; }
	public function getContactotelefono2() { return $this->contactotelefono2; }
	public function getContactoextension2() { return $this->contactoextension2; }
	public function getContactofax() { return $this->contactofax; }
	public function getContactoemail() { return $this->contactoemail; }
	public function getCalle() { return $this->calle; }
	public function getNoexterior() { return $this->noexterior; }
	public function getNointerior() { return $this->nointerior; }
	public function getColonia() { return $this->colonia; }
	public function getMunicipio() { return $this->municipio; }
	public function getEstado() { return $this->estado; }
	public function getPais() { return $this->pais; }
	public function getCp() { return $this->cp; }
	public function getReferencias() { return $this->referencias; }
	public function getActivo() { return $this->activo; }
	public function getObservaciones() { return $this->observaciones; }
	public function getIdcliente() { return $this->idcliente; }
	public function getPedidosentrega() { return $this->pedidosentrega; }
	public function getPedidosdireccion() { return $this->pedidosdireccion; }
	public function getPedidospago() { return $this->pedidospago; }
	public function setIdsucursal($valor) { $this->idsucursal= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setContactonombre($valor) { $this->contactonombre= "".$valor; }
	public function setContactotelefono1($valor) { $this->contactotelefono1= "".$valor; }
	public function setContactoextension1($valor) { $this->contactoextension1= "".$valor; }
	public function setContactotelefono2($valor) { $this->contactotelefono2= "".$valor; }
	public function setContactoextension2($valor) { $this->contactoextension2= "".$valor; }
	public function setContactofax($valor) { $this->contactofax= "".$valor; }
	public function setContactoemail($valor) { $this->contactoemail= "".$valor; }
	public function setCalle($valor) { $this->calle= "".$valor; }
	public function setNoexterior($valor) { $this->noexterior= "".$valor; }
	public function setNointerior($valor) { $this->nointerior= "".$valor; }
	public function setColonia($valor) { $this->colonia= "".$valor; }
	public function setMunicipio($valor) { $this->municipio= "".$valor; }
	public function setEstado($valor) { $this->estado= "".$valor; }
	public function setPais($valor) { $this->pais= "".$valor; }
	public function setCp($valor) { $this->cp= "".$valor; }
	public function setReferencias($valor) { $this->referencias= "".$valor; }
	public function setActivo($valor) { $this->activo= intval($valor); }
	public function setObservaciones($valor) { $this->observaciones= "".$valor; }
	public function setIdcliente($valor) { $this->idcliente= intval($valor); }
	public function setPedidosentrega($valor) { if(is_array($valor)) $this->pedidosentrega=$valor; else array_push($this->pedidosentrega,$valor); }
	public function setPedidosdireccion($valor) { if(is_array($valor)) $this->pedidosdireccion=$valor; else array_push($this->pedidosdireccion,$valor); }
	public function setPedidospago($valor) { if(is_array($valor)) $this->pedidospago=$valor; else array_push($this->pedidospago,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idsucursal==""||$this->idsucursal==0)
		{
			if($id>0)
				$this->idsucursal=$id;
			else
				return false;
		}
		$this->db->where('idsucursal',$this->idsucursal);
		$regs=$this->db->get('sucursal');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setNombre($reg["nombre"]);
		$this->setContactonombre($reg["contactonombre"]);
		$this->setContactotelefono1($reg["contactotelefono1"]);
		$this->setContactoextension1($reg["contactoextension1"]);
		$this->setContactotelefono2($reg["contactotelefono2"]);
		$this->setContactoextension2($reg["contactoextension2"]);
		$this->setContactofax($reg["contactofax"]);
		$this->setContactoemail($reg["contactoemail"]);
		$this->setCalle($reg["calle"]);
		$this->setNoexterior($reg["noexterior"]);
		$this->setNointerior($reg["nointerior"]);
		$this->setColonia($reg["colonia"]);
		$this->setMunicipio($reg["municipio"]);
		$this->setEstado($reg["estado"]);
		$this->setPais($reg["pais"]);
		$this->setCp($reg["cp"]);
		$this->setReferencias($reg["referencias"]);
		$this->setActivo($reg["activo"]);
		$this->setObservaciones($reg["observaciones"]);
		$this->db->where('idsucursal',$this->idsucursal);
		$regs=$this->db->get('relclisuc');
		if($regs!==false && $regs->num_rows()>0) foreach($regs->result_array() as $reg)
			$this->setIdcliente($reg["idcliente"]);
		$this->db->where(array('idsucursal'=>$this->idsucursal,"tiporelacion"=>1));
		$regs=$this->db->get('relsucped');
		if($regs!==false && $regs->num_rows()>0) foreach($regs->result_array() as $reg)
			$this->setPedidosentrega($reg["idpedido"]);
		$this->db->where(array('idsucursal'=>$this->idsucursal,"tiporelacion"=>2));
		$regs=$this->db->get('relsucped');
		if($regs!==false && $regs->num_rows()>0) foreach($regs->result_array() as $reg)
			$this->setPedidosdireccion($reg["idpedido"]);
		$this->db->where(array('idsucursal'=>$this->idsucursal,"tiporelacion"=>3));
		$regs=$this->db->get('relsucped');
		if($regs!==false && $regs->num_rows()>0) foreach($regs->result_array() as $reg)
			$this->setPedidospago($reg["idpedido"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdsucursal($this->input->post("frm_sucursal_idsucursal"));
		$this->setNombre($this->input->post("frm_sucursal_nombre"));
		$this->setContactonombre($this->input->post("frm_sucursal_contactonombre"));
		$this->setContactotelefono1($this->input->post("frm_sucursal_contactotelefono1"));
		$this->setContactoextension1($this->input->post("frm_sucursal_contactoextension1"));
		$this->setContactotelefono2($this->input->post("frm_sucursal_contactotelefono2"));
		$this->setContactoextension2($this->input->post("frm_sucursal_contactoextension2"));
		$this->setContactofax($this->input->post("frm_sucursal_contactofax"));
		$this->setContactoemail($this->input->post("frm_sucursal_contactoemail"));
		$this->setCalle($this->input->post("frm_sucursal_calle"));
		$this->setNoexterior($this->input->post("frm_sucursal_noexterior"));
		$this->setNointerior($this->input->post("frm_sucursal_nointerior"));
		$this->setColonia($this->input->post("frm_sucursal_colonia"));
		$this->setMunicipio($this->input->post("frm_sucursal_municipio"));
		$this->setEstado($this->input->post("frm_sucursal_estado"));
		$this->setPais($this->input->post("frm_sucursal_pais"));
		$this->setCp($this->input->post("frm_sucursal_cp"));
		$this->setReferencias($this->input->post("frm_sucursal_referencias"));
		$this->setActivo($this->input->post("frm_sucursal_activo"));
		$this->setObservaciones($this->input->post("frm_sucursal_observaciones"));
		$this->setIdcliente($this->input->post("frm_sucursal_idcliente"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"contactonombre"=>$this->contactonombre,
			"contactotelefono1"=>$this->contactotelefono1,
			"contactoextension1"=>$this->contactoextension1,
			"contactotelefono2"=>$this->contactotelefono2,
			"contactoextension2"=>$this->contactoextension2,
			"contactofax"=>$this->contactofax,
			"contactoemail"=>$this->contactoemail,
			"calle"=>$this->calle,
			"noexterior"=>$this->noexterior,
			"nointerior"=>$this->nointerior,
			"colonia"=>$this->colonia,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado,
			"pais"=>$this->pais,
			"cp"=>$this->cp,
			"referencias"=>$this->referencias,
			"activo"=>$this->activo,
			"observaciones"=>$this->observaciones
		);
		$this->db->insert('sucursal',$data);
		$this->setIdsucursal($this->db->insert_id());
		$this->db->insert('relclisuc',array(
			"idcliente"=>$this->idcliente,
			"idsucursal"=>$this->idsucursal
		));
	}
	public function updateToDatabase($id=0)
	{
		if($this->idsucursal==""||$this->idsucursal==0)
		{
			if($id>0)
				$this->idsucursal=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"contactonombre"=>$this->contactonombre,
			"contactotelefono1"=>$this->contactotelefono1,
			"contactoextension1"=>$this->contactoextension1,
			"contactotelefono2"=>$this->contactotelefono2,
			"contactoextension2"=>$this->contactoextension2,
			"contactofax"=>$this->contactofax,
			"contactoemail"=>$this->contactoemail,
			"calle"=>$this->calle,
			"noexterior"=>$this->noexterior,
			"nointerior"=>$this->nointerior,
			"colonia"=>$this->colonia,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado,
			"pais"=>$this->pais,
			"cp"=>$this->cp,
			"referencias"=>$this->referencias,
			"activo"=>$this->activo,
			"observaciones"=>$this->observaciones
		);
		$this->db->where('idsucursal',$this->idsucursal);
		$this->db->update('sucursal',$data);
		return true;
	}
	public function getAll($idcliente=0)
	{
		if($idcliente>0)
			$this->db->where("idsucursal in (select idsucursal from relclisuc where idcliente = $idcliente)");
		$this->db->order_by('nombre');
		$regs=$this->db->get('sucursal');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function delete($id=0)
	{
		if($this->idsucursal==""||$this->idsucursal==0)
		{
			if($id>0)
				$this->idsucursal=$id;
			else
				return false;
		}
		$this->db->where('idsucursal',$this->idsucursal);
		$this->db->delete(array('relclisuc','relsucped','sucursal'));
	}
	public function Inicializar()
	{
		$this->idsucursal=0;
		$this->nombre="";
		$this->contactonombre="";
		$this->contactotelefono1="";
		$this->contactoextension1="";
		$this->contactotelefono2="";
		$this->contactoextension2="";
		$this->contactofax="";
		$this->contactoemail="";
		$this->calle="";
		$this->noexterior="";
		$this->nointerior="";
		$this->colonia="";
		$this->municipio="";
		$this->estado="";
		$this->pais="";
		$this->cp="";
		$this->referencias="";
		$this->activo=0;
		$this->observaciones="";
		$this->idcliente=0;
		$this->pedidosentrega=array();
		$this->pedidosdireccion=array();
		$this->pedidospago=array();
	}
}
?>
