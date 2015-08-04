<?php
namespace ECinema\Datos {
	include_once ('Entidad.php');
	include_once ('CrossCutting/ArrayCollection.php');
	use ECinema\CrossCutting\ArrayCollection;
	
	class MetaContenido extends Entidad {
	
		public function __construct(){
			parent::__construct();
			$this->duracion = 0;
		}
	
		private $nombre = "";
		protected $sinopsis= "";
		//int
		protected $duracion;
		//String
		protected $actores= "";
		// la url de la imagen a mostrar como presentacion
		protected $imagen= "";
		//string de la url de youtube que tiene el video trailer
		protected $trailer = "";
		
		//protected Collection<Integer> categorias;
		protected $categorias;
		//protected Collection<Integer> categorias_bd;
		protected $categorias_bd;
		
		public function getNombre() {
			return $this->nombre;
		}
	
		public function setNombre($Nombre) {
			$this->nombre = $Nombre;
			$this->setModificada();
		}
	
		public function  getSinopsis() {
			return $this->sinopsis;
		}
	
		public function setSinopsis($sinopsis) {
			$this->sinopsis = $sinopsis;
			$this->setModificada();
		}	
	
		public function getDuracion() {
			return $this->duracion;
		}
	
		public function setDuracion($duracion) {
			$this->duracion = $duracion;
			$this->setModificada();
		}
	
		public function getActores() {
			return $this->actores;
		}
	
		public function setActores($actores) {
			$this->actores = $actores;
			$this->setModificada();
		}
	
		public function getImagen() {
			return $this->imagen;
		}
	
		public function setImagen($imagen) {
			$this->imagen = $imagen;
			$this->setModificada();
		}
	
		public function getTrailer() {
			return $this->trailer;
		}
	
		public function setTrailer($trailer) {
			$this->trailer = $trailer;
			$this->setModificada();
		}
	
		//public Collection<Integer> getCategorias()
		public function getCategorias()
		{
			return $this->categorias;
		}
	
		//public function setCategorias(Collection<Integer> $categorias)
		public function setCategorias($categorias)
		{
			$this->categorias = $categorias;
			$this->setModificada();
		}
	
// 		private static function cargar_categorias(MetaContenido $mc, MySQLAccess $mysql, int $id_metacontenido) throws SQLException
		private static function cargar_categorias($mc, $mysql, $id_metacontenido)
		{
			//java.sql.CallableStatement cstm = $mysql.IniciarStoredProc("{CALL listarcategoriasmetacontenido(?)}");
			$cstm = $mysql->IniciarStoredProc("CALL listarcategoriasmetacontenido(?)");
			$cstm->bindParam(1, $id_metacontenido,\PDO::PARAM_INT);
			//ResultSet rst = cstm.executeQuery();
			$cstm->execute();
			$resultSet = $cstm->fetchAll();
			//Collection<Integer> $categorias = new ArrayList<Integer>();
			$categorias = new ArrayCollection();
// 			while ($resultSet.next())
			foreach($resultSet as $row)
			{
				//int p = MySQLAccess.GetSafeInt($resultSet, 1);
				$p = MySQLAccess::GetSafeInt($row, 0);
				$categorias->add($p);
			}
// 			rst.close();
			$cstm->closeCursor();
			$cstm = null;
			$mc->categorias = $categorias;
			$mc->categorias_bd = $categorias;
		}
	
		public static function GetOne(/* int */ $id_metacontenido, /* MySQLAccess */ $mysql)
		{
			//MetaContenido mc = null;
			$metaContenido = null;
			try {
				//java.sql.CallableStatement $cbst = $mysql.IniciarStoredProc("{CALL buscarmetacontenido(?)}");
				$callableStatement = $mysql->IniciarStoredProc("CALL buscarmetacontenido(?)");
// 				$callableStatement->setInt(1, $id_metacontenido);
				$callableStatement->bindParam(1, $id_metacontenido,\PDO::PARAM_INT);
				//ResultSet rs = $callableStatement.executeQuery();
				$flag = $callableStatement->execute();
				if($flag){
	// 				$resultSet->next();
					$resultSet = $callableStatement->fetchAll();
					$metaContenido = self::mapear($resultSet[0]);
				} else {
					$errorMessage = $callableStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
// 				$resultSet->close();
				$callableStatement->closeCursor();
				$callableStatement = null;
				self::cargar_categorias($metaContenido, $mysql, $id_metacontenido);

			} catch (\PDOException $ex)
			{
				/*do nothing??*/
				System.out.println($ex->getMessage());
			} finally {
			}
			return $metaContenido;
		}
	
		protected static function mapear(/* ResultSet */ $rs)
		{
			//int id = MySQLAccess.GetSafeInt($rs, 1);
			$id = MySQLAccess::GetSafeInt($rs, 0);
			//check if we found it
			if ($id == -1)
			{
				return null;
			}
			//MetaContenido mc = new MetaContenido();
			$metaContenido = new MetaContenido();
// 			$metaContenido->ID = id;
			$metaContenido->setID($id);
			$metaContenido->setNombre($rs['nombre']);//MySQLAccess.GetSafeString($rs, 2)
			$metaContenido->setSinopsis($rs['sinopsis']);//MySQLAccess.GetSafeString($rs, 3)
			$metaContenido->setDuracion(intval($rs['duracion']));//MySQLAccess.GetSafeInt($rs, 4)
			$metaContenido->setActores($rs['actores']);//MySQLAccess.GetSafeString($rs, 5)
			$metaContenido->setImagen($rs['imagen']);//MySQLAccess.GetSafeString($rs, 6)
			$metaContenido->setTrailer($rs['trailer']);//MySQLAccess.GetSafeString($rs, 7)
			$metaContenido->setEstado(Estado::INTACTA);
			return $metaContenido;
		}
	
		//@Override
		protected function OperacionesNuevo($mysql, $block) //throws SQLException 
		{
			try {
				//Connection connection = $mysql.getConnection();
				$connection = $mysql->getConnection();
				/* PreparedStatement prepareStatement = $connection.prepareStatement(
				"INSERT INTO `javatp`.`metacontenidos` (sinopsis, duracion, actores, imagen, trailer, nombre)"
						+ " VALUES (?, ?, ?, ?, ?, ?);", PreparedStatement.RETURN_GENERATED_KEYS);*/
				$prepareStatement = $connection->prepare(
				"INSERT INTO ecinema.metacontenidos (sinopsis, duracion, actores, imagen, trailer, nombre) VALUES (?, ?, ?, ?, ?, ?);");
						$prepareStatement->bindParam(1, $this->sinopsis,\PDO::PARAM_STR);
						$prepareStatement->bindParam(2, $this->duracion,\PDO::PARAM_INT);
						$prepareStatement->bindParam(3, $this->actores,\PDO::PARAM_STR);
						$prepareStatement->bindParam(4, $this->imagen,\PDO::PARAM_STR);
						$prepareStatement->bindParam(5, $this->trailer,\PDO::PARAM_STR);
						$prepareStatement->bindParam(6, $this->nombre,\PDO::PARAM_STR);
						$flag = $prepareStatement->execute();
						if ($flag){
							$generatedKeys = $connection->lastInsertId();
// 						if (generatedKeys.next()) {
							//ResultSet generatedKeys = prepareStatement.getGeneratedKeys();
							$this->ID = intval($generatedKeys);//->getInt(1);
											
// 						}
						} else {
							$errorMessage = $prepareStatement->errorInfo();
							throw new \PDOException($errorMessage[2], $errorMessage[1]);
						}
						$this->AgregarCategorias($connection, $this->categorias);
						// actualizar la lista de categorias en la bd
						//$this->categorias_bd = new ArrayList($this->categorias);
						$this->categorias_bd = $this->categorias;
			} catch (\PDOException $e) {
				throw $e;
			}			
		}
	
		//private function AgregarCategorias(Connection $connection, Collection<Integer> $categorias) throws SQLException
		private function AgregarCategorias($connection, $categorias)
		{
			try {
				//PreparedStatement prepareStatement;
				if (isset($categorias) /*!= null*/) {
					//Iterator<Integer> pl = $categorias->iterator();
					//$pl = $categorias->iterator();
					//prepareStatement = $connection.prepareStatement(
					$prepareStatement = $connection->prepare(
							"INSERT INTO ecinema.categorias_metacontenido (id_categoria, id_metacontenido) VALUES (?, ?);");
// 					while (pl.hasNext()) {
					foreach ($categorias as $pl) {
						$prepareStatement->bindParam(1, $pl,\PDO::PARAM_INT);
						$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
						$flag = $prepareStatement->execute();
						if (!$flag) {
							$errorMessage = $prepareStatement->errorInfo();
							throw new \PDOException($errorMessage[2], $errorMessage[1]);
						}
					}
				}
			} catch (\PDOException $e) {
				throw $e;
			}

		}
	
		//private function BorrarCategorias(Connection $connection, Collection<Integer> $categorias) throws SQLException {
		private function BorrarCategorias($connection, $categorias) {			
			try {
				//PreparedStatement prepareStatement;
				if (isset($categorias)) {
					//Iterator<Integer> pl = $categorias.iterator();
// 					$pl = $categorias->iterator();
					$prepareStatement = $connection->prepare("DELETE FROM categorias_metacontenido WHERE id_categoria =? AND id_metacontenido =?");
// 					while (pl.hasNext()) {
					foreach ($categorias as $pl){
						$prepareStatement->bindParam(1, $pl->ID /*pl.next()*/,\PDO::PARAM_INT);
						$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
						if ($prepareStatement->execute()){
						} else {
							$errorMessage = $prepareStatement->errorInfo();
							throw new \PDOException($errorMessage[2], $errorMessage[1]);
						}
					}
				}	
			} catch (\PDOException $e) {
				throw $e;
			}
		}
	
		//@Override
		//protected function OperacionesModificar(MySQLAccess $mysql, boolean $block) throws SQLException
		protected function OperacionesModificar($mysql, $block)
		{
			try {
				//Connection connection = $mysql.getConnection();
				$connection = $mysql->getConnection();
				$this->procesarCategorias($connection);
				//PreparedStatement prepareStatement = $connection.prepareStatement(
				$prepareStatement = $connection->prepare("Update ecinema.metacontenidos SET sinopsis=?, duracion=?, actores=?, imagen=?, trailer=?, nombre=? WHERE id_metacontenido=?;");
				$prepareStatement->bindParam(1, $this->sinopsis,\PDO::PARAM_STR);
				$prepareStatement->bindParam(2, $this->duracion,\PDO::PARAM_INT);
				$prepareStatement->bindParam(3, $this->actores,\PDO::PARAM_STR);
				$prepareStatement->bindParam(4, $this->imagen,\PDO::PARAM_STR);
				$prepareStatement->bindParam(5, $this->trailer,\PDO::PARAM_STR);
				$prepareStatement->bindParam(6, $this->nombre,\PDO::PARAM_STR);
				$prepareStatement->bindParam(7, $this->ID,\PDO::PARAM_INT);
				$flag = $prepareStatement->execute();
				if (!$flag){
					$errorMessage = $prepareStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);					
				}
			} catch (\PDOException $e) {
				throw $e;
			}
		}
	
		//private function procesarCategorias(Connection $connection) throws SQLException
		private function procesarCategorias($connection)
		{
			try {
				//las categorias que estan en la bd no requieren modificacion
				//Collection<Integer> altas = new ArrayList($this->categorias);
				$altas = new ArrayCollection($this->categorias);
				if (is_null($this->categorias_bd)) {
					$this->categorias_bd = new ArrayCollection();
				}
				//Collection<Integer> bajas = new ArrayList($this->categorias_bd);
				$bajas = new ArrayCollection($this->categorias_bd);
				//borro las categorias comunes y quedan solo las que tengo que agregar
				$altas.removeAll($this->categorias_bd);
				$this->AgregarCategorias($connection, $altas);
				//borro las categorias comunes y quedan las que debo eliminar
				$bajas.removeAll($this->categorias);
				$this->BorrarCategorias($connection, bajas);
			} catch (\PDOException $e) {
				throw $e;
			}

		}
	
		//@Override
		//protected function OperacionesEliminar(MySQLAccess $mysql, boolean $block) throws SQLException
		protected function OperacionesEliminar($mysql, $block)
		{
			try {
// 				Connection $connection = $mysql.getConnection();
				$connection = $mysql->getConnection();
// 				PreparedStatement prepareStatement = $connection.prepareStatement(
				$prepareStatement = $connection->prepare("Update ecinema.metacontenidos SET borrado=? WHERE id_metacontenido=?;");
				$prepareStatement->bindParam(1, true,\PDO::PARAM_BOOL);
				$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
				$flag = $prepareStatement->execute();
				if (!$flag) {
					$errorMessage = $prepareStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
			} catch (\PDOException $e) {
				throw $e;
			}
		}
	}
}
?>