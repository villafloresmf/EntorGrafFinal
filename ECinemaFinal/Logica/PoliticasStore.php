<?php
namespace ECinema\Datos {
	use ECinema\Datos\MySQLAccess;

	class PoliticasStore {
	
		/**
		 * getPoliticaInt:
		 * Busca una politica guardada en la tabla de Politicas.
		 * @param politica: Nombre de la politica
		 * @param default_value: Valor por defecto en caso de no encontrar la politica
		 * @return el valor de una Politica
		 */
// 		public static int getPoliticaInt(String politica, int default_value)
		public static function getPoliticaInt($politica, $default_value)
		{
// 			int 
			$res;
// 			MySQLAccess
			$mysql = new MySQLAccess();
			try {
				$mysql->iniciartransacion();
// 				Connection 
				$connection = $mysql->getConnection();
// 				PreparedStatement 
				$prepareStatement = $connection->prepare("SELECT valor FROM politicas WHERE descripcion = ?;");
				$prepareStatement->bindParam(1, $politica,\PDO::PARAM_STR);
// 				ResultSet 
				$flag = $prepareStatement->execute();
				if ($flag) {
					$result = $prepareStatement->fetchAll();
					$res = $result->getInt(1);
					$result->closeCursor();
					$mysql->finalizartransacion();
				} else {
					$errorMessage = $prepareStatement->errorInfo();
					throw new \PDOException($errorMessage[2], $errorMessage[1]);
				}
			} catch (\PDOException $e) {
				print_r("Error obteniendo politica: %s\n", $e->getMessage());
				$res = $default_value;
			}
			return $res;
		}
	}
}
?>