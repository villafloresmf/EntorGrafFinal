<?php
namespace ECinema\Negocio {
	include_once ('ContenidoLogica.php');
	include_once ('TipoContenido.php');
	include_once ('Contenido.php');
	use ECinema\Datos\TipoContenido;
	use ECinema\Datos\Contenido;
	use ECinema\CrossCutting\ArrayCollection;
	
	class SerieLogica extends ContenidoLogica {

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
		
// 		public function SerieLogica() {
		public function __construct0(){
// 			super(TipoContenido.SERIE);
			parent::__construct1(TipoContenido::SERIE);
		}
		
// 		private function SerieLogica(Contenido datosentidad)
		public function __construct1($datosentidad)
		{
// 			super(datosentidad);
			parent::__construct2(null, $datosentidad);
		}
		
		
		/**
		 * Crea una nueva serie usando la informacion de parent para llenar los
		 * datos comunes
		 *
		 * @param parent
		 * @throws Exception: en caso de que el contenido no sea valido
		 */
// 		public SerieLogica(SerieLogica parent) throws Exception {
		public function SerieLogica($parent) 
		{
			try {
// 				super(TipoContenido.SERIE, (Contenido) $parent->datosentidad);
				parent::__construct2(TipoContenido::SERIE, $parent->datosentidad);
			} catch (\Exception $e) {
				throw $e;
			}
		}
		
		
// 		public Contenido.TipoContenido getTipo() {
		public function getTipo() {	
			return TipoContenido.SERIE;
		}
		
// 		static public SerieLogica Buscar(int id_contenido)
		static public function Buscar($id_contenido)
		{
// 			SerieLogica 
			$serieLogica = null;
// 			Contenido 
			$datosentidad = Contenido::GetOne($id_contenido);
			if (isset($datosentidad))
			{
				if ($datosentidad->getTipo() == TipoContenido::SERIE){
					$serieLogica = new SerieLogica(/*(Contenido)*/ $datosentidad);
				}
			}
			return $serieLogica;
		}
		
// 		static public Collection<SerieLogica> GetAll()
		static public function GetAll()
		{
// 			Collection<Contenido> 
			$contenidos = Contenido::getAllByTipoContenido(TipoContenido::SERIE);
			return self::WrapContenidoList($contenidos);
		}
		
// 		static public Collection<SerieLogica> GetAll(String prefix)
		static public function GetAllByString($prefix)
		{
// 			Collection<Contenido> 
			$contenidos = Contenido::getAllByTipoYPrefix(TipoContenido::SERIE, prefix);
			return self::WrapContenidoList($contenidos);
		}
		
// 		static public Collection<SerieLogica> GetAll(int id_categoria)
		static public function GetAllByCategoria($id_categoria)
		{
// 			Collection<Contenido> 
			$contenidos = Contenido::getAllByTipoYIDCategoria(TipoContenido::SERIE, $id_categoria);
			return self::WrapContenidoList($contenidos);
		}
		
		/**
		 * devuelve una lista de las ultimas series estrenadas
		 * @param fecha_limite: fecha a partir de donde se buscan extrenos.
		 * @param limit: cantidad maxima a buscar
		 * @return
		 */
// 		static public Collection<SerieLogica> GetAll(Date fecha_limite, int limit)
		static public function GetAllByFecha($fecha_limite, $limit)
		{
// 			Collection<Contenido> 
			$contenidos = Contenido::getAllByTipoContenidoYFecha(TipoContenido::SERIE, $fecha_limite, $limit);
			return self::WrapContenidoList($contenidos);
		}
		
// 		static public Collection<SerieLogica> GetCapitulos(int id_contenido)
		static public function GetCapitulos($id_contenido)
		{
// 			Collection<Contenido> 
			$contenidos = Contenido::getAllByIdContenido($id_contenido);
			return self::WrapContenidoList($contenidos);
		}
		
// 		static public Collection<SerieLogica> WrapContenidoList(Collection<Contenido> contenidos) {
		static public function WrapContenidoList($contenidos) {
// 			Collection<SerieLogica> 
			$contenidoslogica = new ArrayCollection();
// 			Iterator<Contenido> 
// 			$it = $contenidos.iterator();
			foreach ($contenidos as $cont) {
// 				SerieLogica 
				$serieLogica = new SerieLogica(/* it.next() */ $cont);
				$contenidoslogica->set($serieLogica->ID, $serieLogica);
			}
			return $contenidoslogica;
		}
		
// 		public void validarMetadatos() throws Exception
		public function validarMetadatos()
		{
			try {
				if (is_null($this->nombre) || empty($this->nombre))
				{
					throw new Exception("El Contenido debe tener un nombre\n");
				}
				if (is_null($this->sinopsis) || empty($this->sinopsis))
				{
					throw new Exception("El Contenido debe tener una sinopsis\n");
				}
				if (is_null($this->actores) || empty($this->actores))
				{
					throw new Exception("El Contenido debe tener los actores\n");
				}
				$existeContenido = Contenido::GetOneByName($this->nombre);
				if (isset($existeContenido))
				{
					throw new Exception("El Contenido ya existe\n");
				}	
			} catch (\Exception $e) {
				throw $e;
			}
		}
		
// 		protected void validarGeneral() throws Exception
// 		{
// 		}

	}
	
}
?>