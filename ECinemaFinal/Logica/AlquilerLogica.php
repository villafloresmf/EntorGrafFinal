<?php
namespace ECinema\Negocio {
	include_once ('EntidadLogica.php');
	include_once ('Alquiler.php');
	use ECinema\Datos\Alquiler;
	
	class AlquilerLogica extends EntidadLogica {
	
// 		public AlquilerLogica (UsuarioLogica usuario, ContenidoLogica contenido, Date fechaAlquiler)
		public function __construct($usuario, $contenido, $fechaAlquiler)
		{
// 			super(new java.Datos.Alquiler($usuario->ID, $contenido->ID, $fechaAlquiler));
			parent::__construct(new Alquiler($usuario->ID, $contenido->ID, $fechaAlquiler));
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
		protected function actualizar()
		{
// 			Alquiler 
			$datauser = /*(Alquiler)*/ $this->datosentidad;
			$datauser->setID($this->getID());
			$datauser->setIdContenido($this->getIdContenido());
			$datauser->setIdUsuario($this->getIdUsuario());
			$datauser->setFechaAlquiler($this->getFechaAlquiler());
		}
	
// 		@Override
		protected function refrescar()
		{
// 			Alquiler
			$user = /*(Alquiler)*/ $this->datosentidad;
			$this->ID = $user->getID();
			$this->setIdContenido($user->getIdContenido());
			$this->setIdUsuario($user->getIdUsuario());
			$this->setFechaAlquiler($user->getFechaAlquiler());
		}
	}
	
}
?>