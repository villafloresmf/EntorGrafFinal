<?php
namespace ECinema\Negocio {
	//use ECinema\Datos;
	include_once('Entidad.php');
	use ECinema\Datos\Estado;
	
	class EntidadLogica {
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
		
		//protected java.Datos.Entidad datosEntidad;
		protected $datosEntidad;
	
		//protected int ID;
		protected $ID;
	
		public function getID() {
			return $this->ID;
		}
	
		public function setID($ID) {
			$this->ID = $ID;
		}
	
		function __construct0(){
			
		}
		
		function __construct1($entidad){
			$this->datosEntidad = $entidad;
			$this->refrescar();			
		}
	
		/**
		 * Carga datos de la entidad de negocio desde la entidad de datos
		 * @param entidad
		 */
		protected function refrescar()
		{
		}
	
		/**
		 * Guarda la entidad en la capa de datos
		 * @throws Exception
		 */
		public function Save()
		{			
			try {
				$this->validarGeneral();
				if ($this->datosEntidad->getEstado() == Estado::NUEVA)
				{
					$this->validarNuevo();
				}
				$this->actualizar();
				$this->datosEntidad->save();
				//actualizo el ID desde capa datos
				$this->ID = $this->datosEntidad->getID();
			} catch (\Exception $e) {
				throw $e;
			}
			
		}
	
		protected function validarNuevo() 
		{
		}
	
		protected function validarGeneral()
		{
		}
	
		/**
		 * actualiza la entidad de datos
		 * con los datos de la entidad de negocio
		 */
		protected function actualizar()
		{
		}
	
		/**
		 * marca la entidad para su borrado.
		 * para hacerlo efectivo se debe llamar al metodo guardar
		 */
		public function borrar0()
		{
			$this->datosEntidad->borrar(false);
		}
	
		/**
		 * marca la entidad para su borrado.
		 * para hacerlo efectivo se debe llamar al metodo guardar
		 * si parent es true borro toda la jerarquia, util para las series
		 */
		public function borrar1($parent)
		{
			$this->datosEntidad->borrar($parent);
		}
	}	
}


?>