<?php
namespace ECinema\Negocio {
	include_once ('EntidadLogica.php');
	include_once ('TipoContenido.php');
	include_once ('Plan.php');
	
	use ECinema\Datos\TipoContenido;
	use ECinema\Datos\Plan;
	
	class PlanLogica extends EntidadLogica {
		
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
	
// 		public PlanLogica() {
		public function __construct0() {
// 			super(new java.Datos.Plan());
			parent::__construct(new Plan());
		}
	
// 		private PlanLogica(java.Datos.Plan plan) {
		private function __construct1($plan) {
// 			super(plan);
			parent::__construct($plan);
		}
	
// 		String
		protected $descripcion;
	
		public function getDescripcion() {
			return $this->descripcion;
		}
	
// 		public void setDescripcion(String descripcion) {
		public function setDescripcion($descripcion) {
			$this->descripcion = $descripcion;
		}
	
// 		int
		protected $MaxAlquileresPeliculas;
	
		public function getMaxAlquileresPeliculas() {
			return $this->MaxAlquileresPeliculas;
		}
	
// 		public void setMaxAlquileresPeliculas(int MaxAlquileresPeliculas) {
		public function setMaxAlquileresPeliculas($maxAlquileresPeliculas) {
			$this->MaxAlquileresPeliculas = $maxAlquileresPeliculas;
		}
	
// 		int
		protected $MaxAlquileresSeries;
	
		public function getMaxAlquileresSeries() {
			return $this->MaxAlquileresSeries;
		}
	
// 		public void setMaxAlquileresSeries(int MaxAlquileresSeries) {
		public function setMaxAlquileresSeries($maxAlquileresSeries) {
			$this->MaxAlquileresSeries = $maxAlquileresSeries;
		}
	
// 		double
		protected  $Precio;
	
		public function getPrecio() {
			return $this->Precio;
		}
	
// 		public void setPrecio(double Precio) {
		public function setPrecio($precio) {
			$this->Precio = $precio;
		}
	
		// la url de la imagen a mostrar como presentacion
// 		String
		protected  $imagen= "";
	
		public function getImagen() {
// 			Plan 
			$dataplan = /*(Plan)*/ $this->datosentidad;
			return $dataplan->getImagen();
		}
	
// 		public void setImagen(String imagen) {
		public function setImagen($imagen) {
			$this->imagen = $imagen;
		}
	
// 		static public PlanLogica Buscar(int id)
		static public function Buscar($id)
		{
// 			PlanLogica 
			$pl = null;
// 			Plan 
			$p = Plan::GetOne($id);
			if (isset($p))
			{
				$pl = new PlanLogica($p);
			}
			return $pl;
		}
	
// 		@Override
// 		protected void validarNuevo() throws Exception
		protected function validarNuevo() 
		{
			try {
				if (is_null($this->descripcion) || empty($this->descripcion)) 
				{
					throw new \Exception("El plan no tiene una descripcion\n");
				}
			} catch (\Exception $e) {
				throw $e;
			}

		}
	
// 		@Override
		protected function actualizar()
		{
// 			Plan 
			$dataplan = /*(Plan)*/ $this->datosentidad;
			$dataplan->setID($this->getID());
			$dataplan->setDescripcion($this->getDescripcion());
			$dataplan->setMaxAlquileresPeliculas($this->getMaxAlquileresPeliculas());
			$dataplan->setMaxAlquileresSeries($this->getMaxAlquileresSeries());
			$dataplan->setPrecio($this->getPrecio());
			$dataplan->setImagen($this->getImagen());
		}
	
// 		@Override
		protected function refrescar()
		{
// 			Plan 
			$dataplan = /*(Plan)*/ $this->datosentidad;
			$this->setID($dataplan->getID());
			$this->setDescripcion($dataplan->getDescripcion());
			$this->setMaxAlquileresPeliculas($dataplan->getMaxAlquileresPeliculas());
			$this->setMaxAlquileresSeries($dataplan->getMaxAlquileresSeries());
			$this->setPrecio($dataplan->getPrecio());
			$this->setImagen($dataplan->getImagen());
		}
	
// 		static public Collection<PlanLogica> GetAll()
		static public function GetAll()
		{
// 			Collection<Plan> 
			$planes = Plan::getAll();
// 			Collection<PlanLogica> planeslogica = new ArrayList<PlanLogica>();
			$planeslogica = new ArrayCollection();
// 			Iterator<Plan> it = planes.iterator();
// 			while (it.hasNext())
			foreach ($planes as $plan)
			{
// 				PlanLogica 
				$pl = new PlanLogica($plan /*it.next()*/);
// 				planeslogica.add(pl);
				$planeslogica->set($pl->ID,$pl);
			}
			return $planeslogica;
		}
	
// 		public int getMaxAlquileres(TipoContenido tipo)
		public function getMaxAlquileres($tipo)
		{
// 			int 
			$result;
			if ($tipo == TipoContenido::PELICULA)
			{
				$result = $this->getMaxAlquileresPeliculas();
			}
			else if ($tipo == TipoContenido::SERIE)
			{
				$result = $this->getMaxAlquileresSeries();
			}
			else
			{
				$result = 0;
				print_r("Tipo de contenido no encontrado\n");
			}
			return $result;
		}
	
		/**
		 * getCantUsuarios
		 * devuelve la cantidad de usuarios con el plan
		 * @return
		 */
// 		public int getCantUsuarios()
		public function getCantUsuarios()
		{
// 			Plan 
			$dataplan = /*(Plan)*/ $this->datosentidad;
			return $dataplan->getCantUsuarios();
		}
	}
}
?>