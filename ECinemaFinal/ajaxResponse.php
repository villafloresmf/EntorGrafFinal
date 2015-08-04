<?php
/*
include_once ('MetaContenido.php');
include_once ('ArrayCollection.php');

use ECinema\CrossCutting\ArrayCollection;
use ECinema\Datos\MetaContenido;


$collectionTest = new ArrayCollection();

$meta = new MetaContenido();
$bool = is_int(10);
$meta->setID(10);
$meta->setSinopsis("Una description id 10");
$collectionTest->set($meta->getID(), $meta);

$meta = new MetaContenido();
$meta->setID(20);
$meta->setSinopsis("Una description id 20");
$collectionTest->set($meta->getID(), $meta);

$elemento = $collectionTest->get(10);
*/

if (isset($_POST['numeroA']) && isset($_POST['numeroB'])) {
	$num1 = intval($_POST['numeroA']);
	$num2 = intval($_POST['numeroB']);
	$resp = is_string($num1);
	$resultado = ((int)$num1) + ((int)$num2);
	echo json_encode(array("resultado"=> $resultado, "descripcion"=> $elemento->getSinopsis()));
}

/*
class TestClass{
	public $colection;
	
}
*/
?>