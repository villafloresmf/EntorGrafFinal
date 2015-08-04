<?php
namespace ECinema\Datos {
	abstract class TipoContenido {
		const PELICULA = 1;
		const SERIE = 2;
		
		public static function name($tipo){
			switch ($tipo) {
				case self::PELICULA:
				return "PELICULA";
				case self::SERIE:
				return "SERIE";
			}
		}
		
		public static function valueOf($tipoString){
			switch ($tipoString) {
				case  "PELICULA":
					return self::PELICULA;
				case "SERIE":
					return self::SERIE;
			}
		}
	};
}
?>