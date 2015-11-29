<?php
class Modflujo extends CI_Model
{
	public function getEstadoInicial($idflujo)
	{
		$this->db->where("inicial = 1 and idestado in (select idestadoinicial from flujodetalle where idflujo = $idflujo)");
		$regs=$this->db->get("estado");
		if($regs->num_rows()>0)
			return $regs->row_array();
		return false;
	}
	public function getAcciones($idflujo,$idEstadoInicial=0)
	{
		if($idEstadoInicial==0||$idEstadoInicial=="")
			$idEstadoInicial=$this->getEstadoInicial($idflujo)["idestado"];
		$this->db->where("idaccion in (select idaccion from flujodetalle where idflujo = $idflujo and idestadoinicial = $idEstadoInicial)");
		$this->db->order_by("nombre");
		$regs=$this->db->get("accion");
		if($regs->num_rows()>0)
			return $regs->result_array();
		return false;
	}
	public function getEstadoSiguiente($idflujo,$idEstadoActual,$idAccion)
	{
		$this->db->where("idestado in (select idestadofinal from flujodetalle where idflujo = $idflujo and idestadoinicial = $idEstadoActual and idaccion = $idAccion)");
		$regs=$this->db->get("estado");
		if($regs->num_rows()>0)
			return $regs->row_array();
		return false;
	}
	public function getEstado($idEstado)
	{
		$this->db->where('idestado',$idEstado);
		$regs=$this->db->get("estado");
		if($regs->num_rows()>0)
			return $regs->row_array();
		return false;
	}
	public function getEstados($idflujo)
	{
		$this->db->where("idestado in (select idestadoinicial from flujodetalle where idflujo = $idflujo ) or idestado in (select idestadofinal from flujodetalle where idflujo = $idflujo )");
		$this->db->order_by("nombre");
		$regs=$this->db->get("estado");
		if($regs->num_rows()>0)
			return $regs->result_array();
		return false;
	}
}
?>
