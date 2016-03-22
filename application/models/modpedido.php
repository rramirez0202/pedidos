<?php
class Modpedido extends CI_Model
{
	private $idpedido;
	private $fechapedido;
	private $horapedido;
	private $totalpartidas;
	private $fechaentrega;
	private $horaentrega;
	private $descuentoporcentaje;
	private $descuentomonto;
	private $subtotal;
	private $ivaporcentaje;
	private $ivamonto;
	private $total;
	private $status;
	private $idusuario;
	private $idcliente;
	private $partidas;
	private $sucursalentrega;
	private $sucursaldireccion;
	private $sucursalpago;
	private $idwinapp;
	private $observaciones;
	public function __construct()
	{
		$this->idpedido=0;
		$this->fechapedido="";
		$this->horapedido="";
		$this->totalpartidas=0;
		$this->fechaentrega="";
		$this->horaentrega="";
		$this->descuentoporcentaje=0.0;
		$this->descuentomonto=0.0;
		$this->subtotal="";
		$this->ivaporcentaje=0.0;
		$this->ivamonto=0.0;
		$this->total=0.0;
		$this->status=0;
		$this->idusuario=0;
		$this->idcliente=0;
		$this->partidas=array();
		$this->sucursalentrega=0;
		$this->sucursaldireccion=0;
		$this->sucursalpago=0;
		$this->idwinapp="";
		$this->observaciones="";
	}
	public function getIdpedido() { return $this->idpedido; }
	public function getFechapedido() { return $this->fechapedido; }
	public function getHorapedido() { return $this->horapedido; }
	public function getTotalpartidas() { return $this->totalpartidas; }
	public function getFechaentrega() { return $this->fechaentrega; }
	public function getHoraentrega() { return $this->horaentrega; }
	public function getDescuentoporcentaje() { return $this->descuentoporcentaje; }
	public function getDescuentomonto() { return $this->descuentomonto; }
	public function getSubtotal() { return $this->subtotal; }
	public function getIvaporcentaje() { return $this->ivaporcentaje; }
	public function getIvamonto() { return $this->ivamonto; }
	public function getTotal() { return $this->total; }
	public function getStatus() { return $this->status; }
	public function getIdusuario() { return $this->idusuario; }
	public function getIdcliente() { return $this->idcliente; }
	public function getPartidas() { return $this->partidas; }
	public function getSucursalentrega() { return $this->sucursalentrega; }
	public function getSucursaldireccion() { return $this->sucursaldireccion; }
	public function getSucursalpago() { return $this->sucursalpago; }
	public function getIdwinapp() { return $this->idwinapp; }
	public function getObservaciones() { return $this->observaciones; }
	public function setIdpedido($valor) { $this->idpedido= intval($valor); }
	public function setFechapedido($valor) { $this->fechapedido= "".$valor; }
	public function setHorapedido($valor) { $this->horapedido= "".$valor; }
	public function setTotalpartidas($valor) { $this->totalpartidas= intval($valor); }
	public function setFechaentrega($valor) { $this->fechaentrega= "".$valor; }
	public function setHoraentrega($valor) { $this->horaentrega= "".$valor; }
	public function setDescuentoporcentaje($valor) { $this->descuentoporcentaje= "".$valor; }
	public function setDescuentomonto($valor) { $this->descuentomonto= "".$valor; }
	public function setSubtotal($valor) { $this->subtotal= "".$valor; }
	public function setIvaporcentaje($valor) { $this->ivaporcentaje= "".$valor; }
	public function setIvamonto($valor) { $this->ivamonto= "".$valor; }
	public function setTotal($valor) { $this->total= "".$valor; }
	public function setStatus($valor) { $this->status= intval($valor); }
	public function setIdusuario($valor) { $this->idusuario= intval($valor); }
	public function setIdcliente($valor) { $this->idcliente= intval($valor); }
	public function setPartidas($valor) { if(is_array($valor)) $this->partidas=$valor; else array_push($this->partidas,$valor); }
	public function setSucursalentrega($valor) { $this->sucursalentrega= intval($valor); }
	public function setSucursaldireccion($valor) { $this->sucursaldireccion= intval($valor); }
	public function setSucursalpago($valor) { $this->sucursalpago= intval($valor); }
	public function setIdwinapp($valor) { $this->idwinapp= "".$valor; }
	public function setObservaciones($valor) { $this->observaciones= "".$valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idpedido==""||$this->idpedido==0)
		{
			if($id>0)
				$this->idpedido=$id;
			else
				return false;
		}
		$this->db->where('idpedido',$this->idpedido);
		$regs=$this->db->get('pedido');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpedido($reg["idpedido"]);
		$this->setFechapedido($reg["fechapedido"]);
		$this->setHorapedido($reg["horapedido"]);
		$this->setTotalpartidas($reg["totalpartidas"]);
		$this->setFechaentrega($reg["fechaentrega"]);
		$this->setHoraentrega($reg["horaentrega"]);
		$this->setDescuentoporcentaje($reg["descuentoporcentaje"]);
		$this->setDescuentomonto($reg["descuentomonto"]);
		$this->setSubtotal($reg["subtotal"]);
		$this->setIvaporcentaje($reg["ivaporcentaje"]);
		$this->setIvamonto($reg["ivamonto"]);
		$this->setTotal($reg["total"]);
		$this->setStatus($reg["status"]);
		$this->setIdwinapp($reg["idwinapp"]);
		$this->setObservaciones($reg["observaciones"]);
		$this->db->where('idpedido',$this->idpedido);
		$regs=$this->db->get('relusuped');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setIdusuario($reg["idusuario"]);
		}
		$this->db->where('idpedido',$this->idpedido);
		$regs=$this->db->get('relcliped');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setIdcliente($reg["idcliente"]);
		}
		$this->db->where('idpedido',$this->idpedido);
		$regs=$this->db->get('relpedpar');
		$this->setPartidas(array());
		if($regs->num_rows()>0)
		{
			foreach($regs->result_array() as $reg)
				$this->setPartidas($reg["idpartida"]);
		}
		$this->db->where(array('idpedido'=>$this->idpedido,'tiporelacion'=>'2'));
		$regs=$this->db->get('relsucped');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setSucursaldireccion($reg["idsucursal"]);
		}
		$this->db->where(array('idpedido'=>$this->idpedido,'tiporelacion'=>'1'));
		$regs=$this->db->get('relsucped');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setSucursalentrega($reg["idsucursal"]);
		}
		$this->db->where(array('idpedido'=>$this->idpedido,'tiporelacion'=>'3'));
		$regs=$this->db->get('relsucped');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setSucursalpago($reg["idsucursal"]);
		}
		return true;
	}
	public function getFromInput()
	{
		$this->setIdpedido($this->input->post("frm_pedido_idpedido"));
		$this->setFechapedido($this->input->post("frm_pedido_fechapedido"));
		$this->setHorapedido($this->input->post("frm_pedido_horapedido"));
		$this->setTotalpartidas($this->input->post("frm_pedido_totalpartidas"));
		$this->setFechaentrega($this->input->post("frm_pedido_fechaentrega"));
		$this->setHoraentrega($this->input->post("frm_pedido_horaentrega"));
		$this->setDescuentoporcentaje($this->input->post("frm_pedido_descuentoporcentaje"));
		$this->setDescuentomonto($this->input->post("frm_pedido_descuentomonto"));
		$this->setSubtotal($this->input->post("frm_pedido_subtotal"));
		$this->setIvaporcentaje($this->input->post("frm_pedido_ivaporcentaje"));
		$this->setIvamonto($this->input->post("frm_pedido_ivamonto"));
		$this->setTotal($this->input->post("frm_pedido_total"));
		$this->setStatus($this->input->post("frm_pedido_status"));
		$this->setIdusuario($this->input->post("frm_pedido_idusuario"));
		$this->setIdcliente($this->input->post("frm_pedido_idcliente"));
		$this->setPartidas(explode(",",$this->input->post("frm_pedido_partidas")));
		$this->setSucursalentrega($this->input->post("frm_pedido_sucursalentrega"));
		$this->setSucursaldireccion($this->input->post("frm_pedido_sucursaldireccion"));
		$this->setSucursalpago($this->input->post("frm_pedido_sucursalpago"));
		$this->setIdwinapp($this->input->post("frm_pedido_idwinapp"));
		$this->setObservaciones($this->input->post("frm_pedido_observaciones"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"fechapedido"=>$this->fechapedido,
			"horapedido"=>$this->horapedido,
			"totalpartidas"=>$this->totalpartidas,
			"fechaentrega"=>$this->fechaentrega,
			"horaentrega"=>$this->horaentrega,
			"descuentoporcentaje"=>$this->descuentoporcentaje,
			"descuentomonto"=>$this->descuentomonto,
			"subtotal"=>$this->subtotal,
			"ivaporcentaje"=>$this->ivaporcentaje,
			"ivamonto"=>$this->ivamonto,
			"total"=>$this->total,
			"status"=>$this->status,
			"idwinapp"=>$this->idwinapp,
			"observaciones"=>$this->observaciones
		);
		$this->db->insert('pedido',$data);
		$this->setIdpedido($this->db->insert_id());
		$this->db->insert('relusuped',array(
			'idpedido'=>$this->idpedido,
			'idusuario'=>$this->idusuario
		));
		$this->db->insert('relcliped',array(
			'idpedido'=>$this->idpedido,
			'idcliente'=>$this->idcliente
		));
		$this->db->insert('relsucped',array(
			'idpedido'=>$this->idpedido,
			'idsucursal'=>$this->sucursalentrega,
			'tiporelacion'=>1
		));
		$this->db->insert('relsucped',array(
			'idpedido'=>$this->idpedido,
			'idsucursal'=>$this->sucursaldireccion,
			'tiporelacion'=>2
		));
		$this->db->insert('relsucped',array(
			'idpedido'=>$this->idpedido,
			'idsucursal'=>$this->sucursalpago,
			'tiporelacion'=>3
		));
	}
	public function updateToDatabase($id=0)
	{
		if($this->idpedido==""||$this->idpedido==0)
		{
			if($id>0)
				$this->idpedido=$id;
			else
				return false;
		}
		$data=array(
			"fechapedido"=>$this->fechapedido,
			"horapedido"=>$this->horapedido,
			"totalpartidas"=>$this->totalpartidas,
			"fechaentrega"=>$this->fechaentrega,
			"horaentrega"=>$this->horaentrega,
			"descuentoporcentaje"=>$this->descuentoporcentaje,
			"descuentomonto"=>$this->descuentomonto,
			"subtotal"=>$this->subtotal,
			"ivaporcentaje"=>$this->ivaporcentaje,
			"ivamonto"=>$this->ivamonto,
			"total"=>$this->total,
			"status"=>$this->status,
			"idwinapp"=>$this->idwinapp,
			"observaciones"=>$this->observaciones
		);
		$this->db->where('idpedido',$this->idpedido);
		$this->db->update('pedido',$data);
		$this->db->where('idpedido',$this->idpedido);
		$this->db->delete(array('relusuped','relcliped','relsucped'));
		$this->db->insert('relusuped',array(
			'idpedido'=>$this->idpedido,
			'idusuario'=>$this->idusuario
		));
		$this->db->insert('relcliped',array(
			'idpedido'=>$this->idpedido,
			'idcliente'=>$this->idcliente
		));
		$this->db->insert('relsucped',array(
			'idpedido'=>$this->idpedido,
			'idsucursal'=>$this->sucursalentrega,
			'tiporelacion'=>1
		));
		$this->db->insert('relsucped',array(
			'idpedido'=>$this->idpedido,
			'idsucursal'=>$this->sucursaldireccion,
			'tiporelacion'=>2
		));
		$this->db->insert('relsucped',array(
			'idpedido'=>$this->idpedido,
			'idsucursal'=>$this->sucursalpago,
			'tiporelacion'=>3
		));
		return true;
	}
	public function getAll($idusuario=0)
	{
		if($idusuario>0)
		{
			$this->db->where("idpedido in (select idpedido from relcliped where idcliente in (select idcliente from relcliusu where idusuario = $idusuario)) ");
		}
		$this->db->order_by('idpedido');
		$regs=$this->db->get('pedido');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function delete($id=0)
	{
		if($this->idpedido==""||$this->idpedido==0)
		{
			if($id>0)
				$this->idpedido=$id;
			else
				return false;
		}
		$this->db->where('idpedido',$this->idpedido);
		$this->db->delete(array('relusuped','relcliped','relpedpar','relsucped','pedido'));
	}
	public function actualizaEstado()
	{
		if($this->idpedido==""||$this->idpedido==0)
		{
			if($id>0)
				$this->idpedido=$id;
			else
				return false;
		}
		$data=array(
			"status"=>$this->status,
			"fechapedido"=>$this->fechapedido,
			"horapedido"=>$this->horapedido,
			"fechaentrega"=>$this->fechaentrega,
			"horaentrega"=>$this->horaentrega,
		);
		$this->db->where('idpedido',$this->idpedido);
		$this->db->update('pedido',$data);
		return true;
	}
	public function incrementarPartida(Modproducto $producto)
	{
		if($this->idpedido==""||$this->idpedido==0)
			return array("error"=>"idpedidonull");
		if($producto->getIdproducto()==""||$producto->getIdproducto()==0)
			return array("error"=>"idproductonull");
		$res=array(
			"error"=>false
			);
		$this->db->where("idpartida in (select idpartida from relpedpar where idpedido = {$this->idpedido}) and idpartida in (select idpartida from relpropar where idproducto = {$producto->getIdproducto()})");
		$regs=$this->db->get('partida');
		$partida=new Modpartida();
		if($regs->num_rows()>0)
		{
			$partida->setIdpartida($regs->row_array()["idpartida"]);
			$partida->getFromDatabase();
		}
		else
		{
			$partida->setIdpedido($this->idpedido);
			$partida->setIdproducto($producto->getIdproducto());
			$partida->setStatus($this->modflujo->getEstadoInicial($this->config->item('idflujopartida'))["idestado"]);
		}
		$partida->setFecha(Today());
		$partida->setHora(Hora());
		$partida->setCantidad(intval($partida->getCantidad())+1);
		$partida->setConcepto($producto->getNombre());
		$partida->setPreciounitario($producto->getPrecioTotal());
		$partida->setImporte(floatval($partida->getCantidad()*$partida->getPreciounitario()));
		$partida->setPreciobase($producto->getPrecio());
		$partida->setImpuesoporc($producto->getImpuesto());
		$partida->setImpuesto($producto->getImpuesto()/100.0*$producto->getPrecio()*$partida->getCantidad());
		$partida->setUsuario($this->session->userdata('idusuario'));
		if($regs->num_rows()>0)
		{
			$partida->updateToDatabase();
		}
		else
		{
			$partida->addToDatabase();
		}
		return $partida;
	}
	public function decrementarPartida(Modproducto $producto)
	{
		if($this->idpedido==""||$this->idpedido==0)
			return array("error"=>"idpedidonull");
		if($producto->getIdproducto()==""||$producto->getIdproducto()==0)
			return array("error"=>"idproductonull");
		$res=array(
			"error"=>false
			);
		$this->db->where("idpartida in (select idpartida from relpedpar where idpedido = {$this->idpedido}) and idpartida in (select idpartida from relpropar where idproducto = {$producto->getIdproducto()})");
		$regs=$this->db->get('partida');
		$partida=new Modpartida();
		if($regs->num_rows()>0)
		{
			$partida->setIdpartida($regs->row_array()["idpartida"]);
			$partida->getFromDatabase();
		}
		else
		{
			$partida->setStatus($this->modflujo->getEstadoInicial($this->config->item('idflujopartida'))["idestado"]);
		}
		$partida->setFecha(Today());
		$partida->setHora(Hora());
		$partida->setCantidad(intval($partida->getCantidad())-1);
		$partida->setConcepto($producto->getNombre());
		$partida->setPreciounitario($producto->getPrecioTotal());
		$partida->setImporte(floatval($partida->getCantidad()*$partida->getPreciounitario()));
		$partida->setPreciobase($producto->getPrecio());
		$partida->setImpuesoporc($producto->getImpuesto());
		$partida->setImpuesto($producto->getImpuesto()/100.0*$producto->getPrecio()*$partida->getCantidad());
		if($partida->getCantidad()>0)
		{
			if($regs->num_rows()>0)
			{
				$partida->updateToDatabase();
			}
			else
			{
				$partida->addToDatabase();
			}
		}
		else
		{
			$partida->delete();
		}
		return $partida;
	}
	public function recalculaMontos()
	{
		if($this->idpedido==""||$this->idpedido==0)
			return false;
		$subtotal=0.0;
		$iva=0.0;
		foreach($this->partidas as $p)
		{
			$partida=new Modpartida();
			$partida->setIdpartida($p);
			$partida->getFromDatabase();
			$subtotal+=$partida->getPreciobase()*$partida->getCantidad();
			$iva+=$partida->getImpuesto();
		}
		$descuento=$subtotal*floatval($this->descuentoporcentaje)/100;
		$total=$subtotal-$descuento+$iva;
		$this->subtotal=$subtotal;
		$this->descuentomonto=$descuento;
		$this->ivamonto=$iva;
		$this->total=$total;
		$this->totalpartidas=count($this->partidas);
		return true;
	}
	public function getAllForExport($inicio,$fin,$estado)
	{
		$this->db->where("fechapedido >= '$inicio' and fechapedido <= '$fin' and status = $estado");
		$this->db->order_by('idpedido');
		$regs=$this->db->get('pedido');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function getIdFromId($idpedido)
	{
		$this->db->where('idpedido',$idpedido);
		$regs=$this->db->get('pedido');
		if($regs->num_rows()==0)
			return false;
		return $regs->row_array()["idpedido"];
	}
	public function getIdFromIdWinApp($idwinapp)
	{
		$this->db->where('idwinapp',$idwinapp);
		$regs=$this->db->get('pedido');
		if($regs->num_rows()==0)
			return false;
		return $regs->row_array()["idpedido"];
	}
	public function establecePartidaCatidad(Modproducto $producto, $cantidad)
	{
		if($this->idpedido==""||$this->idpedido==0)
			return array("error"=>"idpedidonull");
		if($producto->getIdproducto()==""||$producto->getIdproducto()==0)
			return array("error"=>"idproductonull");
		$res=array(
			"error"=>false
			);
		$this->db->where("idpartida in (select idpartida from relpedpar where idpedido = {$this->idpedido}) and idpartida in (select idpartida from relpropar where idproducto = {$producto->getIdproducto()})");
		$regs=$this->db->get('partida');
		$partida=new Modpartida();
		if($regs->num_rows()>0)
		{
			$partida->setIdpartida($regs->row_array()["idpartida"]);
			$partida->getFromDatabase();
		}
		else
		{
			$partida->setIdpedido($this->idpedido);
			$partida->setIdproducto($producto->getIdproducto());
			$partida->setStatus($this->modflujo->getEstadoInicial($this->config->item('idflujopartida'))["idestado"]);
		}
		$partida->setFecha(Today());
		$partida->setHora(Hora());
		$partida->setCantidad($cantidad);
		$partida->setConcepto($producto->getNombre());
		$partida->setPreciounitario($producto->getPrecioTotal());
		$partida->setImporte(floatval($partida->getCantidad()*$partida->getPreciounitario()));
		$partida->setPreciobase($producto->getPrecio());
		$partida->setImpuesoporc($producto->getImpuesto());
		$partida->setImpuesto($producto->getImpuesto()/100.0*$producto->getPrecio()*$partida->getCantidad());
		$partida->setUsuario($this->session->userdata('idusuario'));
		if($regs->num_rows()>0)
		{
			$partida->updateToDatabase();
		}
		else
		{
			$partida->addToDatabase();
		}
		if($cantidad==0)
		{
			$partida->delete();
		}
		return $partida;
	}
}
?>
