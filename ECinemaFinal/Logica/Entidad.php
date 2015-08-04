<?php

namespace ECinema\Datos {

	abstract class Estado {
		const INTACTA = 0;
		const NUEVA = 1;
		const MODIFICADA = 2;
		const BORRADA = 3;
	}
	class Entidad implements \JsonSerializable {
		protected $ID = 0;
		/* estado de las entidades */
		protected $estado;
		public function __construct() {
			$this->estado = Estado::NUEVA;
			$this->ID = - 1;
		}
		public function getEstado() {
			return $this->estado;
		}
		public function setEstado($estado) {
			$this->estado = $estado;
		}
		public function getID() {
			return $this->ID;
		}
		public function setID($ID) {
			$this->ID = $ID;
		}
		
		/**
		 * marca la entidad para su borrado.
		 * para hacerlo efectivo se debe llamar al metodo guardar
		 * si parent es true borro toda la jerarquia, util para las series
		 */
		public function borrar() {
			$this->setEstado ( Estado::BORRADA );
		}
		public function setModificada() {
			// comprimo eventos de cambios. Esto omite eventos de modificacion que no son relevantes
			if (($this->estado != Estado::NUEVA) && ($this->estado != Estado::BORRADA)) {
				$this->estado = Estado::MODIFICADA;
			}
		}
		public function jsonSerialize() {
		}
		
		/**
		 * inicio transacion
		 * ->guardo entidad principal
		 * ->itero miembros
		 * -->guardo miembro
		 * ->commit
		 * fin transacion
		 * cada uno tiene su api .save
		 * save tiene dos modos (con bloqueo y sin bloqueo)
		 * solo la entidad toplevel bloquea
		 * el metodo save elije las tres operaciones automaticamente de acuerdo al estado
		 * Cada operacion tiene una funcion que las clases deben sobreescribir para agregar sus acciones a la misma
		 */
		public function save() /* throws Exception */{
			/* MySQLAccess */
			$mysql = new MySQLAccess();
			$this->save2($mysql,true);
		}
		
		public function save2(/*MySQLAccess*/ $mysql, /*boolean*/ $block) /* throws Exception */{
			try {
				switch ($this->estado) {
					case Estado::NUEVA :
						$this->nuevo( $mysql, $block );
						break;
					case Estado::BORRADA :
						$this->eliminar($mysql,$block);
						break;
					case Estado::MODIFICADA :
						$this->modificar($mysql,$block);
						break;
					default:
		 			/*unmodified*/
		 			break;
				}
				// actualizo el estado
				$this->setEstado ( Estado::INTACTA );
			} catch ( \PDOException $ex ) {
				throw new \Exception( "La entidad no se pudo guardar. Error interno: " . $ex->getMessage());
			}
		}
		
		protected function nuevo(/*MySQLAccess*/ $mysql, /*boolean*/ $block) {
			try {
				if ($block) {
					$mysql->iniciartransacion();
				}
				$this->OperacionesNuevo($mysql,$block);
				if ($block) {
					$mysql->finalizartransacion();
				}
			} catch ( \PDOException $ex ) {
				$mysql->executerollback();
				print_r($ex->getMessage());
				throw $ex;
			}
		}
		
		/**
		 * aniado todas las operaciones del alta de una entidad
		 *
		 * @param
		 *        	mysql
		 * @param
		 *        	e
		 * @param
		 *        	block
		 * @throws SQLException
		 */
		protected function OperacionesNuevo(/* MySQLAccess */ $mysql, /*boolean*/ $block) /* throws SQLException */
		{
		}
		
		protected function modificar(/*MySQLAccess*/ $mysql, /*boolean*/ $block) /*throws SQLException*/
		{
			try {
				if ($block) {
					$mysql->iniciartransacion();
				}
				$this->OperacionesModificar($mysql, $block);
				if ($block) {
					$mysql->finalizartransacion();
				}
			} catch ( \PDOException $ex ) {
				print_r($ex->getMessage()) ;
				$mysql->executerollback();
				throw $ex;
			}
		}
		
		protected function OperacionesModificar(/*MySQLAccess*/ $mysql,/* boolean */$block) /* throws SQLException*/
		{
		}
		
		protected function eliminar(/*MySQLAccess*/ $mysql, /*boolean*/ $block) /* throws SQLException*/
		{
			try {
				if ($block) {
					$mysql->iniciartransacion();
				}
				$this->OperacionesEliminar($mysql,$block);
				if ($block) {
					$mysql->finalizartransacion();
				}
			} catch ( \PDOException $ex ) {
				$mysql->executerollback();
				print_r($ex->getMessage()) ;
				throw $ex;
			}
		}
		
		protected function OperacionesEliminar(/*MySQLAccess */ $mysql, /*boolean*/ $block) /* throws SQLException*/
		{
		}
	}
}
?>