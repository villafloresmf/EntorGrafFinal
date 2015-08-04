<?php 
namespace ECinema\Datos {
	include_once ("TipoContenido.php");
	include_once ("Entidad.php");
	include_once ("MetaContenido.php");
	use ECinema\CrossCutting\ArrayCollection;
	use ECinema\Datos\TipoContenido;
	use ECinema\Datos\MetaContenido;
use ECinema\CrossCutting\ECinema\CrossCutting;
		/**
	 * clase abtracta de contenido, necesito dos subclases pelicula y serie.
	 * en la clase de negocio hago la distincion de las mismas en la capa de datos mantengo una sola clase
	 */
		
	class Contenido extends Entidad {
	
		/**
		 * ocultamos la complejidad de algunas propiedades a las clases externas
		 */
		
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
		
	
// 		public function __construct1(TipoContenido $tipoContenido)
		public function __construct1($TipoContenido)
		{
			parent::__construct();
			$this->tipoContenido = $TipoContenido;
			$this->fechaEstreno = new \DateTime('2000-01-01');
 			try {
 				//crear un nuevo metaContenido vacio
 				$this->setMetaContenido(new MetaContenido());
 			} catch (Exception $ex) {
 			}
		}
	
// 		private function __construct2(TipoContenido $tipoContenido, MetaContenido $meta)// throws Exception
		public function __construct3($TipoContenido, $meta, $nada = 0)// throws Exception
		{
			parent::__construct();
			$this->tipoContenido = $TipoContenido;
			$this->fechaEstreno = new \DateTime();
			$this->setMetaContenido($meta);
		}
	
//		public function Contenido(TipoContenido $tipoContenido, Contenido $parent) throws Exception
		public function __construct2($TipoContenido, $parent)
		{
			parent::__construct();
			$this->tipoContenido = $TipoContenido;
			$this->fechaEstreno = new \DateTime();
			$this->setMetaContenido($parent->getMetaContenido());
		}
	
		private $metaContenido;
	
		private function getMetaContenido() {
			return $this->metaContenido;
		}
	
// 		private function setMetaContenido(MetaContenido $metaContenido) throws Exception
		private function setMetaContenido($metaContenido) 		 
		{
			//el metaContenido nunca debe ser null
			if (is_null($metaContenido))
			{
				throw new \Exception("Metacontenido no valido\n");
			}
			$this->metaContenido = $metaContenido;
			$this->setModificada();
		}
	
		public function getNombre() {
			return $this->metaContenido->getNombre();
		}
	
		public function setNombre(/* String */ $nombre) {
			$this->metaContenido->setNombre($nombre);
		}
	
		private $nombre_capitulo = "";
	
		public function getNombreCapitulo() {
			return $this->nombre_capitulo;
		}
	
		public function setNombreCapitulo(/* String */ $Nombre) {
			$this->nombre_capitulo = $Nombre;
			$this->setModificada();
		}
	
		public function getSinopsis() {
			return $this->metaContenido->getSinopsis();
		}
	
		public function setSinopsis(/* String */ $sinopsis) {
			$this->metaContenido->setSinopsis($sinopsis);
			$this->setModificada();
		}
	
		public function getDuracion() {
			return $this->metaContenido->getDuracion();
		}
	
		public function setDuracion(/* int */ $duracion) {
			$this->metaContenido->setDuracion($duracion);
			$this->setModificada();
		}
	
		public function getActores() {
			return $this->metaContenido->getActores();
		}
	
		public function setActores(/* String */ $actores) {
			$this->metaContenido->setActores($actores);
			$this->setModificada();
		}
	
		// la url de la imagen a mostrar como presentacion
		//protected string $imagen= "";
		protected $imagen= "";
	
		public function getImagen() {
			/*
			 * si hay una imagen especifica, usar la general del contenido
			* esto se debe a que una serie puede tener distintas imagenes por capitulo
			*/
			if (is_null($this->imagen))
			{
				return $this->metaContenido->getImagen();
			}
			return $this->imagen;
		}
	
// 		public function setImagen(String $imagen) {
		public function setImagen1($imagen) {			
			// en caso de que no exista una imagen general asignar una.
			$force = is_null($this->metaContenido->getImagen()) || empty($this->metaContenido->getImagen());
			$this->setImagen2($imagen, $force);
		}
	
// 		public function setImagen(String $imagen, boolean $force_img) {
		public function setImagen2($imagen, $force_img) {			
			if ($force_img)
			{
				$this->metaContenido->setImagen($imagen);
			}
			$this->imagen = $imagen;
			$this->setModificada();
		}
	
		//protected string $trailer= "";
		protected $trailer= "";
	
		/*
		 * si no hay un trailer uso el general, esto es util para las series
		* que pueden tener un trailer por capitulo
		*/
		public function getTrailer() {
			if ($this->trailer == null)
			{
				return $this->metaContenido->getTrailer();
			}
			return $this->trailer;
		}
	
		/**
		 * si no hay un trailer general, lo agrego
		 */
// 		public function setTrailer(String $trailer) {
		public function setTrailer1($Trailer) {
			//boolean $force_trailer = metaContenido.getTrailer() == null;
			$force_trailer = is_null($this->metaContenido->getTrailer());
			$this->setTrailer2($Trailer, $force_trailer);
		}
	
// 		public function setTrailer(String $trailer, boolean $force_trailer) {
		public function setTrailer2($Trailer, $force_trailer) {
			if ($force_trailer)
			{
				$this->metaContenido->setTrailer($Trailer);
			}
			$this->trailer = $Trailer;
			$this->setModificada();
		}
	
		//TipoContenido		
		protected $tipoContenido;
	
		public function getTipo() {
			return $this->tipoContenido;
		}
	
		protected $fechaEstreno;
	
		public function getFechaEstreno() {
			return $this->fechaEstreno;
		}
	
// 		public function setFechaEstreno(Date $FechaEstreno) {
		public function setFechaEstreno($FechaEstreno) {
			$this->fechaEstreno = $FechaEstreno;
			$this->setModificada();
		}
	
// 		protected String url= "";		
		protected $url= "";
	
		public function getUrl() {
			return $this->url;
		}
	
// 		public function setUrl(String $url) {
		public function setUrl($Url) {			
			$this->url = $Url;
			$this->setModificada();
		}
	
// 		Collection<Integer> getCategorias()
		public function getCategorias()		
		{
			return $this->metaContenido->getCategorias();
		}
	
		public function setCategorias(/* Collection<Integer> */ $categorias)		
		{
			$this->metaContenido->setCategorias($categorias);
			$this->setModificada();
		}
	
		public static function GetOne(/* int */ $id_contenido)
		{
			/* Contenido */ $c = null;
			/* MySQLAccess */  $mysql = new MySQLAccess();
			try {
				/* java.sql.CallableStatement */  $cstm = $mysql->IniciarStoredProc("CALL buscarcontenido(?)");
				$cstm->bindParam(1, $id_contenido,\PDO::PARAM_INT);
				/* ResultSet  $rs = */ $cstm->execute();//executeQuery();
// 				$rs->next();
				$rs = $cstm->fetchAll();
// 				$rs->close();
				$cstm->closeCursor();
				$cstm = null;
				$c = self::mapear($rs[0], $mysql);

			} catch (\Exception $exc) {
				/*do nothing*/
				print_r($exc->getMessage());
			} finally {
				$mysql->close();
			}
			return $c;
		}
	
		//Contenido
 		public static function GetOneByName(/* String */ $nombre)
 		{
 			/* Contenido */ $cotenido = null;
 			/* MySQLAccess*/ $mysql = new MySQLAccess();
 			try {
 				/* java.sql.CallableStatement */ 
 				$cstm = $mysql->IniciarStoredProc("CALL buscarcontenidonombre(?)");
 				//$cstm->setString(1, $nombre);
 				$cstm->bindParam(1,$nombre,\PDO::PARAM_STR);
 				/* ResultSet  $rs = $cstm->execute() ;*/// executeQuery();
 				$flag = $cstm->execute();
 				$rs = $cstm->fetchAll();
//  			$rs->next();
 				$cotenido = self::mapear($rs[0], $mysql);
//  			$rs->close();
 				$cstm->closeCursor();
 				$cstm = null;
 			} catch (Exception $ex) {
 				/*do nothing??*/
 				System.err.println($ex.getMessage());
 			} finally {
 				$mysql->close();
 			}
 			return $cotenido;
		}
	
		//Contenido
 		protected static function mapear(/* ResultSet */ $rs, /* MySQLAccess */ $mysql)
 		{
 			/* int */ $id = MySQLAccess::GetSafeInt($rs, 0);
 			//check if we found it
 			if ($id == -1)
 			{
 				return null;
 			}
 			/* int */ $id_meta = MySQLAccess::GetSafeInt($rs, 1);
 			/* MetaContenido */ $mc = MetaContenido::GetOne($id_meta, $mysql);
	
 			/* TipoContenido */ $tipoContenido = TipoContenido::valueOf($rs['tipo']);//MySQLAccess::GetSafeString($rs, 3);
 			/* Contenido */ $contenido = null;
 			try {
 				$contenido = new Contenido($tipoContenido, $mc,null);
 			} catch (Exception $ex) {
 				return null;
 			}
 			$contenido->setID($id);
 			$contenido->setNombreCapitulo($rs['nombre_capitulo']);//MySQLAccess::GetSafeString($rs, 4)
 			$contenido->setUrl($rs['url']);//MySQLAccess::GetSafeString($rs, 5)
 			try {
 				$contenido->setFechaEstreno(new \DateTime($rs['fecha_estreno']));//$rs.getDate(6)
 			}
 			catch (\Exception $ex)
 			{
 				// XX: dejo en null
 			}
 			$contenido->setImagen1($rs['imagen']);//MySQLAccess::GetSafeString($rs, 7)
 			$contenido->setTrailer1($rs['trailer']);//MySQLAccess::GetSafeString($rs, 8)
 			$contenido->setEstado(Estado::INTACTA);
 			return $contenido;
 		}
	
// 		@Override
//  	protected function OperacionesNuevo(MySQLAccess mysql, boolean block) throws SQLException
 		protected function OperacionesNuevo($mysql, $block) {
 			try {
 				// guardo el metaContenido primero
 				try {
 					$this->metaContenido->save2($mysql, false);
 				} catch (Exception $e) {
 					throw new \PDOException($e->getMessage());
 				}
 				// guardo el contenido y lo asocio con su metaContenido
 				/*Connection*/ $connection = $mysql->getConnection();
 				/*
 				PreparedStatement $prepareStatement = $connection->prepareStatement(
  				"INSERT INTO `javatp`.`contenidos` (id_metaContenido, tipoContenido, nombre_capitulo, url, fecha_estreno, imagen, trailer)"
  						+ " VALUES ( ?, ?, ?, ?, ?, ?, ?);", PreparedStatement.RETURN_GENERATED_KEYS);
  				*/
 				$prepareStatement = $connection->prepare(
 				"INSERT INTO ecinema.contenidos (id_metaContenido, tipo, nombre_capitulo, url, fecha_estreno, imagen, trailer) VALUES ( ?, ?, ?, ?, ?, ?, ?);");
 				$prepareStatement->bindParam(1, $this->metaContenido->getID(),\PDO::PARAM_INT);
 				$prepareStatement->bindParam(2, TipoContenido::name($this->tipoContenido),\PDO::PARAM_STR);
 				$prepareStatement->bindParam(3, $this->nombre_capitulo,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(4, $this->url,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(5, $this->fechaEstreno->format('Y-m-d'),\PDO::PARAM_STR);
 				$prepareStatement->bindParam(6, $this->imagen,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(7, $this->trailer,\PDO::PARAM_STR);
 				$flag = $prepareStatement->execute();
 				/*ResultSet $generatedKeys = $prepareStatement.getGeneratedKeys(); */ 
 				if ($flag){
 					$generatedKeys = $connection->lastInsertId();
// 					if (generatedKeys.next()) {
 					//ResultSet generatedKeys = prepareStatement.getGeneratedKeys();
 					$this->ID = intval($generatedKeys);//->getInt(1);	
// 					}
 				} else {
 					$errorMessage = $prepareStatement->errorInfo();
 					throw new \PDOException($errorMessage[2], $errorMessage[1]);
 				}
 			} catch (\PDOException $e) {
 				throw $e;
 			}
 		}
	
// 		@Override
//  	protected function OperacionesModificar(MySQLAccess mysql, boolean block) throws SQLException
 		protected function OperacionesModificar($mysql, $block)
 		{
 			try {
 				/* Connection */ $connection = $mysql->getConnection();
 				// guardo el metaContenido primero
 				try {
 					$this->metaContenido->save($mysql, false);
 				} catch (Exception $exc) {
 					throw new \PDOException($exc->getMessage());
 				}
 				/* PreparedStatement */
 				$prepareStatement = $connection->prepareStatement(
 						"Update ecinema.contenidos SET id_metaContenido=?, tipo=?, nombre_capitulo=?, url=?, fecha_estreno=?, imagen=?, trailer=? WHERE id_contenido=?;");
 				$prepareStatement->bindParam(1, $this->metaContenido->getID(),\PDO::PARAM_INT);
 				$prepareStatement->bindParam(2, TipoContenido::name($this->tipoContenido),\PDO::PARAM_STR);
 				$prepareStatement->bindParam(3, $this->nombre_capitulo,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(4, $this->url,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(5, $this->fechaEstreno->format('Y-m-d'),\PDO::PARAM_STR);
 				$prepareStatement->bindParam(6, $this->imagen,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(7, $this->trailer,\PDO::PARAM_STR);
 				$prepareStatement->bindParam(8, $this->ID,\PDO::PARAM_INT);
 				$flag = $prepareStatement->execute();
 				if (!$flag){
 					throw new \PDOException($prepareStatement->errorInfo()[2]);
 				}
 			} catch (\PDOException $e) {
 				throw $e;
 			}
 		}

		public static /* Collection<Contenido> */ function getAll() {
			/* Collection<Contenido> */ $contenidos = new ArrayCollection();
			/* MySQLAccess */ $mysql = new MySQLAccess();
			try {
				/*java.sql.CallableStatement */ $cstm = $mysql->IniciarStoredProc("CALL listarcontenidos()");
				/*ResultSet */ $rs = $cstm->execute();
				self::wrapEntidad($rs, $contenidos, $mysql);
//  			$rs->close();
 				$cstm->closeCursor();
 				$cstm = null;
			} catch (\PDOException $e) {
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $contenidos;
		}
		
		/*ordenados por cantidad de alquileres, los mas populares primero*/
		
		public static /* Collection<Contenido> */ function getAllByTipoContenido(/* TipoContenido */ $tipoContenido) {
			/* Collection<Contenido> */ $contenidos = new ArrayCollection();
			/* MySQLAccess */ $mysql = new MySQLAccess();
			try {
				/* java.sql.CallableStatement */ 
				$cstm = $mysql->IniciarStoredProc("CALL listarcontenidostipovistas(?)");
				$cstm->bindParam(1, TipoContenido::name($tipoContenido),\PDO::PARAM_STR);
				/* ResultSet */ 
				$flag = $cstm->execute();
				if ($flag) {
					$rs = $cstm->fetchAll();
	//  			$rs->close();
					$cstm->closeCursor();
					$cstm = null;
					self::wrapEntidad($rs, $contenidos, $mysql);
				} else {
					$errorMessage = $cstm->errorInfo();
 					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
			} catch (\PDOException $ex) {
				/*do nothing??*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $contenidos;
		}
		
		public static function /* Collection<Contenido> */getAllByTipoYPrefix(/* TipoContenido */ $tipoContenido, /* String */ $prefix) {
			/* Collection<Contenido> */ $contenidos = new ArrayCollection();
			/* MySQLAccess */ $mysql = new MySQLAccess();
			try {
				/* java.sql.CallableStatement */ 
				$cstm = $mysql->IniciarStoredProc("CALL listarcontenidostipoprefix(?, ?)");
				$cstm->bindParam(1, TipoContenido::name($tipoContenido),\PDO::PARAM_STR);
				$cstm->bindParam(2, $prefix,\PDO::PARAM_STR);
				/* ResultSet */ 
				$rs = $cstm->execute();
				self::wrapEntidad($rs, $contenidos, $mysql);
//  			$rs->close();
 				$cstm->closeCursor();
 				$cstm = null;
			} catch (\PDOException $ex) {
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $contenidos;
			
		}
		
		public static function getAllByTipoYIDCategoria(/* TipoContenido */ $tipoContenido,/* int */ $id_categoria) {
			/* Collection<Contenido> */ $contenidos = new ArrayCollection();//<Contenido>();
			/* MySQLAccess */ $mysql = new MySQLAccess();
			try {
				/* java.sql.CallableStatement */ $cstm = mysql.IniciarStoredProc("{CALL listarcontenidostipocat(?, ?)}");
				$cstm.setString(1, tipoContenido.name());
				$cstm.setInt(2, id_categoria);
				/* ResultSet */ $rs = $cstm->execute();
				wrapEntidad($rs, $contenidos, $mysql);
//  			$rs->close();
 				$cstm->closeCursor();
 				$cstm = null;
			} catch (\PDOException $ex) {
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $contenidos;
		}		
		

		/*
		 * devuelve los capitulos de una serie
		*/
		
		public static function /* Collection<Contenido> */ getAllByIdContenido(/* int */ $id_contenido) {
			/* Collection<Contenido> */ $contenidos = new ArrayCollection();//<Contenido>();
			/* MySQLAccess*/ $mysql = new MySQLAccess();
			try {
				/* java.sql.CallableStatement */ 
				$cstm = $mysql->IniciarStoredProc("CALL listarcapitulos(?)");
// 				$cstm.setInt(1, id_contenido);
				$cstm->bindParam(1, $id_contenido,\PDO::PARAM_INT);
				/* ResultSet $rs = $cstm.executeQuery(); */ 
				$flag = $cstm->execute();
				$rs = $cstm->fetchAll();
				self::wrapEntidad($rs, $contenidos, $mysql);
//  			$rs->close();
 				$cstm->closeCursor();
 				$cstm = null;
			}
			catch (\PDOException $ex)
			{
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $contenidos;
		}

		/*
		 * devuelve los ultimos contenidos agregados inmediatamente antes de fecha_limite
		*/

// 		function static  Collection<Contenido> getAll(TipoContenido tipoContenido, Date fecha_limite, int limit)
		public static function getAllByTipoContenidoYFecha($tipoContenido, $fecha_limite, $limit)
		{
// 			Collection<Contenido> $contenidos = new ArrayList<Contenido>();
			$contenidos = new ArrayCollection();
			/* Contenido */ $c;
			/* MySQLAccess */ $mysql = new MySQLAccess();
			try {
				/* java.sql.CallableStatement */ 
				$cstm = $mysql->IniciarStoredProc("CALL listarcontenidostipofecha(?, ?)");				
				$cstm->bindParam(1, TipoContenido::name(tipo),\PDO::PARAM_STR);
				$cstm->bindParam(2, $fecha_limite->format('Y-m-d'),\PDO::PARAM_STR);
				/* ResultSet */ 
				$flag = $cstm->execute();
				$rs = $cstm->fetchAll();
				/*int */$cant = 0;
				while ($rs.next() && $limit > $cant){
					try {
						$c = self::mapear($rs, $mysql);
						if (isset($c)){
							$contenidos->set($c->getID(),$c);
							$cant += 1;
						}
					} catch (\Exception $ex) {
						print_r($ex->getMessage());
					}
				} 
				
// 				$rs.close();
				$cstm->closeCursor();
				$cstm = null;
			} catch (\PDOException $ex){
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $contenidos;
		}
	
		/**
		 * wrapEntidad: LLeno una lista de entidades a partir de los datos del ResultSet.
		 */
		
// 		static function wrapEntidad( ResultSet $rs, Collection<Contenido> $lista, MySQLAccess $mysql)// throws SQLException
		public static function wrapEntidad($rs, $lista, $mysql)// throws SQLException
		{
			/* Contenido */ $c;
// 			while ($rs.next())
			foreach ($rs as $row)
			{
				try {
					$c = self::mapear(/* $rs */ $row, $mysql);
					if (isset($c)) {
// 						lista.add(c);
						$lista->set($c->getID(),$c);
					}
						
				} catch (\PDOException $ex) {
					throw $ex;
				} catch (Exception $ex) {
					print_r("Error armando lista de entidades: %s\n", $ex->getMessage());
				}
			}			

		}
	
		//@Override
		protected function OperacionesEliminar(/* MySQLAccess */ $mysql, /* boolean */ $block) //throws SQLException		
		{
			try {
				/* Connection */ $connection = mysql.getConnection();
				/* PreparedStatement */ 
				$prepareStatement = $connection->prepareStatement("Update ecinema.contenidos SET borrado=? WHERE id_contenido=?;");
				$prepareStatement->bindParam(1, true,\PDO::PARAM_BOOL);
				$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
				$flag = $prepareStatement->executeUpdate();
				if (!$flag) {
					throw new \PDOException($prepareStatement->errorInfo()[2]);
				}
			} catch (\PDOException $e) {
				throw $e;
			}
		}
	
		/*
		 * sobrecarga especial para las series
		*/
		//@Override
		public function borrar(/* boolean */ $parent)
		{
			if ($parent) {
				$this->getMetaContenido()->borrar(true);
			} else {
				$this->setEstado(Estado::BORRADA);
			}
		}
		
		
		public function jsonSerialize(){
			$cat = $this->getCategorias();
			return [
				'ID' => $this->ID,
				'TipoContenido' => TipoContenido::name($this->tipoContenido),
				'Nombre' => $this->getNombre(),
				'NombreCapitulo' => $this->nombre_capitulo,
				'Duracion' => $this->getDuracion(),
				'FechaEstreno' => $this->fechaEstreno->format('d/m/Y'),
				'Categorias' => [],
				'Actores' => $this->getActores(),
				'Imagen' => $this->imagen,
				'Trailer' => $this->trailer,
				'Url' => $this->url,
				'Sinopsis' => $this->getSinopsis(),
			];
		}
	}
}
?>