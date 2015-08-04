<?php
namespace ECinema\Datos {
	
	class MySQLAccess {
		
		private /* Connection */ $connect = null;
		private /* ResultSet */ $resultSet = null;
		private /* String */ $ConectionString = 'mysql:host=localhost;dbname=ecinema';
	
		//public MySQLAccess () {
		public function __construct(){
			// cargar el driver mysql
			
// 			$this->link = mysql_connect("localhost","root");
// 			mysql_select_db("ecinema",$this->link);
			
// 			try {
// 				Class.forName("com.mysql.jdbc.Driver");
// 			} catch (ClassNotFoundException $e) {
// 				$e.printStackTrace();
// 			}
		}
	
		private function setupConection(/*String $ConectionString */)  {
			try {
				if (is_null($this->connect))
				{
// 					$this->connect = DriverManager.getConnection($ConectionString);
					//$this->connect = mysql_connect("localhost","root");
					$this->connect = new \PDO($this->ConectionString,'root','');
					//mysql_select_db("ecinema",$this->connect);
// 					if ( $e) {
// 						throw new \mysqli_sql_exception($message, $code, $previous);
// 					}
				} 
			} catch (PDOException $e) {
				throw $e;
			}
		}
	
// 		public java.sql.CallableStatement IniciarStoredProc(String $sqlstring) throws SQLException
		public function IniciarStoredProc($sqlstring)
		{
			/* java.sql.CallableStatemen */ $cStmt = null;
			try {
				$this->setupConection(/*$this->ConectionString*/);
				//$cStmt = $this->connect.prepareCall($sqlstring);
				//$cStmt = mysql_stmt_init($this->connect);
			
				//Opcion 1
				//$cStmt = $this->connect->prepare($sqlstring);
					
				//Opcion 2
				//mysql_stmt_prepare($cStmt,$sqlstring);
				
				$cStmt = $this->connect->prepare($sqlstring);
			} catch (\PDOException $e) {
				throw $e;
			}
			return $cStmt;
		}
		
		public function close() {
			try {
				if (isset($this->resultSet)) {
					$this->resultSet->close();
					$this->resultSet = null;
				}
				if (!(is_null($this->connect))) {
					// Cerrar la conexion
					$this->connection = null; //close();
					// 					connect.close();
					// 					connect = null;
				}
			} catch (Exception $e) {
				System.err.printf("Error cerrrando coneccion. %s\n", $e->getMessage());
			}
		}		
		
		/* Metodos para transaciones */
		public function iniciartransacion()
		{
			try {
				$this->setupConection(/*$this->ConectionString*/);
				$this->connect->setAttribute(\PDO::ATTR_AUTOCOMMIT, false);//setAutoCommit(false);
				$this->connect->beginTransaction();
			} catch (\PDOException $e) {
				throw $e;
			}
		}

		public function finalizartransacion()
		{
			try {				
				$this->connect->commit();
			} catch (\PDOException $e) {
				print_r($e->getMessage());
				$this->executerollback();
				throw $e;
			} finally {
				$this->close();
			}
		}		
		
		public function executerollback()
		{
			if (isset($this->connect))
			{
				try {
					$this->connect->rollBack();
				} catch (\PDOException $ex) {
					print_r("Error en transaccion. Ejecutando Rollback\n");
				} finally {
					$this->close();
				}
			}
		}
	
		public function getConnection()
		{
			return $this->connect;
		}
	
// 		public static String GetSafeString(ResultSet rs, int index)
		public static function GetSafeString($rs, $index)
		{
			/*String*/ $s = "";
			try {
				if (count($rs) > 0){
// 					$s = $rs->getString($index);
					$s = $rs[$index];
				}
			} catch (\PDOException $ex) {
			}
			return $s;
		}	
		
// 		public static int GetSafeInt(ResultSet rs, int index)
		public static function GetSafeInt($rs, $index)
		{
			/*int*/ $i = -1;
			try {
// 				$i = $rs.getInt($index);
				if (count($rs) > 0){
					$i = intval($rs[$index]);
				}
			} catch (Exception $ex) {
			}
			return $i;
		}

// 		public static Double GetSafeDouble(ResultSet rs, int index)
		public static function GetSafeDouble($rs,$index)
		{
			/*Double*/ $i = 0.0;
			try {
				if (count($rs) > 0){
// 					$i = $rs.getDouble($index);
					$i = $rs[$index];
				}
			} catch (\Exception $ex) {
			}
			return $i;
		}		
		
	}
}

?>