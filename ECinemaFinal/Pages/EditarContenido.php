<?php
//include_once ('ContenidoLogica.php');
//include_once ('TipoContenido.php');

//use ECinema\Negocio\ContenidoLogica;
//use ECinema\Datos\TipoContenido;

// ContenidoLogica 
$cont = null;
// String 
$tipocont = null;
$tipocont = "pelicula";
// comprobar usuario administrador
try {
	/*
	// 	HttpSession 
	$sesion = request.getSession();
	*/	
	// 	UsuarioLogica 
	$usuarioLogica = null;
// 	$usuarioLogica = $sesion->getAttribute("usuario");
	$usuarioLogica = $_SESSION["usuario"];
	if (!$usuarioLogica->es_admin()) {
		throw new \Exception();
	}
	/*
	 
// 	int
	$id = 25; //intval($_POST["id"]);
	$cont = ContenidoLogica::Buscar($id);
	$tipocont = strtolower(TipoContenido::name($cont->getTipo()));
	*/
} catch (\Exception $ex) {
	// redireccionar a  jsp:forward page ="index.jsp"
	header("Location: http://localhost/ECinemaFinal/Pages/index.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Editar <?= $tipocont ?></title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
<link rel='stylesheet' type='text/css'  href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" src="../Scripts/jquery-2.0.0.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="../Scripts/ajaxRequestScript.js" ></script>
<script type="text/javascript" src="../Scripts/AltasContenido.js" ></script>
<script type="text/javascript" src="../Scripts/ContenidoBindings.js"></script>
<?php if ($tipocont === "pelicula") { ?>
<script type="text/javascript" src="../Scripts/PeliculaValidation.js" ></script>
<?php } else {?>
<script type="text/javascript" src="../Scripts/SerieValidation.js" ></script>
<?php }  ?>
<script type="text/javascript">
	var objectParameters = $.getObjectParameters(document.location.search + "&accion=EditarContenido");
	AjaxRequestPostWithHandler(JSON.stringify(objectParameters),"../Logica/Controller.php",ContenidoBindingForEdit)
</script>
</head>
    <body>
        <div align='center'>
            <div id='recuadro_princ'>
            	<!-- < ? include('cabecera.php'); ?>  -->
                <div id='cont_central'>
                    <!-- < ? include("navBar.php") ?> -->
                    <div id='ventana_editar_contenido' align='center' class='columnaDer seccion'>
                        <h2>Editar <?= $tipocont ?> </h2>

                        <div id='datosDelContenido' class='detallesContenido' align='center'>
                            <form id='borrar_contenido' action='alta_contenido' method='post'>
                                <div style='text-align:right;'>
                                    <!-- El sistema auto asigna el ID del contenido -->
                                    <input type='hidden' name='id' value='' />
                                    <input type='hidden' name='tipo' value='<?= $tipocont ?>' />
                                    <input id='proceso' name='proceso' type='hidden' value='borrar' />                                        
                                    <input type='submit' value='Borrar este Contenido' align='right' class='botns' />
                                </div>
                            </form>


                            <form id='contenido_data' action='alta_contenido' method='post'>
                                <div class='portada'>
                                    <img src='' title='' />
                                </div>
                                <table style='width:504px;'>

                                    <tr>
                                        <td  valign='middle' colspan='4'>
                                           <h3>Editar detalles de la <?= $tipocont ?></h3>
                                        </td>
                                    </tr>						

                                    <tr>
                                        <td  width='130px' valign='middle'>
                                            <p><b>Titulo:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <input id='titulo' name='titulo' type='text' size='50' class='campo' value='' />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width='130px'  valign='middle'>
                                            <p><b>Duracion:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <p>
                                                <input id='duracion' name='duracion' size='1' maxlength='3' type='text' class='campo' value=''>
                                                Minutos
                                            </p>
                                        </td>		
                                    </tr>

                                    <tr>
                                        <td width='130px'  valign='middle'>
                                            <p><b>Fecha Estreno:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <p>
                                            	<input type='text' id='fechaEstreno' name='fechaEstreno' size='6' value=''>
                                            </p>
                                        </td>		
                                    </tr>					

                                    <tr>
                                        <td width='130px'  valign='middle'>
                                            <p><b>Actores:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <input id='actores' name='actores' size='50' type='text' class='campo' value=''/>
                                        </td>			
                                    </tr>

                                    <tr>
                                        <td width='130px' valign='middle'>
                                            <p><b>Categorias:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
											<span id="categoriasList"></span>
                                        </td>		
                                    </tr>					


                                    <tr>
                                        <td width='130px'  valign='middle'>
                                            <p><b>Imagen de Portada (URL):</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <input id='img_portada' name='img_portada' type='text' class='campo' value=''>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width='130px'  valign='middle'>
                                            <p><b>Trailer (URL):</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <input id='trailer' name='trailer' type='text' class='campo' size='70' value=''/>
                                        </td>
                                    </tr>

                                    <?php if($tipocont === "pelicula") { ?>
                                    <tr>
                                        <td width='130px'  valign='middle'>
                                            <p><b>URL:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <input id='url' name='url' type='text' class='campo' size='70' value=''/>
                                        </td>
                                    </tr>
                                    <?php } ?>                                        

                                    <tr>
                                        <td width='130px'  valign='top' >
                                            <p><b>Sinopsis:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <textarea id='sinopsis' name='sinopsis' cols='35' rows='5'></textarea>
                                        </td>			
                                    </tr>

                                    <tr>
                                        <td  valign='middle' colspan='2'>
                                            <span class='msjError'> 
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td valign='middle' align='left' colspan='2'>
                                            <input id='proceso' name='accion' type='hidden' value='editar' />
                                            <input type='hidden' name='tipo' value='<?= $tipocont ?>' />
                                            <input type='hidden' name='id' value='' />
                                            <input type='submit' value='Guardar Cambios' align='left' class='botns'  />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                        <?php if ($tipocont === "serie") { ?>
                        <div id='capitulos' class='detallesContenido'>
                            <h3>Editar un capitulo:</h3>
                            <div id='lista_capitulos' class='lista_links'>
                                <?php 
//                                     //se obtiene colleccion de capitulos del contenido
//                                     Collection<SerieLogica> capitulos = SerieLogica.GetCapitulos(cont.getID());
//                                     for (SerieLogica cap : capitulos) {
//                                         //obtener id, imagen, titulo y fecha estreno del capitulo
//                                         out.print("<a href='editar_capitulo.jsp?id=" + cap.getID() + "'><img src='" + cap.getImagen() + "' />" + cap.getNombreCapitulo() + "<br />");

//                                         fechaEstreno = cap.getFechaEstreno();
//                                         calendar.setTime(fechaEstreno);
//                                         out.print("Fecha estreno:" + calendar.get(Calendar.DAY_OF_MONTH) + " / " + calendar.get(Calendar.MONTH) + " / " + calendar.get(Calendar.YEAR) + " </a>");
//                                     }
                                 ?>
                            </div>				
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
             <? include('footer.php'); ?>
        </div>
    </body>    

</html>