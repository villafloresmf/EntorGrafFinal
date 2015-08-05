<?php
namespace ECinema\Negocio {
	include_once ('EntidadLogica.php');
	include_once ('CrossCutting/ArrayCollection.php');
	include_once ('Contenido.php');
 	use ECinema\CrossCutting\ArrayCollection;
	use ECinema\Datos\Contenido;
    use ECinema\Datos\TipoContenido;
use ECinema\CrossCutting\ECinema\CrossCutting;
			
	class ContenidoLogica extends EntidadLogica {
		
		public function __construct(){
			$params = func_get_args();
			$num_params = func_num_args();
			//atendiendo al siguiente modelo __construct1() __construct2()...
			$funcion_constructor ='__construct'.$num_params;
			//compruebo si hay un constructor con ese número de parámetros
			if (method_exists($this,$funcion_constructor)) {
				call_user_func_array(array($this,$funcion_constructor),$params);
			}
		}
		
// 		public function __call($metodo, $parametros)
// 		{	if (method_exists($this, $metodo.sizeof($parametros))) {
// 				return call_user_func_array(array($this, $metodo.sizeof($parametros)), $parametros);
// 			}
// 			// Si la Funcion no Existe
// 			throw new Exception('Metodo Desconocido: '.get_class($this).'::'.$metodo);
// 		}
	
 		public function __construct1(/* TipoContenido */ $tipo)
 		{
// 			super(new java.Datos.Contenido($tipo));
			$contenido =  new Contenido($tipo);
 			parent::__construct1($contenido);
 		}
	
// 		protected function __construct(/* Contenido */ $contenido)
// 		{
// // 			super($contenido);
// 			parent::__construct($contenidos);
// 		}
	
		public function __construct2(/* TipoContenido */ $tipo,/* Contenido */ $parentcontent)
		{
			try {
 				if (is_null($tipo)){
 					$contenidos = $parentcontent;
 					parent::__construct1($contenidos);
 				} else {
// 	 				super(new java.Datos.Contenido($tipo, $parentcontent));
					$contenido = new Contenido($tipo, $parentcontent);
					parent::__construct1($contenido);
 				}
			} catch (\Exception $e) {
				throw $e;
			}			
		}
	
		protected $nombre;
	
		public function getNombre() {
			return $this->nombre;
		}
	
		//string
		public function setNombre($nombre) {
			$this->nombre = $nombre;
		}
	
		protected $nombre_capitulo;
	
		public function getNombreCapitulo() {
			return $this->nombre_capitulo;
		}
	
		//string
		public function setNombreCapitulo($Nombre) {
			$this->nombre_capitulo = $Nombre;
		}
	
		// String
		protected $sinopsis;
	
		public function getSinopsis() {
			return $this->sinopsis;
		}
	
		//String
		public function setSinopsis($sinopsis) {
			$this->sinopsis = $sinopsis;
		}
		
		//int
		protected $duracion;
	
		public function getDuracion() {
			return $this->duracion;
		}
	
		//int
		public function setDuracion($duracion) {
			$this->duracion = $duracion;
		}
	
		//String
		protected $actores;
	
		public function getActores() {
			return $this->actores;
		}
	
		//String
		public function setActores($actores) {
			$this->actores = $actores;
		}
	
		//String
		protected $imagen;
	
		public function getImagen() {
			return $this->imagen;
		}
	
		//String
		public function setImagen($imagen) {
			$this->imagen = $imagen;
		}
	
		//String
		protected $trailer;
	
		public function getTrailer() {
			return $this->trailer;
		}
	
		//String
		public function setTrailer($trailer) {
			$this->trailer = $trailer;
		}
	
		//Contenido.TipoContenido
		public function getTipo() {
// 			$tipoContenido = (Contenido) $this->datosEntidad;
			$tipoContenido = $this->datosEntidad;
			return $tipoContenido->getTipo();
		}
	
		//Date
		protected $FechaEstreno;
	
		public function getFechaEstreno() {
			return $this->FechaEstreno;
		}
	
		//Date
		public function setFechaEstreno($FechaEstreno)
		{
			$this->FechaEstreno = $FechaEstreno;
		}
	
		//String
		protected $url;
	
		public function getUrl() {
			return $this->url;
		}
	
		//String
		public function setUrl($url) {
			$this->url = $url;
		}
	
		//Collection<CategoriaLogica> 
		protected $categorias;
	
		public function getCategorias() {
			//cargar categorias en modo lazy
//-------->Revisa Esto.			
// 			Contenido $contenido = (Contenido) $this->datosEntidad;
			$contenido = $this->datosEntidad;
			if ( is_null($this->categorias)  && !$contenido->getCategorias()->isEmpty()) {
				$this->setCategoriasID($contenido->getCategorias());
			}
			return $this->categorias;
		}
	
		//Collection<CategoriaLogica>
		public function setCategorias($categorias)
		{
			$this->categorias = $categorias;
		}
	
		//Collection<Integer>
		public function setCategoriasID($ids) {
			if (isset($ids)) {
				$this->categorias = CategoriaLogica::GetAllByIds($ids);
			}
		}
	
		//Collection<Integer>
		private function getCategoriasId()
		{
// 			Collection<Integer> categoriasIds = new ArrayList<Integer>();
			$categoriasIds = new ArrayCollection();
			if (isset($this->categorias))
			{
				//for (CategoriaLogica cat: categorias)
				foreach ($this->categorias as $categoriaLogica)
				{
					$categoriasIds->add($categoriaLogica->getID());
				}
			}
			return $categoriasIds;
		}
	
		
		protected function validarGeneral() 
		{
			try {
				if (is_null($this->nombre) || empty($this->nombre))
				{
					throw new Exception("El Contenido debe tener un nombre\n");
				}
				if (is_null($this->sinopsis)|| empty($this->sinopsis))
				{
					throw new Exception("El Contenido debe tener una sinopsis\n");
				}
				if (is_null($this->actores)|| empty($this->actores))
				{
					throw new Exception("El Contenido debe tener los actores\n");
				}
				if (is_null($this->url)|| empty($this->url))
				{
					throw new Exception("El Contenido debe tener una url\n");
				}
				
/* 				if (!$this->check_url($this->url))
				{
					throw new Exception("El Contenido debe tener una url valida\n");
				} */
				
				if (is_null($this->imagen) || empty($this->imagen))
				{
					throw new Exception("El Contenido debe tener una imagen\n");
				}
				
// 				if (!check_url($this->imagen))
// 				{
// 					throw new Exception("El Contenido debe tener una url de imagen valida\n");
// 				}
				
// 				if (isset($this->trailer) && !empty($this->trailer)){
// 					if (!check_url($this->trailer))
// 					{
// 						throw new Exception("El Contenido debe tener una url de trailer valida\n");
// 					}
// 				}
			} catch (\Exception $e) {
				throw $e;
			}
		}
	
		// boolean
		private function check_url($url)
		{
// 			return $url->matches("^(https?|ftp|file)://[-a-zA-Z0-9+&@#/%?=~_|!:,.;]*[-a-zA-Z0-9+&@#/%=~_|]");
			return preg_match("/^(https?|ftp|file)://[-a-zA-Z0-9+&@#/%?=~_|!:,.;]*[-a-zA-Z0-9+&@#/%=~_|]$/",$url);
		}
	
		//@Override
		protected function validarNuevo() {
			try {
				if ($this->getTipo() == TipoContenido::PELICULA) {
					$contenido = Contenido::GetOneByName($this->nombre);
					if (isset($contenido) /*!= null*/) {
						throw new \Exception("El Contenido ya existe\n");
					}
				} else {
// 					Contenido cont = Contenido.GetOne($this->nombre);
					$contenido = Contenido::GetOneByName($this->nombre);
					if (isset($contenido) /* != null */) {
// 						Collection<Contenido> capitulos = Contenido.getAll($contenido.getID());
						$capitulos = Contenido::getAllByIdContenido($contenido->getID());
						//for (Contenido cap : capitulos) {
						foreach ($capitulos as $cap) {		
// 							if ($cap->getNombreCapitulo().equalsIgnoreCase($this->getNombreCapitulo()) && $this->getID() != $contenido->getID()) {
							if ((strcasecmp($cap->getNombreCapitulo(),$this->getNombreCapitulo()) == 0) && $this->getID() != $contenido->getID()) {
								throw new \Exception("El Contenido ya existe\n");
							}
						}
					}
				}	
			} catch (\Exception $e) {
				throw $e;
			}			
		}
	
		//
		public static function Buscar(/*int*/ $id_contenido)
		{
// 			ContenidoLogica cl = null;
			$cl = null;
// 			Contenido datosentidad = Contenido.GetOne($id_contenido);
			$datosentidad = Contenido::GetOne($id_contenido);
			if (isset($datosentidad))
			{
// 				$cl = new ContenidoLogica($datosentidad);
				$cl = new ContenidoLogica(null,$datosentidad);
			}
			return $cl;
		}
	
// 		@Override
		protected function actualizar()
		{
 			/* Contenido */ $datacont = /*(Contenido)*/ $this->datosEntidad;
//---------> Mira esto.
			//$datacont = (Contenido) $this->datosEntidad;
			$datacont->setID($this->getID());
			$datacont->setNombre($this->getNombre());
			$datacont->setNombreCapitulo($this->getNombreCapitulo());
			$datacont->setSinopsis($this->getSinopsis());
			$datacont->setActores($this->getActores());
			$datacont->setDuracion($this->getDuracion());
			$datacont->setFechaEstreno($this->getFechaEstreno());
			$datacont->setImagen1($this->getImagen());
			$datacont->setTrailer1($this->getTrailer());
			$datacont->setUrl($this->getUrl());
			$datacont->setCategorias($this->getCategoriasId());
		}
	
// 		@Override
		protected function refrescar()
		{
			//Contenido datacont = (Contenido) $this->datosentidad;
			//$datacont = (Contenido) $this->datosentidad;
			$datacont = $this->datosEntidad;
			$this->ID = $datacont->getID();
			$this->nombre = $datacont->getNombre();
			$this->nombre_capitulo = $datacont->getNombreCapitulo();
			$this->sinopsis = $datacont->getSinopsis();
			$this->actores = $datacont->getActores();
			$this->duracion = $datacont->getDuracion();
			$this->FechaEstreno = $datacont->getFechaEstreno();
			$this->imagen = $datacont->getImagen();
			$this->trailer = $datacont->getTrailer();
			$this->url = $datacont->getUrl();
			if (isset($this->categorias)) {
				$this->setCategoriasID($datacont->getCategorias());
			}
		}
		
		public function ConvertEntityToJSON(){
			$jsonObj = json_encode($this->datosEntidad);
			
			$categoriaLogica = new CategoriaLogica();
			$jsonCats = $categoriaLogica->ConvertListToJSONList($this->getCategorias());
			
			$jsonObj = str_replace("[]",$jsonCats,$jsonObj);
			
			return $jsonObj;
		}
		
		public static function ConvertListToJSon($results){
			$jSonList = "[";
			foreach ($results as $rs){
				$jSonList .= $rs->ConvertEntityToJSON() . ",";
			}
			$jSonList .= "]";
			return $jSonList;
		}
		
		public static function JsonListIDsAndDescription($results){
			$jSonList = "[";
			foreach ($results as $rs){
				$jSonList .= json_encode(["ID" => $rs->ID, "Description" => $rs->getNombre()]) . ",";
			}
			$jSonList = substr($jSonList, 0,-1) . "]";
			return $jSonList;
		}
	}
}
?>