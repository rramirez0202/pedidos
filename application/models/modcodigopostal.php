<?php
class Modcodigopostal extends CI_Model
{
	private $cp;
	private $asentamiento;
	private $municipio;
	private $estado;
	public function __construct()
	{
		parent::__construct();
		$this->cp="";
		$this->asentamiento="";
		$this->municipio="";
		$this->estado="";
	}
	public function getCp() { return $this->cp; }
	public function getAsentamiento() { return $this->asentamiento; }
	public function getMunicipio() { return $this->municipio; }
	public function getEstado() { return $this->estado; }
	public function setCp($valor) { $this->cp= "".$valor; }
	public function setAsentamiento($valor) { $this->asentamiento= "".$valor; }
	public function setMunicipio($valor) { $this->municipio= "".$valor; }
	public function setEstado($valor) { $this->estado= "".$valor; }
	public function getFromDatabase($cp="",$asentamiento="",$municipio="",$estado="")
	{
		$cp=($cp===false?"":$cp);
		$asentamiento=($asentamiento===false?"":$asentamiento);
		$municipio=($municipio===false?"":$municipio);
		$estado=($estado===false?"":$estado);
		if($cp=="" && $asentamiento=="" && $municipio=="" && $estado=="")
			return false;
		$whr="";
		if($cp!="")
			$whr.=($whr!=""?" and ":"")."cp like '%$cp%'";
		if($asentamiento!="")
			$whr.=($whr!=""?" and ":"")."asentamiento like '%$asentamiento%'";
		if($municipio!="")
			$whr.=($whr!=""?" and ":"")."municipio like '%$municipio%'";
		if($estado!="")
			$whr.=($whr!=""?" and ":"")."estado like '%$estado%'";
		$this->db->where($whr);
		$regs=$this->db->get('codigospostales');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setCp($reg["cp"]);
		$this->setAsentamiento($reg["asentamiento"]);
		$this->setMunicipio($reg["municipio"]);
		$this->setEstado($reg["estado"]);
		return $regs->result_array();
	}
	public function getFromInput()
	{
		$this->setCp($this->input->post("frm_codigospostales_cp"));
		$this->setAsentamiento($this->input->post("frm_codigospostales_asentamiento"));
		$this->setMunicipio($this->input->post("frm_codigospostales_municipio"));
		$this->setEstado($this->input->post("frm_codigospostales_estado"));
	}
	public function addToDatabase()
	{
		$data=array(
			"cp"=>$this->cp,
			"asentamiento"=>$this->asentamiento,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado
		);
	}
}
?>