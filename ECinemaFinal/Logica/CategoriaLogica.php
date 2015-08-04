<?php
namespace ECinema\Negocio {
	include_once ("Categoria.php");
	include_once ('EntidadLogica.php');
	include_once ('CrossCutting/ArrayCollection.php');	
	use ECinema\CrossCutting\ArrayCollection;
	use ECinema\Datos\Categoria;
	
	class CategoriaLogica extends EntidadLogica {
		
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
	
		public function  __construct0() {
// 			super(new Categoria());
			parent::__construct1(new Categoria());
		}
	
		public function __construct1($categoria) {
// 			super(categoria);
			parent::__construct1($categoria);
		}
	
		//int
// 		protected $id_categoria;
	
// 		public function getIdCategoria() {
// 			return id_categoria;
// 		}
	
// 		public function setIdCategoria($id_categoria) {
// 			$this->id_categoria = $id_categoria;
// 		}
	
		protected $descripcion;
	
		//String
		public function getDescripcion() {
			return descripcion;
		}
	
		public function setDescripcion($descripcion) {
			$this->descripcion = $descripcion;
		}
	
		public function doPost(){
			
			// Obtener todas las categorias;
			
			return $this->ConvertListToJSONList($this->GetAll());
		}
		
		public function ConvertListToJSONList($list){
			$jSONObj = "[";
			foreach ($list as $item){
				$jSONObj .=  json_encode($item->datosEntidad) . ",";
			}
			$jSONObj = substr($jSONObj, 0,-1) .  "]";
			return $jSONObj;
		}
		
		
		//CategoriaLogica
		static public function Buscar($id)
		{
			$categoriaLogica = null;
			$categoriaData = Categoria::GetOne($id);
			if (isset($categoriaData))
			{
				$categoriaLogica = new CategoriaLogica($categoriaData);
			}
			return $categoriaLogica;
		}
	
		//CategoriaLogica
		static public function BuscarByDescripcion($desc)
		{
			$categoriaLogica = null;
			$categoriaData = Categoria::GetOneByDescripcion($desc);
			if (isset($categoriaData))
			{
				$categoriaLogica = new CategoriaLogica($categoriaData);
			}
			return $categoriaLogica;
		}
	
// 		@Override
		protected function validarNuevo()
		{
			try {
				if (is_null($this->descripcion)|| empty($this->descripcion))
				{
					throw new Exception("La categoria no tiene una descripcion\n");
				}	
			} catch (Exception $e) {
				throw $e;
			}
		}
	
// 		@Override
		protected function actualizar()
		{
// 			Categoria datacategoria = (Categoria) $this->datosentidad;
			$datacategoria = $this->datosEntidad;
			$datacategoria->setID($this->getID());
			$datacategoria->setDescripcion($this->getDescripcion());
		}
	
// 		@Override
		protected function refrescar()
		{
// 			Categoria datacategoria = (Categoria) $this->datosentidad;
			$datacategoria = $this->datosEntidad;
			$this->setID($datacategoria->getID());
			$this->setDescripcion($datacategoria->getDescripcion());
		}
	

		static public function GetAll()
		{
// 			Collection<Categoria> categorias = Categoria.getAll();
			$categorias = Categoria::getAll();
// 			Collection<CategoriaLogica> categoriaslogica = new ArrayList<CategoriaLogica>();
			$categoriaslogica = new ArrayCollection();
			/*Iterator<Categoria> $it = $categorias->getIterator();*/
// 			while ($it->hasNext())

			foreach ($categorias as $cat) {
				$pl = new CategoriaLogica($cat);
				$categoriaslogica->set($pl->ID,$pl);
			}
// 			while ($it->valid())
// 			{
//  				CategoriaLogica pl = new CategoriaLogica(it.next());
// 				$temps = $it->next();
// 				$pl = new CategoriaLogica();
// 				$categoriaslogica->set($pl->ID,$pl);
// 			}
			return $categoriaslogica;
		}
		
		//Collection<CategoriaLogica>
		static public function GetAllByIds(/*Collection<Integer>*/ $ids)
		{
// 			Collection<Categoria> categorias = Categoria.getAll($ids);
			$categorias = Categoria::getAllByIds($ids);
// 			Collection<CategoriaLogica> categoriaslogica = new ArrayList<CategoriaLogica>();
			$categoriaslogica = new ArrayCollection();
			/*Iterator<Categoria> $it = $categorias->getIterator(); */
			//while ($it->hasNext())
			foreach ($categorias as $it)
			{
// 				CategoriaLogica pl = new CategoriaLogica(it.next());
				$pl = new CategoriaLogica($it /*->next()*/);
				$categoriaslogica->set($pl->ID,$pl);
			}
			return $categoriaslogica;
		}
	}
	
	
}
?>