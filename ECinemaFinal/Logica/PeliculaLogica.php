<?php
namespace ECinema\Negocio {
	//include_once ('CrossCutting/ArrayCollection.php');	
 	include_once ('ContenidoLogica.php');
 	include_once ('TipoContenido.php');
 	use ECinema\Datos\TipoContenido;
	
	class PeliculaLogica extends ContenidoLogica {
			
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
		
		public function __construct0()
		{			
   			parent::__construct(TipoContenido::PELICULA);
		}
		
		public function __construct2($tipoContenido, $datosentidad)
		{
			parent::__construct(null, /*Contenido*/ $datosentidad);
		}
	
// 		@Override
		//Contenido.TipoContenido
		public function getTipo() {
			return TipoContenido::PELICULA;
		}
	
		//PeliculaLogica
		public static function Buscar(/*int*/ $id_contenido)
		{
			//PeliculaLogica cl = null;
			$peliculaLogica = null;
// 			Contenido datosentidad = Contenido.GetOne($id_contenido);
			$datosentidad = Contenido::GetOne($id_contenido);
			if ( !is_null($datosentidad) )
			{
				if ($datosentidad->getTipo() == TipoContenido::PELICULA){
// 					$peliculaLogica = new PeliculaLogica((Contenido) $datosentidad);
				}
			}
			return $datosentidad;
		}
	
		//Collection<PeliculaLogica>
		public static function GetAll()
		{
// 			Collection<Contenido> contenidos = Contenido.getAll(TipoContenido.PELICULA);
			$contenidos = Contenido.getAll(TipoContenido::PELICULA);
			return WrapContenidoList($contenidos);
		}
	
		//Collection<PeliculaLogica>
		public static function GetAllByPrefix(/* String */ $prefix)
		{
// 			Collection<Contenido> contenidos = Contenido.getAll(TipoContenido.PELICULA, $prefix);
			$contenidos = Contenido::getAll(TipoContenido::PELICULA, $prefix);
			return WrapContenidoList($contenidos);
		}
	
		//Collection<PeliculaLogica>
		public static function GetAllByCategori(/*int*/ $id_categoria)
		{
// 			Collection<Contenido> contenidos = Contenido.getAll(TipoContenido.PELICULA, $id_categoria);
			$contenidos = Contenido::getAll(TipoContenido::PELICULA, $id_categoria);
			return WrapContenidoList($contenidos);
		}
	
		/**
		 * devuelve una lista de las ultimas peliculas estrenadas
		 * @param fecha_limite: fecha a partir de donde se buscan extrenos.
		 * @param limit: cantidad maxima a buscar
		 * @return
		 */
		
		//Collection<PeliculaLogica>
		public static function GetAllByFechaLimite(/* Date */ $fecha_limite, /* int */ $limit)
		{
			//Collection<Contenido> contenidos = Contenido.getAll(TipoContenido.PELICULA, $fecha_limite, $limit);
			$contenidos = Contenido::getAll(TipoContenido::PELICULA, $fecha_limite, $limit);
			return WrapContenidoList($contenidos);
		}
	
		/*
		 * Convierte una lista de entidades de datos a su correspondiente entidad de negocio
		*/
		// Collection<PeliculaLogica>
		private static function WrapContenidoList(/* Collection<Contenido> */ $contenidos)
		{
			//Collection<PeliculaLogica> contenidoslogica = new ArrayList<PeliculaLogica>();
			$contenidoslogica = new ArrayCollection();
// 			Iterator<Contenido> it = $contenidos.iterator();
			$it = $contenidos->getIterator();
			while ($it.hasNext())
			{
				//PeliculaLogica pl = new PeliculaLogica(it.next());
				$peliculaLogica = new PeliculaLogica($it->next());
				$contenidoslogica->add($peliculaLogica);
			}
			return $contenidoslogica;
		}
	}
}
?>