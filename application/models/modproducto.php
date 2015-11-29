<?php
class Modproducto extends CI_Model
{
	private $idproducto;
	private $nombre;
	private $descripcion;
	private $observaciones;
	private $precio;
	private $fechacarga;
	private $horacarga;
	private $fechaactualizacion;
	private $horaactualizacion;
	private $idwinapp;
	private $imagen;
	private $activo;
	public function __construct()
	{
		parent::__construct();
		$this->Inicializar();
	}
	public function getIdproducto() { return $this->idproducto; }
	public function getNombre() { return $this->nombre; }
	public function getDescripcion() { return $this->descripcion; }
	public function getObservaciones() { return $this->observaciones; }
	public function getPrecio() { return $this->precio; }
	public function getFechacarga() { return $this->fechacarga; }
	public function getHoracarga() { return $this->horacarga; }
	public function getFechaactualizacion() { return $this->fechaactualizacion; }
	public function getHoraactualizacion() { return $this->horaactualizacion; }
	public function getIdwinapp() { return $this->idwinapp; }
	public function getImagen() { return $this->imagen; }
	public function getActivo() { return $this->activo; }
	public function setIdproducto($valor) { $this->idproducto= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setDescripcion($valor) { $this->descripcion= "".$valor; }
	public function setObservaciones($valor) { $this->observaciones= "".$valor; }
	public function setPrecio($valor) { $this->precio= "".$valor; }
	public function setFechacarga($valor) { $this->fechacarga= "".$valor; }
	public function setHoracarga($valor) { $this->horacarga= "".$valor; }
	public function setFechaactualizacion($valor) { $this->fechaactualizacion= "".$valor; }
	public function setHoraactualizacion($valor) { $this->horaactualizacion= "".$valor; }
	public function setIdwinapp($valor) { $this->idwinapp= "".$valor; }
	public function setImagen($valor) { $this->imagen= "".$valor; }
	public function setActivo($valor) { $this->activo= intval($valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idproducto==""||$this->idproducto==0)
		{
			if($id>0)
				$this->idproducto=$id;
			else
				return false;
		}
		$this->db->where('idproducto',$this->idproducto);
		$regs=$this->db->get('producto');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setNombre($reg["nombre"]);
		$this->setDescripcion($reg["descripcion"]);
		$this->setObservaciones($reg["observaciones"]);
		$this->setPrecio($reg["precio"]);
		$this->setFechacarga($reg["fechacarga"]);
		$this->setHoracarga($reg["horacarga"]);
		$this->setFechaactualizacion($reg["fechaactualizacion"]);
		$this->setHoraactualizacion($reg["horaactualizacion"]);
		$this->setIdwinapp($reg["idwinapp"]);
		$this->setImagen($reg["imagen"]);
		$this->setActivo($reg["activo"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdproducto($this->input->post("frm_producto_idproducto"));
		$this->setNombre($this->input->post("frm_producto_nombre"));
		$this->setDescripcion($this->input->post("frm_producto_descripcion"));
		$this->setObservaciones($this->input->post("frm_producto_observaciones"));
		$this->setPrecio($this->input->post("frm_producto_precio"));
		$this->setFechacarga($this->input->post("frm_producto_fechacarga"));
		$this->setHoracarga($this->input->post("frm_producto_horacarga"));
		$this->setFechaactualizacion($this->input->post("frm_producto_fechaactualizacion"));
		$this->setHoraactualizacion($this->input->post("frm_producto_horaactualizacion"));
		$this->setIdwinapp($this->input->post("frm_producto_idwinapp"));
		$this->setActivo($this->input->post("frm_producto_activo"));
		$this->setImagen($this->input->post("frm_producto_imagen"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"observaciones"=>$this->observaciones,
			"precio"=>$this->precio,
			"fechacarga"=>$this->fechacarga,
			"horacarga"=>$this->horacarga,
			"fechaactualizacion"=>$this->fechaactualizacion,
			"horaactualizacion"=>$this->horaactualizacion,
			"idwinapp"=>$this->idwinapp,
			"imagen"=>$this->imagen,
			"activo"=>$this->activo
		);
		$this->db->insert('producto',$data);
		$this->setIdproducto($this->db->insert_id());
	}
	public function updateToDatabase($id=0)
	{
		if($this->idproducto==""||$this->idproducto==0)
		{
			if($id>0)
				$this->idproducto=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"observaciones"=>$this->observaciones,
			"precio"=>$this->precio,
			"fechaactualizacion"=>$this->fechaactualizacion,
			"horaactualizacion"=>$this->horaactualizacion,
			"idwinapp"=>$this->idwinapp,
			"imagen"=>$this->imagen,
			"activo"=>$this->activo
		);
		$this->db->where('idproducto',$this->idproducto);
		$this->db->update('producto',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('nombre');
		$regs=$this->db->get('producto');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	public function delete($id=0)
	{
		if($this->idproducto==""||$this->idproducto==0)
		{
			if($id>0)
				$this->idproducto=$id;
			else
				return false;
		}
		$this->db->where('idproducto',$this->idproducto);
		$this->db->delete(array('relpropar','producto'));
	}
	public function getIdFromIdWinApp($idWinApp)
	{
		$this->db->where('idwinapp',$idWinApp);
		$regs=$this->db->get('producto');
		if($regs->num_rows()==0)
			return 0;
		return intval($regs->row_array()["idproducto"]);
	}
	public function Inicializar()
	{
		$this->idproducto=0;
		$this->nombre="";
		$this->descripcion="";
		$this->observaciones="";
		$this->precio="";
		$this->fechacarga="";
		$this->horacarga="";
		$this->fechaactualizacion="";
		$this->horaactualizacion="";
		$this->idwinapp="";
		$this->imagen="";
		$this->activo=0;
	}
}
?>
