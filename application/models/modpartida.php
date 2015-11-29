<?php
class Modpartida extends CI_Model
{
	private $idpartida;
	private $fecha;
	private $hora;
	private $cantidad;
	private $concepto;
	private $preciounitario;
	private $descuento;
	private $importe;
	private $status;
	private $usuario;
	private $idpedido;
	private $idproducto;
	public function __construct()
	{
		$this->idpartida=0;
		$this->fecha=Today();
		$this->hora=Hora();
		$this->cantidad=0;
		$this->concepto="";
		$this->preciounitario=0.0;
		$this->descuento=0.0;
		$this->importe=0.0;
		$this->status=0;
		$this->usuario=0;
		$this->idpedido=0;
		$this->idproducto=0;
	}
	public function getIdpartida() { return $this->idpartida; }
	public function getFecha() { return $this->fecha; }
	public function getHora() { return $this->hora; }
	public function getCantidad() { return $this->cantidad; }
	public function getConcepto() { return $this->concepto; }
	public function getPreciounitario() { return $this->preciounitario; }
	public function getDescuento() { return $this->descuento; }
	public function getImporte() { return $this->importe; }
	public function getStatus() { return $this->status; }
	public function getUsuario() { return $this->usuario; }
	public function getIdpedido() { return $this->idpedido; }
	public function getIdproducto() { return $this->idproducto; }
	public function setIdpartida($valor) { $this->idpartida= intval($valor); }
	public function setFecha($valor) { $this->fecha= "".$valor; }
	public function setHora($valor) { $this->hora= "".$valor; }
	public function setCantidad($valor) { $this->cantidad= intval($valor); }
	public function setConcepto($valor) { $this->concepto= "".$valor; }
	public function setPreciounitario($valor) { $this->preciounitario= "".$valor; }
	public function setDescuento($valor) { $this->descuento= "".$valor; }
	public function setImporte($valor) { $this->importe= "".$valor; }
	public function setStatus($valor) { $this->status= intval($valor); }
	public function setUsuario($valor) { $this->usuario= intval($valor); }
	public function setIdpedido($valor) { $this->idpedido= intval($valor); }
	public function setIdproducto($valor) { $this->idproducto= intval($valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idpartida==""||$this->idpartida==0)
		{
			if($id>0)
				$this->idpartida=$id;
			else
				return false;
		}
		$this->db->where('idpartida',$this->idpartida);
		$regs=$this->db->get('partida');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpartida($reg["idpartida"]);
		$this->setFecha($reg["fecha"]);
		$this->setHora($reg["hora"]);
		$this->setCantidad($reg["cantidad"]);
		$this->setConcepto($reg["concepto"]);
		$this->setPreciounitario($reg["preciounitario"]);
		$this->setDescuento($reg["descuento"]);
		$this->setImporte($reg["importe"]);
		$this->setStatus($reg["status"]);
		$this->db->where('idpartida',$this->idpartida);
		$regs=$this->db->get('relparusu');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setUsuario($reg["idusuario"]);
		}
		$this->db->where('idpartida',$this->idpartida);
		$regs=$this->db->get('relpedpar');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setIdpedido($reg["idpedido"]);
		}
		$this->db->where('idpartida',$this->idpartida);
		$regs=$this->db->get('relpropar');
		if($regs->num_rows()>0)
		{
			$reg=$regs->row_array();
			$this->setIdproducto($reg["idproducto"]);
		}
		return true;
	}
	public function getFromInput()
	{
		$this->setIdpartida($this->input->post("frm_partida_idpartida"));
		$this->setFecha($this->input->post("frm_partida_fecha"));
		$this->setHora($this->input->post("frm_partida_hora"));
		$this->setCantidad($this->input->post("frm_partida_cantidad"));
		$this->setConcepto($this->input->post("frm_partida_concepto"));
		$this->setPreciounitario($this->input->post("frm_partida_preciounitario"));
		$this->setDescuento($this->input->post("frm_partida_descuento"));
		$this->setImporte($this->input->post("frm_partida_importe"));
		$this->setStatus($this->input->post("frm_partida_status"));
		$this->setUsuario($this->input->post("frm_partida_usuario"));
		$this->setIdpedido($this->input->post("frm_partida_idpedido"));
		$this->setIdproducto($this->input->post("frm_partida_idproducto"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"fecha"=>$this->fecha,
			"hora"=>$this->hora,
			"cantidad"=>$this->cantidad,
			"concepto"=>$this->concepto,
			"preciounitario"=>$this->preciounitario,
			"descuento"=>$this->descuento,
			"importe"=>$this->importe,
			"status"=>$this->status
		);
		$this->db->insert('partida',$data);
		$this->setIdpartida($this->db->insert_id());
		$this->db->insert('relpedpar',array("idpartida"=>$this->idpartida,"idpedido"=>$this->idpedido));
		$this->db->insert('relparusu',array("idpartida"=>$this->idpartida,"idusuario"=>$this->usuario));
		$this->db->insert('relpropar',array("idpartida"=>$this->idpartida,"idproducto"=>$this->idproducto));
	}
	public function updateToDatabase($id=0)
	{
		if($this->idpartida==""||$this->idpartida==0)
		{
			if($id>0)
				$this->idpartida=$id;
			else
				return false;
		}
		$data=array(
			"fecha"=>$this->fecha,
			"hora"=>$this->hora,
			"cantidad"=>$this->cantidad,
			"concepto"=>$this->concepto,
			"preciounitario"=>$this->preciounitario,
			"descuento"=>$this->descuento,
			"importe"=>$this->importe,
			"status"=>$this->status
		);
		$this->db->where('idpartida',$this->idpartida);
		$this->db->update('partida',$data);
		return true;
	}
	public function getAll($idpedido=0)
	{
		if($idpedido>0)
			$this->db->where("idpartida in (select idpartida from relpedpar where idpedido = $idpedido)");
		$this->db->order_by('idpartida');
		$regs=$this->db->get('partida');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function delete($id=0)
	{
		if($this->idpartida==""||$this->idpartida==0)
		{
			if($id>0)
				$this->idpartida=$id;
			else
				return false;
		}
		$this->db->where('idpartida',$this->idpartida);
		$this->db->delete(array('relparusu','relpedpar','relpropar','partida'));
	}
	public function actualizaEstado()
	{
		if($this->idpartida==""||$this->idpartida==0)
		{
			if($id>0)
				$this->idpartida=$id;
			else
				return false;
		}
		$data=array(
			"status"=>$this->status,
			"fecha"=>$this->fecha,
			"hora"=>$this->hora
		);
		$this->db->where('idpartida',$this->idpartida);
		$this->db->update('partida',$data);
		return true;
	}
}
?>
