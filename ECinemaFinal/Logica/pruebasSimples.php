<?php
// include_once ('Categoria.php');
include_once ('CategoriaLogica.php');
include_once ('Contenido.php');
include_once 'TipoContenido.php';
include_once ('ContenidoLogica.php');
include_once ('SerieLogica.php');
// use ECinema\Datos\Categoria;
use ECinema\Negocio\CategoriaLogica;
use ECinema\Datos\Contenido;
use ECinema\Datos\TipoContenido;
use ECinema\Negocio\ContenidoLogica;
use ECinema\Negocio\SerieLogica;

// $categoria = Categoria::getAll();
// $cat1 = $categoria->first();
// $cat2 = $categoria->last();
// $cat3 = $categoria->get(4);

//$categoria = new CategoriaLogica();

//$fecha = new \DateTime();
// $fechaString = $fecha->format('d/m/Y');

// $tipostring = TipoContenido::name(TipoContenido::PELICULA);
 
//$result = CategoriaLogica::Buscar(2);
//$result = ContenidoLogica::Buscar(25);
$result = SerieLogica::GetAll();
$jsonList = SerieLogica::JsonListIDsAndDescription($result); 

//$cats = $result->getCategorias();
//$Jsonob = $result->ConvertEntityToJSON();


//$result = $categoria->doPost();

echo($result);
?>