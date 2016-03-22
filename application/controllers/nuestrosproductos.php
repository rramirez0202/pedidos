<?php
class Nuestrosproductos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->model('modproducto');
		$this->load->model('modcatalogo');
		$catCategorias=$this->modcatalogo->getCatalogo(2);
		$catMarcas=$this->modcatalogo->getCatalogo(3);
		$xmlSplash=array();
		if(file_exists($this->config->item('catalogosplashxml')))
		{
			$xml=new DOMDocument();
			$xml->load($this->config->item('catalogosplashxml'));
			foreach($xml->getElementsByTagName("marca") as $marca)
			{
				$titlepicture=$marca->getAttribute("titlepicture")!=""?"./project_files/img/catalogo/marcas/".$marca->getAttribute("titlepicture"):"";
				if(!file_exists($titlepicture))
					$titlepicture="";
				$bodypicture=$marca->getAttribute("bodypicture")!=""?"./project_files/img/catalogo/marcas_collage/".$marca->getAttribute("bodypicture"):"";
				if(!file_exists($bodypicture))
					$bodypicture="";
				$informativename=$marca->getAttribute("informativename");
				$xmlSplash[intval($marca->getAttribute("id"))]=array(
					"display"			=> strtolower($marca->getAttribute("display"))==="true",
					"displaytitle"		=> strtolower($marca->getAttribute("displaytitle"))==="true",
					"displaybody"		=> strtolower($marca->getAttribute("displaybody"))==="true",
					"titlepicture"		=> $titlepicture,
					"bodypicture"		=> $bodypicture,
					"informativename"	=> $informativename
				);
			}
		}
		$data=array();
		foreach($catCategorias["opciones"] as $cat)
		{
			$categoria=array("descripcion"=>$cat["descripcion"],"id"=>$cat["idcatalogodet"],"marcas"=>array());
			foreach($catMarcas["opciones"] as $mar)
			{
				if(!isset($xmlSplash[$mar["idcatalogodet"]])||$xmlSplash[$mar["idcatalogodet"]]["display"]!==true)
					continue;
				$prods=$this->modproducto->catalogoproductos($cat["idcatalogodet"],$mar["idcatalogodet"]);
				if($prods!==false && count($prods)>0)
				{
					array_push($categoria["marcas"],array(
						"descripcion"=>$mar["descripcion"],
						"id"=>$mar["idcatalogodet"],
						"prods"=>$prods,
						"displaytitle"		=> $xmlSplash[$mar["idcatalogodet"]]["displaytitle"],
						"displaybody"		=> $xmlSplash[$mar["idcatalogodet"]]["displaybody"],
						"titlepicture"		=> $xmlSplash[$mar["idcatalogodet"]]["titlepicture"],
						"bodypicture"		=> $xmlSplash[$mar["idcatalogodet"]]["bodypicture"],
						"informativename"	=> $xmlSplash[$mar["idcatalogodet"]]["informativename"]
						));
				}
			}
			if(count($categoria["marcas"])>0)
			{
				array_push($data,$categoria);
			}
		}
		$this->load->view('nuestrosproductos/index',array("data"=>$data));
	}
}
?>
