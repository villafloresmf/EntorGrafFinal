<?php
namespace ECinema\Datos {
	
	use ECinema\CrossCutting\ArrayCollection;
	use ECinema\Datos\TipoContenido;
	use ECinema\Datos\MySQLAccess;
	
	class Usuario extends Entidad {
	
// 		public Usuario()
		public function __construct()
		{
			//encadenar el constructor base para inicializar el estado de la entidad
// 			super();
			parent::__construct();
		}
				
// 		String
		protected $Nombre;
	
		public function getNombre() {
			return $this->Nombre;
		}
	
		public function setNombre($nombre) {
			$this->Nombre = $nombre;
			$this->setModificada();
		}
	
// 		String
		protected $Apellido;
	
		public function getApellido() {
			return $this->Apellido;
		}
	
		public function setApellido($apellido) {
			$this->Apellido = $apellido;
			$this->setModificada();
		}
	
// 		String
		protected $Password;
	
		public function getPassword() {
			return $this->Password;
		}
	
		public function setPassword($password) {
			$this->Password = $password;
			$this->setModificada();
		}
	
// 		String
		protected $email;
	
		public function getEmail() {
			return $this->email;
		}
	
		public function setEmail($eMail) {
			$this->email = $eMail;
			$this->setModificada();
		}
	
// 		String
		protected $tipo_doc;
	
		public function getTipoDoc() {
			return $this->tipo_doc;
		}
	
		public function setTipoDoc($tipoDoc) {
			$this->tipo_doc = $tipoDoc;
			$this->setModificada();
		}
	
// 		String
		protected $Nro_doc;
	
		public function getNroDoc() {
			return $this->Nro_doc;
		}
	
		public function setNroDoc($nroDoc) {
			$this->Nro_doc = $nroDoc;
			$this->setModificada();
		}
	
// 		int
		protected $id_plan;
	
		public function getIdPlan() {
			return $this->id_plan;
		}
	
		public function setIdPlan($idPlan) {
			$this->id_plan = $idPlan;
			$this->setModificada();
		}
	

	
// 		@Override
		public function toString() {
			return "Usuario{" + "ID=" + ID + ", NombreUsuario=" + email + '}';
		}
	
		/**
		 * GetOne
		 * @param nombreusuario
		 * @param password
		 * @return una nueva isntancia de Usuario si uno es encontrado,
		 * Null en otro caso
		 */
// 		static public Usuario GetOne(String nombreusuario, String password)
		static public function GetOne($nombreusuario, $password)
		{
// 			Usuario 
			$u = null;
// 			MySQLAccess 
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$cstm = $mysql->IniciarStoredProc("CALL loguear(?, ?)");
				$cstm->bindParam(1, $nombreusuario,\PDO::PARAM_STR);
				$cstm->bindParam(2, $password,\PDO::PARAM_STR);
// 				ResultSet
				if ($cstm->execute()){
					$rs = $cstm->fetchAll();
					$u = self::mapear($rs);
					$cstm->closeCursor();
					$cstm = null;
				} else {
					$errorMessage = $cstm->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}

			} catch (\PDOException $ex)
			{
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $u;
		}
	
// 		static public Usuario GetOne(String nombreusuario)
		static public function GetOne($nombreusuario)
		{
// 			Usuario 
			$u = null;
// 			MySQLAccess 
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$cstm = $mysql->IniciarStoredProc("CALL buscarnombreusuario(?)");
				$cstm->bindParam(1, $nombreusuario);
// 				ResultSet 
				$flag = $cstm->execute();
				if($flag){
					$rs = $cstm->fetchAll();
					$u = self::mapear($rs);
					$cstm->closeCursor();
					$cstm = null;
				} else {
					$errorMessage = $cstm->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}

			} catch (\PDOException $ex)
			{
				/*do nothing*/
				print_r($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $u;
		}
	
	
// 		static public Collection<Usuario> getAll()
		static public function getAll()
		{
// 			Collection<Usuario> users = new ArrayList<Usuario>();
			$users = new ArrayCollection();
// 			MySQLAccess 
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$cstm = $mysql->IniciarStoredProc("CALL listarusuarios()");

				if($cstm->execute()){
					// 				ResultSet
					$rs = $cstm->fetchAll();
					self::wrapEntidad($rs, $users);
					$cstm->closeCursor();
					$cstm = null;
				} else {
					$errorMessage = $cstm->errorInfo();
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
			return $users;
		}
	
// 		static protected Usuario mapear(ResultSet rs)
		static protected function mapear($rs)
		{
// 			Usuario 
			$u = null;
// 			int 
			$id = MySQLAccess::GetSafeInt($rs, 1);
			//check if we found it
			if ($id == -1)
			{
				return null;
			}
			$u = new Usuario();
			$u->setID($id);
			$u->setNombre(MySQLAccess.GetSafeString(rs, 2));
			$u->setApellido(MySQLAccess.GetSafeString(rs, 3));
			$u->setPassword(MySQLAccess.GetSafeString(rs, 4));
			$u->setEmail(MySQLAccess.GetSafeString(rs, 5));
			$u->setTipoDoc(MySQLAccess.GetSafeString(rs, 6));
			$u->setNroDoc(MySQLAccess.GetSafeString(rs, 7));
			$u->id_plan = MySQLAccess.GetSafeInt(rs, 8);
			$u->setEstado(Estado::INTACTA);
	
			return u;
		}
	
// 		@Override
// 		protected void OperacionesNuevo(MySQLAccess mysql, boolean block) throws SQLException
		protected function OperacionesNuevo($mysql, $block) 
		{
// 			Connection 
			$connection = $mysql->getConnection();
// 			PreparedStatement
			$prepareStatement = $connection->prepare(
			"INSERT INTO ecinema.usuarios (`nombre` , `apellido`,`password` , `email` ,`tipo_doc` ,`nro_doc`, `id_plan`) VALUES (?, ?, ?, ?, ?, ?, ?);");
	
			$prepareStatement->bindParam(1, $this->Nombre);
			$prepareStatement->bindParam(2, $this->Apellido);
			$prepareStatement->bindParam(3, $this->Password);
			$prepareStatement->bindParam(4, $this->email);
			$prepareStatement->bindParam(5, $this->tipo_doc);
			$prepareStatement->bindParam(6, $this->Nro_doc);
			$prepareStatement->bindParam(7, $this->id_plan);
			if($prepareStatement->executeUpdate()){
// 				ResultSet
// 				$generatedKeys = prepareStatement.getGeneratedKeys();
				$generatedKeys = $connection->lastInsertId();
// 				if ($generatedKeys.next())
// 				{
				$this->ID = intval($generatedKeys);
// 				}
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
			$prepareStatement = $connection->prepare(
			"Update ecinema.usuarios SET nombre=?, apellido= ?, password=?, email=?, tipo_doc=?, nro_doc=?, id_plan=? WHERE id_usuario=?;");
			$prepareStatement->bindParam(1, $this->Nombre,\PDO::PARAM_STR);
			$prepareStatement->bindParam(2, $this->Apellido,\PDO::PARAM_STR);
			$prepareStatement->bindParam(3, $this->Password,\PDO::PARAM_STR);
			$prepareStatement->bindParam(4, $this->email,\PDO::PARAM_STR);
			$prepareStatement->bindParam(5, $this->tipo_doc,\PDO::PARAM_STR);
			$prepareStatement->bindParam(6, $this->Nro_doc,\PDO::PARAM_STR);
			$prepareStatement->bindParam(7, $this->id_plan,\PDO::PARAM_INT);
			$prepareStatement->bindParam(8, $this->ID,\PDO::PARAM_INT);
			if(!($prepareStatement->execute())){
				$errorMessage = $prepareStatement->errorInfo();
				throw new \PDOException($errorMessage[2], $errorMessage[1]);
			} 
		}
	
// 		public int getAlquileresMes(TipoContenido tipo, Date fechaActual)
		public function getAlquileresMes($tipo, $fechaActual)
		{
// 			int 
			$res;
// 			MySQLAccess
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement 
				$Statement = $mysql->IniciarStoredProc("CALL getAlquileresMes(?,?,?)");
				$Statement->bindParam(1, $tipo->name(),\PDO::PARAM_STR);
				$Statement->bindParam(2, $this->getMonth($fechaActual),PDO::PARAM_INT);
				$Statement->bindParam(3, $this->getEmail(),\PDO::PARAM_STR);
				if($Statement->execute()){
//	 				ResultSet
					$result = $Statement->fetchAll();
					
					// si el resultset esta vacio entonces es 0
					if ($result.next())
					{
						$res = $result->getInt(1);
					}
					else
					{
						$res = 0;
					}
				} else {
					$errorMessage = $Statement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
			} catch (\PDOException $ex) {
				print_r("error obteniendo alquileres: %s\n", $ex->getMessage());
				$res = 0;
			}
			finally {
				$mysql->close();
			}
			return $res;
		}
	
		
// 		private int getMonth(Date fechaActual) {
		private function getMonth($fechaActual) {
			// obtener el mes
// 			GregorianCalendar
			$calendar = new GregorianCalendar();
			$calendar->setTime(fechaActual);
// 			int
			$month = $calendar->get(Calendar.MONTH) + 1;
			return $month;
		}
	
		/**
		 * wrapEntidad: LLeno una lista de entidades a partir de los datos del ResultSet.
		 */
// 		static public void wrapEntidad(ResultSet rs, Collection<Usuario> lista) throws SQLException
		static public function wrapEntidad($rs,$lista) 
		{
// 			Usuario
			$c = null;
			while ($rs->next())
			{
				try {
					$c = self::mapear($rs);
					if (isset($c)) {
						$lista->set($c->ID,$c);
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
			$prepareStatement = $connection->prepare("Update ecinema.usuarios SET borrado=? WHERE id_usuario=?;");
			$prepareStatement->bindParam(1, true,\PDO::PARAM_BOOL);
			$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
			if(!$prepareStatement->execute()){
				$errorMessage = $prepareStatement->errorInfo();
				throw new \PDOException($errorMessage[2], $errorMessage[1]);
			};
		}
	}
}
?>