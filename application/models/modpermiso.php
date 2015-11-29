<?php
class Modpermiso extends CI_Model
{
	private $idpermiso;
	private $nombre;
	private $descripcion;
	private $permisopadre;
	private $permisoshijo;
	public function __construct()
	{
		parent::__construct();
		$this->idpermiso=0;
		$this->nombre="";
		$this->descripcion="";
		$this->permisopadre=0;
		$this->permisoshijo=array();
	}
	public function getIdpermiso() { return $this->idpermiso; }
	public function getNombre() { return $this->nombre; }
	public function getDescripcion() { return $this->descripcion; }
	public function getPermisopadre() { return $this->permisopadre; }
	public function getPermisoshijo() { return $this->permisoshijo; }
	public function setIdpermiso($valor) { $this->idpermiso= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setDescripcion($valor) { $this->descripcion= "".$valor; }
	public function setPermisopadre($valor) { $this->permisopadre= intval($valor); }
	public function setPermisoshijo($valor) { if(is_array($valor)) $this->permisoshijo=$valor; else array_push($this->permisoshijo,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idpermiso==""||$this->idpermiso==0)
		{
			if($id>0)
				$this->idpermiso=$id;
			else
				return false;
		}
		$this->db->where('idpermiso',$this->idpermiso);
		$regs=$this->db->get('permiso');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpermiso($reg["idpermiso"]);
		$this->setNombre($reg["nombre"]);
		$this->setDescripcion($reg["descripcion"]);
		$this->setPermisopadre($reg["permisopadre"]);
		$this->db->where('permisopadre',$this->idpermiso);
		$regs=$this->db->get('permiso');
		if($regs->num_rows()>0)
		{
			$regs=$regs->result_array();
			foreach($regs as $reg)
				$this->setPermisoshijo($reg["idpermiso"]);
		}
		else $this->setPermisoshijo(array());
		return true;
	}
	public function getFromInput()
	{
		$this->setIdpermiso($this->input->post("frm_permiso_idpermiso"));
		$this->setNombre($this->input->post("frm_permiso_nombre"));
		$this->setDescripcion($this->input->post("frm_permiso_descripcion"));
		$this->setPermisopadre($this->input->post("frm_permiso_permisopadre"));
		$this->setPermisoshijo(explode(",",$this->input->post("frm_permiso_permisoshijo")));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"permisopadre"=>$this->permisopadre
		);
		$this->db->insert('permiso',$data);
		$this->setIdpermiso($this->db->insert_id());
	}
	public function updateToDatabase($id=0)
	{
		if($this->idpermiso==""||$this->idpermiso==0)
		{
			if($id>0)
				$this->idpermiso=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"permisopadre"=>$this->permisopadre
		);
		$this->db->where('idpermiso',$this->idpermiso);
		$this->db->update('permiso',$data);
		return true;
	}
	public function getAll($soloPermisosRaiz=true)
	{
		if($soloPermisosRaiz)
			$this->db->where('permisopadre',0);
		$this->db->order_by('idpermiso');
		$regs=$this->db->get('permiso');
		if($regs->num_rows()==0)
			return false;
		$regs=$regs->result_array();
		foreach($regs as $k=>$v)
			$regs[$k]["hijos"]=array();
		return $regs;
	}
	public function getHijos($idPermisoPadre,$solonivel1=false)
	{
		$this->db->where('permisopadre',$idPermisoPadre);
		$this->db->order_by('idpermiso');
		$regs=$this->db->get('permiso');
		if($regs->num_rows()==0)
			return false;
		$regs=$regs->result_array();
		foreach($regs as $k=>$v)
			$regs[$k]["hijos"]=array();
		if($solonivel1)
			return $regs;
		foreach($regs as $k=>$v)
			$regs[$k]["hijos"]=$this->getHijos($v["idpermiso"]);
		return $regs;
	}
	public function getAllStructured()
	{
		$raiz=$this->getAll();
		if($raiz===false)
			return false;
		foreach($raiz as $k=>$v)
			$raiz[$k]["hijos"]=$this->getHijos($v["idpermiso"]);
		return $raiz;
	}
	public function delete($id=0)
	{
		if($this->idpermiso==""||$this->idpermiso==0)
		{
			if($id>0)
				$this->idpermiso=$id;
			else
				return false;
		}
		$this->getFromDatabase();
		$currentId=$this->idpermiso;
		if(count($this->getPermisoshijo())>0)
		{
			$ph=new Modpermiso();
			foreach($this->getPermisoshijo() as $reg)
			{
				$ph->setIdpermiso($reg);
				$ph->delete();
			}
		}
		$this->db->where('idpermiso',$currentId);
		$this->db->delete(array('relpermperf','permiso'));
	}
	public function addPermiso($nombre,$descripcion,$permisopadre)
	{
		$data=array(
			"nombre"=>$nombre,
			"descripcion"=>$descripcion,
			"permisopadre"=>$permisopadre
		);
		$this->db->insert('permiso',$data);
		return $this->db->insert_id();
	}
}
?>