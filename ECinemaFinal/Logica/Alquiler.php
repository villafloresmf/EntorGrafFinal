<?php
namespace ECinema\Datos {
	include_once ('Entidad.php');
	include_once ('CrossCutting/ArrayCollection.php');
	

	class Alquiler extends Entidad {	
		
// 		public Alquiler(int idusuario, int idContenido, Date fechaAlquiler){
		public function __construct($idusuario, $idContenido, $fechaAlquiler){
// 			super();
			parent::__construct();
			$this->idUsuario = $idusuario;
			$this->fechaAlquiler = $fechaAlquiler;
			$this->idContenido = $idContenido;
		}
	
// 		int
		private $idUsuario;
	
		public function getIdUsuario() {
			return $this->idUsuario;
		}
	
		public function setIdUsuario($idUsuario) {
			$this->idUsuario = $idUsuario;
		}
	
// 		int
		private $idContenido;
	
		public function getIdContenido() {
			return $this->idContenido;
		}
	
		public function setIdContenido($idContenido) {
			$this->idContenido = $idContenido;
		}
	
// 		Date
		private $fechaAlquiler;
	
		public function getFechaAlquiler() {
			return $this->fechaAlquiler;
		}
	
		public function setFechaAlquiler($fechaAlquiler) {
			$this->fechaAlquiler = $fechaAlquiler;
		}
	
// 		@Override
// 		protected void OperacionesNuevo(MySQLAccess mysql, boolean block) throws SQLException
		protected function OperacionesNuevo($mysql, $block)
		{
			try {
// 				Connection 
				$connection = $mysql->getConnection();
// 				PreparedStatement 
				$prepareStatement = $connection->prepare("INSERT INTO ecinema.alquileres (id_usuario, id_contenido, fecha_alquiler) VALUES (?, ?, ?);");
				$prepareStatement->bindParam(1, $this->idUsuario,\PDO::PARAM_INT);
				$prepareStatement->bindParam(2, $this->idContenido,\PDO::PARAM_INT);
				$prepareStatement->bindParam(3, $this->fechaAlquiler->format('Y-m-d'),\PDO::PARAM_STR);
				$flag = $prepareStatement->execute();
				if ($flag){
//	 				ResultSet
// 					$generatedKeys = $prepareStatement->getGeneratedKeys();
					$generatedKeys = $connection->lastInsertId();
// 					if ($generatedKeys.next())
// 					{
// 						$this->ID = $generatedKeys->getInt(1);
					$this->ID = intval($generatedKeys);
// 					}	
				 } else {
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