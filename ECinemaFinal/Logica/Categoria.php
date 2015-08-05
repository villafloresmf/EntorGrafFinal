<?php
namespace ECinema\Datos {
	include_once ('Entidad.php');
	include_once ('CrossCutting/ArrayCollection.php');
	include_once ('MySQLAccess.php');
	use ECinema\Datos\Estado;	
	use ECinema\CrossCutting\ArrayCollection;
	use ECinema\Datos\MetaContenido;
	
	class Categoria extends Entidad {
		public function __construct() {
// 			super();
			parent::__construct();
			$this->descripcion = "";
		}
		
		//int
// 		protected $id_categoria;
	
		//int
// 		public function getIdCategoria() {
// 			return $this->id_categoria;
// 		}
	
// 		public function setIdCategoria($id_categoria) {
// 			$this->id_categoria = $id_categoria;
// 			$this->setModificada();
// 		}
	
		//String
		protected $descripcion;
	
		//String
		public function getDescripcion() {
			return $this->descripcion;
		}
	
		//String
		public function setDescripcion($descripcion) {
			$this->descripcion = $descripcion;
			$this->setModificada();
		}
	
// 		@Override
		//String
		public function toString() {
			return "Categoria{" + "id_categoria=" + $this->ID + ", descripcion=" + $this->descripcion + '}';
		}
	
		//Categoria
		static public function GetOne($id_categoria)
		{
// 			Categoria c = null;
			$categoria = null;
// 			MySQLAccess mysql = new MySQLAccess();
			$mysql = new MySQLAccess();
			$categoria = self::GetOneInDB($id_categoria, $mysql);
			$mysql->close();
			return $categoria;
		}
	
		//Categoria
		static private function GetOneInDB($id_categoria, /*MySQLAccess*/ $mysql)
		{
// 			Categoria $c = null;
			$c = null;
			try {
// 				java.sql.CallableStatement cstm = mysql.IniciarStoredProc("{CALL buscarcategoria(?)}");
				$cstm = $mysql->IniciarStoredProc("CALL buscarcategoria(?)");
// 				$cstm->setInt(1, $id_categoria);
				//$cstm->bind_param("i",$id_categoria);
				$cstm->bindParam(1,$id_categoria,\PDO::PARAM_INT);
				
// 				ResultSet rs = cstm.executeQuery();
// 				$rs = $cstm->executeQuery();
//				$rs = $cstm->execute();
				$flag =  $cstm->execute(/*$params*/);
				
				//$cstm->bind_result(/*$district or $rs*/);
				//$cstm->fetch();
				$rs = $cstm->fetchAll();
				
				//$rs->next();
				$c = self::mapear($rs[0]);
				//$rs.close();	
				$cstm->closeCursor();
				$cstm = null;
				
			} catch (\PDOException $ex){
				/*do nothing??*/
				System.out.println($ex->getMessage());
			}
			return $c;
		}
	
		//Categoria
		static public function GetOneByDescripcion($desc_categoria)
		{
// 			Categoria $c = null;
			$c = null;
// 			MySQLAccess mysql = new MySQLAccess();
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement cstm = $mysql->IniciarStoredProc("{CALL buscarcategoriadesc(?)}");
				$cstm = $mysql->IniciarStoredProc("CALL buscarcategoriadesc(?)");				
				$cstm->bindParam(1, $desc_categoria,\PDO::PARAM_STR);
// 				ResultSet rs = cstm.executeQuery();
				$cstm->execute();
				$rs = $cstm->fetchAll();
				$c = self::mapear($rs);
// 				$rs->close();
				$cstm->closeCursor();
				$cstm = null;
				
			} catch (Exception $ex){
				/*do nothing??*/
				System.out.println($ex->getMessage());
			} finally {
				$mysql->close();
			}
			return $c;
		}
	
		//Categoria
		static protected function mapear(/*ResultSet*/ $rs)
		{
			$id = MySQLAccess::GetSafeInt($rs, 0);
			//check if we found it
 			if ($id == -1)
			{
				return null;
			}
			$categoria = new Categoria();
// 			$categoria->setID(id);
			$categoria->setID(intval($rs['id_categoria']));
// 			$categoria->setDescripcion(MySQLAccess.GetSafeString(rs, 2));
			$categoria->setDescripcion($rs['descripcion']);
			$categoria->setEstado(Estado::INTACTA);
			return $categoria;
		}
	
// 		@Override
		protected function OperacionesNuevo(/*MySQLAccess*/ $mysql, /*boolean*/ $block)
		{
			try {
// 			Connection connection = mysql.getConnection();
			$connection = mysql.getConnection();
// 			PreparedStatement prepareStatement = connection.prepareStatement(
			$prepareStatement = $connection->prepareStatement(
				"INSERT INTO `javatp`.`categorias` (`descripcion`) VALUES (?);",
				PreparedStatement.RETURN_GENERATED_KEYS);
				
				$prepareStatement->setString(1, $this->descripcion);
				$prepareStatement->executeUpdate();
// 				ResultSet generatedKeys = prepareStatement.getGeneratedKeys();
				$generatedKeys = $prepareStatement->getGeneratedKeys();
				if (generatedKeys.next())
				{
					$this->ID = generatedKeys.getInt(1);
				}				
			} catch (SQLException $e) {
				throw $e;
			}
		}
	
// 		@Override
		protected function OperacionesModificar(/*MySQLAccess*/ $mysql, /*boolean*/ $block)
		{
			try {			
	// 			Connection connection = mysql.getConnection();
				$connection = $mysql->getConnection();
	// 			PreparedStatement prepareStatement = connection.prepareStatement(
				$prepareStatement = $connection->prepare("Update ecinema.categorias SET descripcion=? WHERE id_categoria=?;");
				$prepareStatement->bindParam(1, $this->descripcion,\PDO::PARAM_STR);
				$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
				if(!$prepareStatement->execute()){
					
				}
			} catch (\PDOException $e) {
				throw $e;
			}					
		}
	
		//Collection<Categoria>
		static public function getAll()
		{
// 			Collection<Categoria> categorias = new ArrayList<Categoria>();
			$categorias = new ArrayCollection();			
// 			MySQLAccess mysql = new MySQLAccess();
			$mysql = new MySQLAccess();
			try {
// 				java.sql.CallableStatement cstm = mysql.IniciarStoredProc("{CALL listarcategorias()}");
				$cstm = $mysql->IniciarStoredProc("CALL listarcategorias()");
				/*ResultSet $rs = $cstm->executeQuery();*/
				$cstm->execute();
				$rs = $cstm->fetchAll();
				self::wrapEntidad($rs, $categorias);
// 				$rs->close();
				$cstm->closeCursor();
				$cstm = null;
			} catch (Exception $ex) {
				/*do nothing??*/
				print_r($ex.getMessage());
			} finally {
				$mysql->close();
			}
			return $categorias;
		}
	
		//Collection<Categoria>
		static public function getAllByIds(/*Collection<Integer>*/ $ids)
		{
// 			Collection<Categoria> categorias = new ArrayList<Categoria>();
			$categorias = new ArrayCollection();			
// 			MySQLAccess mysql = new MySQLAccess();
			$mysql = new MySQLAccess();
			foreach ($ids as $id)
			{
				$categoria = self::GetOneInDB($id, $mysql);
				$categorias->set($categoria->getID(),$categoria);
			}
			$mysql->close();
			return $categorias;
		}
	
		/**
		 * wrapEntidad: LLeno una lista de entidades a partir de los datos del ResultSet.
		 */
		static public function wrapEntidad(/*ResultSet*/ $rs, /*Collection<Categoria>*/ $lista) 
		//llena la coleccion con instancias de una clase transformada (mapeada) de la base de datos.
		{
			try {
				$categoria = null;
// 				while ($rs.next())
				foreach ($rs as $row)
				{
					try {
						$categoria = self::mapear($row);
						if (!is_null($categoria)) {
							$lista->set($categoria->getID(),$categoria);
						}
					} catch (Exception $ex) {
						printf("Error armando lista de entidades: %s\n", $ex->getMessage());
					}
				}
			} catch (\PDOException $e) {
				throw $e;
			}
		}
	
// 		@Override
		protected function OperacionesEliminar(/*MySQLAccess*/ $mysql, /*boolean*/ $block)
		{
			try {
// 				Connection connection = mysql.getConnection();
				$connection = $mysql->getConnection();
// 				PreparedStatement prepareStatement = connection.prepareStatement(
				$prepareStatement = $connection->prepare("Update ecinema.categorias SET borrado=? WHERE id_categoria=?;");
				$prepareStatement->bindParam(1, true,\PDO::PARAM_BOOL);
				$prepareStatement->bindParam(2, $this->ID,\PDO::PARAM_INT);
				$prepareStatement->execute();
			} catch (\PDOException $e) {
				throw $e;
			}
		}
		
		public function jsonSerialize(){
			return [
					'ID' => $this->ID,
					'descripcion' => $this->descripcion,
			];
		}
	}
}
?>