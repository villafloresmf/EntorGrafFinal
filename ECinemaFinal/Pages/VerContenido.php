<?php
// ContenidoLogica 
$cont = null;
// String 
$tipocont = null;
try {
// 	String 
	//$id_cont = request.getParameter("id");
// 	int 
	//$id = 0;
	try {
		//$id = Integer.parseInt($id_cont);
	} catch (NumberFormatException $ex) {
	}
	//$cont = ContenidoLogica.Buscar(id);
	$tipocont = "pelicula";// cont.getTipo().toString().toLowerCase();
} catch (NullPointerException $e) {
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Ver <?= $tipocont ?></title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
<link rel='stylesheet' type='text/css'  href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" src="../Scripts/jquery-2.0.0.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="../Scripts/ajaxRequestScript.js" ></script>
<!-- <script type="text/javascript" src="../Scripts/AltasContenido.js" ></script>  -->
<script type="text/javascript" src="../Scripts/ContenidoBindings.js"></script>
<script type="text/javascript">
	var objectParameters = $.getObjectParameters(document.location.search + "&accion=VerContenido");
	AjaxRequestPostWithHandler(JSON.stringify(objectParameters),"../Logica/Controller.php",ContenidoBindingForView)
</script>
</head>
    <body>
        <div align='center'>
            <div id='recuadro_princ'>
                <!-- jsp:include page="cabecera.jsp" -->
                <div id='cont_central'>
                    <!-- < include("navBar.php") ?> -->
                    <div id='ventana_ver_contenido' align='center' class='columnaDer'>

                        <div class='seccion'>
                            <h2>Ver <?= $tipocont ?> </h2>

                            <div id='datoscontenido' class='detallesContenido' align='center'>
                                <div id='portada' class='portada'>
                                    <img id='img_portada' src='' title='' alt='' />
                                </div>

                                <table style='width:504px;'>
                                    <tr>
                                        <td  valign='middle' colspan='4'>
                                            <h3><!-- cont.getNombre() --></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='130px' valign='middle'>
                                            <p><b>Duracion:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <span id='duracion'></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='130px' valign='middle'>    
                                            <p><b>Fecha Estreno:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                        	<span id='fechaEstreno'></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='130px' valign='middle'>
                                            <p><b>Actores:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <span id='actores'></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='130px' valign='middle'>
                                            <p><b>Categoria:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <span id='categorias'></span>
                                        </td>		

                                    </tr>
                                    <tr>
                                        <td width='130px'  valign='top' >
                                            <p><b>Sinopsis:</b></p>
                                        </td>
                                        <td width='274px' valign='middle'>
                                            <span id='sinopsis'></span>
                                        </td>
                                    </tr>
                                    <!-- mostrar solo si es pelicula -->
                                    <?php if ($tipocont === "pelicula") {?>
                                    <tr>
                                        <td valign='middle' align='right' colspan='2'>
                                            <form id='ver_pelicula' action='alquiler_contenido.jsp' method='post'>
                                                <input type='hidden' name='id' value='' />
                                                <input type='submit' value='VER ESTA PELICULA' align='right' class='botns'  />
                                            </form>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- Solo si es pelicula -->
                            <!-- Si no hay pelicula Mostrar un mensaje NO HAY TRAILER -->
                            <div id='trailerpeli' class='detallesContenido'>
                                <h3>Trailer</h3>
                                <div id='trailer' class='trailer'>
                                    <?php
//                                         out.print("<p>No hay un trailer disponible</p>");
//                             		} else {                
//                                     obtien URL trailer 
//                                     etiqueta Object flash para mostrar los trailer
//                                     <object width='480px' height='270px'>
//                                         <param name='movie' value='urltrailer?version=3&amp;hl=en_US'></param>
//                                         <param name='allowFullScreen' value='true'></param>
//                                         <param name='allowscriptaccess' value='always'></param>
//                                         <embed src=' urltrailer ?version=3&amp;hl=en_US' type='application/x-shockwave-flash' width='560' height='315' allowscriptaccess='always' allowfullscreen='true'>
//                                         </embed>
//                                     </object> 
//                                     }
                                    ?>
                                </div>
                            </div>

                            <!-- Solo si es serie -->
                            <!-- Si no hay captiulos Mostrar un mensaje NO HAY CAPITULOS -->
                            <?php if ($tipocont === "serie") {?>          
                            <div id='capitulos' class='detallesContenido'>
                                <h3>Lista de capitulos:</h3>
                                <div id='lista_capitulos' class='lista_links'>
                                    <?php
                                        //se obtiene colleccion de capitulos del contenido
//                                         Collection<SerieLogica> capitulos = SerieLogica.GetCapitulos(cont.getID());
//                                         for (SerieLogica cap : capitulos) {
//                                             //obtener id, imagen, titulo y fecha estreno del capitulo
//                                             out.print("<a href='ver_capitulo.jsp?id=" + cap.getID() + "'><img src='" + cap.getImagen() + "' />" + cap.getNombreCapitulo() + "<br />");

//                                             fechaEstreno = cap.getFechaEstreno();
//                                             calendar.setTime(fechaEstreno);
//                                             out.print("Fecha estreno:" + calendar.get(Calendar.DAY_OF_MONTH) + " / " + calendar.get(Calendar.MONTH) + " / " + calendar.get(Calendar.YEAR) + " </a>");
//                                         }
                                    ?>                        
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <? include('footer.php'); ?>
        </div>
    </body>
</html>