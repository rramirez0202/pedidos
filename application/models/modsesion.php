<?php
class Modsesion extends CI_Model
{
	private $perfiles;
	public function __construct()
	{
		parent::__construct();
		$perfiles=array();
	}
	public function getAcceso($usr,$pwd)
	{
		$pwd=$this->encrypt->sha1($pwd);
		$this->db->where(array("usuario"=>$usr,"password"=>$pwd,"activo"=>1));
		$regs=$this->db->get('usuario');
		if($regs->num_rows()==0)
			return false;
		return $regs->row_array();
	}
	public function getdata($usr)
	{
		$this->db->where(array("usuario"=>$usr,"activo"=>1));
		$regs=$this->db->get('usuario');
		if($regs->num_rows()==0)
			return false;
		return $regs->row_array();
	}
	public function logedin()
	{
		$insession=(!($this->session->userdata('idusuario')===false));
		if($insession)
		{
			$this->getPerfiles();
		}
		return $insession;
	}
	private function getPerfiles()
	{
		$this->load->model('modusuario');
		$this->load->model('modperfil');
		$this->load->model('modpermiso');
		$musuario=new Modusuario();
		$musuario->getFromDatabase($this->session->userdata('idusuario'));
		$this->perfiles=array();
		foreach($musuario->getPerfiles() as $perf)
		{
			$perfil=new Modperfil();
			$perfil->getFromDatabase($perf);
			array_push($this->perfiles,array(
				"idperfil"		=> $perf,
				"permisos"		=> $perfil->getPermisos()
			));
		}
	}
	public function hasPermiso($idpermiso)
	{
		if(!is_array($idpermiso))
			$idpermiso=array($idpermiso);
		foreach($idpermiso as $perm)
			foreach($this->perfiles as $perf)
			{
				if(in_array($perm,$perf["permisos"]))
					return true;
			}
		return false;
	}
	public function hasPermisoHijo($idpermiso)
	{
		return $this->hasPermiso(explode(",",$this->permisosHijo($idpermiso)));
	}
	private function permisosHijo($idpermiso)
	{
		$permisos=$idpermiso."";
		$this->load->model('modpermiso');
		$permiso=new Modpermiso();
		$permiso->getFromDatabase($idpermiso);
		if($permiso->getPermisoshijo()!==false)
			foreach($permiso->getPermisoshijo() as $p)
				$permisos.=",".$this->permisosHijo($p);
		return $permisos;
	}
	public function addLog($accion,$objetoid,$objetonombre,$tablabase,$tablasreferencia)
	{
		$this->load->model('modlog');
		$this->modlog->addLog(
			$accion,
			$objetoid,
			$objetonombre,
			$tablabase,
			$tablasreferencia,
			$this->session->userdata('idusuario')!==false?$this->session->userdata('idusuario'):"",
			$this->session->userdata('datausr')!==false?$this->session->userdata('datausr')["usuario"]:"",
			$this->session->userdata('datausr')!==false?$this->session->userdata('datausr')["nombre"]." ".$this->session->userdata('datausr')["apaterno"]:""
			);
	}
	public function getPerfil($idPerfil)
	{
		foreach($this->perfiles as $p)
		{
			if($p["idperfil"]==$idPerfil)
				return $p;
		}
		return false;
	}
}
?>