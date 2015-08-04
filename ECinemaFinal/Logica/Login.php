<?php
namespace ECinema\Negocio {
	include_once ('UsuarioLogica.php');
	
	use ECinema\Negocio\UsuarioLogica;
	
	class Login {
	
// 		public function Login() {
		public function __construct() {
			$this->user = null;
			$this->ul = new UsuarioLogica();
		}
	
		// 		UsuarioLogica
		private $user;
		// 		UsuarioLogica
		private $ul;
		
		public function getUser() {
			return $this->user;
		}
	
// 		public void validar_login() throws LoginException {
		public function validar_login() {
			if (is_null($this->user)) {
				throw new LoginException("Usuario no logueado");
			}
		}
	
		/*
		 * LoguearUsuario
		 * logueo al usuario
		 */
// 		public UsuarioLogica LoguearUsuario(String email, String password) throws LoginException {
		public function LoguearUsuario($email, $password)  {
			try {
				UsuarioLogica::ValidarEmail($email);
				UsuarioLogica::ValidarPassword($password);
				//busco el usuario, si no lo encuentro tiro una exception
				$this->user = $this->ul.Buscar($email, $password);
				if (is_null($this->user)) {
					throw new LoginException("Nombre de Usuario o Contraseña Incorrecta");
				}
			} catch (\Exception $e) {
				$user = null;
				throw new LoginException($e->getMessage());
			}
			return $this->user;
		}
	}
}
?>