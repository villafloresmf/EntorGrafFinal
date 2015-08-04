<?php
namespace ECinema\Datos {
	
	class Plan extends Entidad {
		
		use ECinema\Datos\MySQLAccess;
		use ECinema\CrossCutting\ArrayCollection;
	
		public function Plan() {
			//encadenar el constructor base para inicializar el estado de la entidad
// 			super();
			parent::__construct();
			$this->MaxAlquileresPeliculas = 0;
			$this->MaxAlquileresSeries = 0;
			$this->Precio = 0.0;
			$this->imagen = null;
		}
		
// 		String
		protected $descripcion;
	
		public function getDescripcion() {
			return descripcion;
		}
	
		public function setDescripcion($descripcion) {
			$this->descripcion = descripcion;
			$this->setModificada();
		}
	
// 		int
		protected $MaxAlquileresPeliculas;
	
		public function getMaxAlquileresPeliculas() {
			return $this->MaxAlquileresPeliculas;
		}
	
		public function setMaxAlquileresPeliculas($maxAlquileresPeliculas) {
			$this->MaxAlquileresPeliculas = $maxAlquileresPeliculas;
			$this->setModificada();
		}
	
// 		int
		protected $MaxAlquileresSeries;
	
		public function getMaxAlquileresSeries() {
			return $this->MaxAlquileresSeries;
		}
	
		public function setMaxAlquileresSeries($maxAlquileresSeries) {
			$this->MaxAlquileresSeries = $maxAlquileresSeries;
			$this->setModificada();
		}
	
// 		double
		protected $Precio;
	
		public function getPrecio() {
			return $this->Precio;
		}
	
		public function setPrecio($precio) {
			$this->Precio = $precio;
			$this->setModificada();
		}
	
		//String
		// la url de la imagen a mostrar como presentacion
		protected $imagen= "";
	
		public function getImagen() {
			return $this->imagen;
		}
	
		public function setImagen($imagen) {
			$this->imagen = $imagen;
			$this->setModificada();
		}
	
// 		@Override
		public function toString() {
			return "Plan{"."id_plan=".$this->ID.", descripcion=".$this->descripcion.", MaxAlquileresPeliculas=".$this->MaxAlquileresPeliculas.", MaxAlquileresSeries=".$this->MaxAlquileresSeries.", Precio=".$this->Precio.'}';
		}
	
		static public function GetOne($id_plan)
		{
// 			Plan
			$p = null;
// 			MySQLAccess 
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$cstm = $mysql->IniciarStoredProc("CALL buscarplan(?)");
				$cstm->bindParam(1, $id_plan,\PDO::PARAM_INT);
// 				ResultSet 
				$flag = $cstm.execute();
				if ($flag){
					$rs = $cstm->fetchAll();
					$p = self::mapear($rs);
					$cstm->closeCursor();
					$cstm = null;
				} else {
					$errorMessage = $prepareStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
			} catch (\PDOException $ex)
			{
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $p;
		}
	
		static protected function mapear($rs)
		{
// 			Plan 
			$p = null;
// 			int 
			$id = MySQLAccess::GetSafeInt($rs, 1);
			//check if we found it
			if ($id == -1)
			{
				return null;
			}
			$p = new Plan();
			$p->setID(id);
			$p->setDescripcion(MySQLAccess.GetSafeString(rs, 2));
			$p->setMaxAlquileresPeliculas(MySQLAccess.GetSafeInt(rs, 3));
			$p->setMaxAlquileresSeries(MySQLAccess.GetSafeInt(rs, 4));
			$p->setPrecio(MySQLAccess.GetSafeDouble(rs, 5));
			$p->setImagen(MySQLAccess.GetSafeString(rs, 6));
			$p->setEstado(Estado.INTACTA);
			return $p;
		}
	
// 		@Override
// 		protected function OperacionesNuevo(MySQLAccess mysql, boolean block) throws SQLException
		protected function OperacionesNuevo($mysql, $block)
		{
// 			Connection 
			$connection = $mysql->getConnection();
// 			PreparedStatement
			$prepareStatement = $connection.prepare(
			"INSERT INTO ecinema.planes (`descripcion` , `maxalqpeliculas` , `maxalqseries` ,`precio`, `imagen`) VALUES (?, ?, ?, ?, ?);");
			$prepareStatement->bindParam(1, $this->descripcion,\PDO::PARAM_STR);
			$prepareStatement->bindParam(2, $this->MaxAlquileresPeliculas,\PDO::PARAM_INT);
			$prepareStatement->bindParam(3, $this->MaxAlquileresSeries,\PDO::PARAM_INT);
			$prepareStatement->bindParam(4, $this->Precio,\PDO::PARAM_);
			$prepareStatement->bindParam(5, $this->imagen,\PDO::PARAM_STR);
			$flag = $prepareStatement->execute();
			if ($flag) {
			// 			ResultSet 
// 			$generatedKeys = $prepareStatement->getGeneratedKeys();
				$generatedKeys = $connection->lastInsertId();
// 			if ($generatedKeys.next())
// 			{
				$this->ID = intval($generatedKeys);//.getInt(1);
// 			}
			} else {
				$errorMessage = $prepareStatement->errorInfo();
				throw new \PDOException($errorMessage[2], $errorMessage[1]);
			}

		}
	
// 		@Override
// 		protected void OperacionesModificar(MySQLAccess mysql, boolean block) throws SQLException
		protected function OperacionesModificar($mysql, $block) 
		{
// 			Connection 
			$connection = $mysql->getConnection();
// 			PreparedStatement 
			$prepareStatement = $connection->prepareStatement(
			"Update ecinema.planes SET descripcion=?, maxalqpeliculas=?, maxalqseries=?, precio=?, imagen=? WHERE id_plan=?;");
	
			$prepareStatement->bindParam(1, $this->descripcion,\PDO::PARAM_STR);
			$prepareStatement->bindParam(2, $this->MaxAlquileresPeliculas,\PDO::PARAM_INT);
			$prepareStatement->bindParam(3, $this->MaxAlquileresSeries,\PDO::PARAM_INT);
			$prepareStatement->bindParam(4, $this->Precio,\PDO::PARAM_);
			$prepareStatement->bindParam(5, $this->imagen,\PDO::PARAM_STR);
			$prepareStatement->bindParam(6, $this->ID,\PDO::PARAM_INT);
			if(!$prepareStatement->execute()){
				$errorMessage = $prepareStatement->errorInfo();
				throw new \PDOException($errorMessage[2], $errorMessage[1]);
			};
		}
	
		static public function getAll()
		{
// 			Collection<Plan> 
			$planes = new ArrayCollection();//ArrayList<Plan>();
// 			MySQLAccess 
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$cstm = $mysql->IniciarStoredProc("CALL listarplanes()");
				$flag = $cstm->execute();
// 				ResultSet
				if ($flag){
					$rs = $cstm->fechtAll();
					self::wrapEntidad($rs, $planes);
					$cstm->closeCursor();
					$cstm = null;
				} else {
					$errorMessage = $prepareStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
			}
			catch (\PDOException $ex)
			{
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $planes;
		}
	
		/**
		 * wrapEntidad: LLeno una lista de entidades a partir de los datos del ResultSet.
		 */
// 		static public void wrapEntidad(ResultSet rs, Collection<Plan> lista) throws SQLException
		static public function wrapEntidad($rs, $lista) 
		{
// 			Plan 
			$c = null;
			while ($rs->next())
			{
				try {
					$c = $this->mapear($rs);
					if (isset($c)) {
						$lista->set($c->ID, $c);
					}
				} catch (\Exception $ex) {
					print_r("Error armando lista de entidades: %s\n", $ex->getMessage());
				}
			}
		}
	
// 		@Override
// 		protected void OperacionesEliminar(MySQLAccess mysql, boolean block) throws SQLException
		protected function OperacionesEliminar($mysql, $block) 
		{
// 			Connection 
			$connection = $mysql->getConnection();
// 			PreparedStatement 
			$prepareStatement = $connection->prepare("Update ecinema.planes SET borrado=? WHERE id_plan=?;");
			$prepareStatement->bindParam(1, true,\PDO::PARAM_BOOL);
			$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
			if(!$prepareStatement->execute()){
				$errorMessage = $prepareStatement->errorInfo();
				throw new \PDOException($errorMessage[2], $errorMessage[1]);
			};
		}
	
		public function getCantUsuarios()
		{
			//int 
			$res = 0;
// 			MySQLAccess 
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$Statement = $mysql->IniciarStoredProc("{CALL getusuariosplan(?)}");
				$Statement->bindParam(1, $this->getID(),\PDO::PARAM_INT);
// 				ResultSet 
				$flag = $Statement->execute();
				if ($flag){
					$result = $Statement->fetchAll();
					// si el resultset esta vacio entonces es 0
					if (result.next())
					{
						$res = $result->getInt(1);
					}
					else
					{
						$res = 0;
					}
				} else {
					$errorMessage = $prepareStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
				$mysql->close();
			} catch (\PDOException $e) {
				print_r("error obteniendo usuarios del plan: %s\n", $e->getMessage());
				$res = 0;
			}
			return $res;
		}
	}
}
?>