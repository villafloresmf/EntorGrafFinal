<?php
namespace ECinema\Negocio {
	include_once ('alta_contenido.php');
	
	use ECinema\Negocio\AltaContenido;

	$input = json_decode(file_get_contents("php://input"));
	$controller = new ControllerABM();
	echo $controller->Action($input);

	class ControllerABM {
		public function Action($input){
			switch ($input->accion) {
				case "alta_cap":
				case "alta_cont":
					$altaContenido = new AltaContenido();
					$altaContenido->doPost($input);
					$resultado = "Alta Exitosa";
					break;
				case "Editar":
					break;
				case "Modificar":
					break;
			};
			
			return json_encode(array("operacion"=> $resultado));
		}
	}
}
?>