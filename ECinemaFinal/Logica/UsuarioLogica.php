<?php
namespace ECinema\Negocio {
	include_once ('EntidadLogica.php');
	include_once ('PlanLogica.php');
	include_once ('CrossCutting/ArrayCollection.php');
	include_once ('Usuario.php');
	
	use ECinema\Datos\Usuario;
	use ECinema\Negocio\PlanLogica;
	use ECinema\CrossCutting\ArrayCollection;
	
	class UsuarioLogica extends EntidadLogica {
		
		public function __construct(){
			$params = func_get_args();
			$num_params = func_num_args();
			//atendiendo al siguiente modelo __construct1() __construct2()...
			$funcion_constructor ='__construct'.$num_params;
			//compruebo si hay un constructor con ese n�mero de par�metros
			if (method_exists($this,$funcion_constructor)) {
				call_user_func_array(array($this,$funcion_constructor),$params);
			}
		}
		
// 		public UsuarioLogica()
		public function __construct0()
		{
// 			super(new java.Datos.Usuario());
			parent::__construct1(new Usuario());
		}
	
// 		public UsuarioLogica(Usuario user)
		public function __construct1($user)
		{
// 			super(user);
			parent::__construct1($user);
		}
	
// 		String
		protected $Nombre;
	
// 		String
		public function getNombre() {
			return $this->Nombre;
		}
	
		public function setNombre(/* String*/ $nombre) {
			$this->Nombre = $nombre;
		}
	
// 		boolean
		public function es_admin(){
			return $this->Nombre.equals("admin");
		}
	
// 		String
		protected $Apellido;
	
		public function getApellido() {
			return $this->Apellido;
		}
	
		public function setApellido(/* String */ $apellido) {
			$this->Apellido = $apellido;
		}
	
// 		String
		protected $Password;
	
		public function getPassword() {
			return $this->Password;
		}
	
		public function setPassword(/* String */ $password) {
			$this->Password = $password;
		}
	
// 		String
		protected $email;
	
		public function getEmail() {
			return $this->email;
		}
	
		public function setEmail(/* String */ $eMail) {
			$this->email = $eMail;
		}
	
// 		String
		protected $tipo_doc;
	
		public function getTipoDoc() {
			return $this->tipo_doc;
		}
	
		public function setTipoDoc(/* String */ $tipoDoc) {
			$this->tipo_doc = $tipoDoc;
		}
	
// 		String
		protected $Nro_doc;
	
		public function getNroDoc() {
			return $this->Nro_doc;
		}
	
		public function setNroDoc(/* String */ $nro_doc) {
			$this->Nro_doc = $nro_doc;
		}
	
// 		PlanLogica
		public $plan;
	
		public function getPlan() {
			//cargar plan en modo lazy
			if (is_null($this->plan) && $this->getIdPlan() != -1)
			{
				$this->plan = PlanLogica::Buscar($this->getIdPlan());
			}
			return $this->plan;
		}
	
		public function setPlan(/* PlanLogica */ $plan) {
			/* mantener la integridad */
			$this->plan = $plan;
			$this->id_plan = $plan->getID();
		}
	
// 		int
		protected $id_plan;
	
		public function getIdPlan() {
			return $this->id_plan;
		}
	
		public function setIdPlan(/* int */ $idPlan) {
			$this->id_plan = $idPlan;
			//pongo en null para que sea cargado la proxima ves que lo use
			$this->plan = null;
		}
	
// 		static public boolean ValidarEmail(String email) throws LoginException, Exception
		static public function ValidarEmail($email)
		{
			if (!$email->matches("[^\\s$#\"%&()=?¡¿'!¬+;~¨:<>{}\\[\\]]+[@{1}][a-z]+[.{1}]([a-z]{2,3})")) {
				throw new LoginException("Error en el formato del e-mail.");
			}
			return true;
		}
	
		static public function getPasswordMinimo() {
			return PoliticasStore.getPoliticaInt("Passlenght", 8);
		}
	
// 		static public boolean ValidarPassword(String pin) throws LoginException {
		static public function ValidarPassword(/* String */ $pin) {	
			//int 
			$passlength = PoliticasStore.getPoliticaInt("Passlenght", 8);
			if ($pin->length() < $passlength) {
				throw new LoginException("El password debe tener 8 caracteres minimo");
			}
			return true;
		}
	
// 		protected void validarGeneral() throws Exception
		protected function validarGeneral() 
		{
			UsuarioLogica::ValidarEmail($this->getEmail());
			UsuarioLogica::ValidarPassword($this->getPassword());
			if (is_null($this->Nombre) || empty($this->Nombre))
			{
				throw new \Exception("El usuario debe tener un nombre\n");
			}
			if (is_null($this->Apellido) || empty($this->Apellido))
			{
				throw new \Exception("El usuario debe tener un apellido\n");
			}
			if (is_null($this->Nro_doc) || empty($this->Nro_doc))
			{
				throw new \Exception("El usuario debe tener un nro de documento\n");
			}
			if (is_null($this->tipo_doc)|| empty($this->tipo_doc))
			{
				throw new \Exception("El usuario debe tener un tipo de documento\n");
			}
		}
	
// 		@Override
// 		protected void validarNuevo() throws Exception
		protected function validarNuevo() 
		{
			//validar que no exista un usuario con el mismo nombre de usuario o email
// 			Usuario 
			$u1 = Usuario::GetOne(this.getEmail());
			if (isset($u1))
			{
				throw new \Exception("Nombre de Usuario ya registrado");
			}
		}
	
		public function Buscar(/* String */ $nombreUsuario, /* String */ $password)
		{
// 			UsuarioLogica 
			$ul = null;
			$this->datosentidad = Usuario::GetOne($nombreUsuario, $password);
			if (isset($this->datosentidad))
			{
// 				$ul = new UsuarioLogica((Usuario) datosentidad);
				$ul = new UsuarioLogica($this->datosentidad);
			}
			return $ul;
		}
	
// 		@Override
		protected function actualizar()
		{
// 			Usuario
			$datauser = /*(Usuario)*/ $this->datosentidad;
			$datauser->setID($this->getID());
			$datauser->setNombre($this->getNombre());
			$datauser->setApellido($this->getApellido());
			$datauser->setPassword($this->getPassword());
			$datauser->setEmail($this->getEmail());
			$datauser->setNroDoc($this->getNroDoc());
			$datauser->setTipoDoc($this->getTipoDoc());
			$datauser->setIdPlan($this->getIdPlan());
		}
	
// 		@Override
		protected function refrescar()
		{
// 			Usuario 
			$user = /*(Usuario)*/ $this->datosentidad;
			$this->ID = $user->getID();
			$this->Nombre = $user->getNombre();
			$this->Apellido = $user->getApellido();
			$this->Password = $user->getPassword();
			$this->email = $user->getEmail();
			$this->tipo_doc = $user->getNroDoc();
			$this->Nro_doc = $user->getNroDoc();
			$this->setIdPlan($user->getIdPlan());
		}
	
// 		public void alquilar(ContenidoLogica contenido) throws Exception
		public function alquilar($contenido)
		{
// 			Date 
			$fecha_alquiler = new \DateTime('NOW');
			if ($this->puedeAlquilar($contenido, $fecha_alquiler))
			{
// 				AlquilerLogica 
				$alq = new AlquilerLogica($this, $contenido, $fecha_alquiler);
				$alq->Save();
			}
			else
			{
				throw new \Exception("Limite de alquileres mensuales excedido\n");
			}
		}
	
		//boolean
		private function puedeAlquilar(/* ContenidoLogica */ $contenido, /* Date */ $fecha_alquiler)
		{
			//el administrador siempre puede alquilar
			if ($this->es_admin()){
				return true;
			}
			return $this->getAlquileresRestantesConFecha($contenido, $fecha_alquiler) > 0;
		}
	
		//int
		public function getAlquileresRestantes(/* ContenidoLogica */ $contenido)
		{
// 			Date
			$fecha_alquiler = new \DateTime('NOW');
			return $this->getAlquileresRestantesConFecha($contenido, $fecha_alquiler);
		}
	
		//int
		public function getAlquileresRestantesConFecha(/* ContenidoLogica */ $contenido, /* Date */ $fecha_alquiler)
		{
// 			Usuario 
			$user = /*(Usuario)*/ $this->datosentidad;
// 			int 
			$alq = $user->getAlquileresMes($contenido->getTipo(), $fecha_alquiler);
// 			int 
			$max = $this->getPlan()->getMaxAlquileres($contenido->getTipo());
// 			int 
			$restantes = $max - $alq;
			return $restantes;
		}
	}
}
?>