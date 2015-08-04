<?php
namespace ECinema\Negocio {
	include_once ('CategoriaLogica.php');
	include_once ('ContenidoLogica.php');
	include_once ('SerieLogica.php');
	
	use ECinema\Negocio\CategoriaLogica;
	use ECinema\Negocio\ContenidoLogica;
	use ECinema\Negocio\SerieLogica;
		
	$input = json_decode(file_get_contents("php://input"));
	$controller = new Controller();
	echo $controller->Action($input);
	
	class Controller {
		public function Action($input){
			switch ($input->accion) {
				case "GetAllCategorias":
					$categoriaLogica = new CategoriaLogica();
					return $categoriaLogica->doPost();
				case "GetAllSeries":
					$series = SerieLogica::GetAll();
					$jsonList = SerieLogica::JsonListIDsAndDescription($series);
					return $jsonList;					
				case "VerContenido":
				case "EditarContenido":
					$contenido = ContenidoLogica::Buscar($input->id);
					return $JsonOb = $contenido->ConvertEntityToJSON();
			};
		}
	}
}
?>