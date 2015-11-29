<?php
class ModLog extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function addLog($accion,$objetoid,$objetonombre,$tablabase,$tablasreferencia,$usuarioid,$usuario,$usuarionombre)
	{
		$data=array(
			"accion"=>$accion,
			"objetoid"=>$objetoid,
			"objetonombre"=>$objetonombre,
			"tablabase"=>$tablabase,
			"tablasreferencia"=>$tablasreferencia,
			"usuarioid"=>$usuarioid,
			"usuario"=>$usuario,
			"usuarionombre"=>$usuarionombre
		);
		$this->db->insert('log',$data);
		return $this->db->insert_id();
	}
}
?>