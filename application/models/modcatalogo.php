<?php
class Modcatalogo extends CI_Model
{
	public function getCatalogo($idCatalogo)
	{
		$this->db->where('idcatalogo',$idCatalogo);
		$regs=$this->db->get('catalogo');
		if($regs->num_rows()>0)
		{
			$res=$regs->row_array();
			$this->db->where("idcatalogodet in (select idopcion from relcatcatdet where idcatalogo = $idCatalogo)");
			$this->db->order_by('descripcion');
			$regs=$this->db->get('catalogodet');
			if($regs->num_rows()>0) $res["opciones"]=$regs->result_array();
			else $res["opciones"]=array();
			return $res;
		}
		return false;
	}
	public function getAll()
	{
		$this->db->order_by('descripcion');
		$regs=$this->db->get('catalogo');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function addNewCatalog($nombre)
	{
		$this->db->insert('catalogo',array('descripcion'=>$nombre));
		return $this->db->insert_id();
	}
	public function updateCatalog($idcatalogo,$nombre)
	{
		$this->db->where('idcatalogo',$idcatalogo);
		$this->db->update('catalogo',array('descripcion'=>$nombre));
		return $idcatalogo;
	}
	public function addNewOption($idcatalogo,$nombre)
	{
		$this->db->insert('catalogodet',array("descripcion"=>$nombre));
		$id=$this->db->insert_id();
		$this->db->insert('relcatcatdet',array(
			'idcatalogo'=>$idcatalogo,
			'idopcion'=>$id
		));
		return true;
	}
	public function deleteOption($idopcion)
	{
		$this->db->where('idopcion',$idopcion);
		$this->db->delete('relcatcatdet');
	}
	public function getIdOption($idCatalogo,$opcion)
	{
		$this->db->where("descripcion = '$opcion' and idcatalogodet in (select idopcion from relcatcatdet where idcatalogo = $idCatalogo)");
		$regs=$this->db->get('catalogodet');
		if($regs->num_rows()>0)
			return $regs->result_array()[0]["idcatalogodet"];
		return false;
	}
}
?>
