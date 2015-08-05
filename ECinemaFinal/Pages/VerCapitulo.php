<?php
// ContenidoLogica 
$cont = null;
// String 
$tipocont = null;
try {
// 	String 
	$id_cont = request.getParameter("id");
// 	int 
	$id = 0;
	try {
		$id = Integer.parseInt($id_cont);
	} catch (NumberFormatException $ex) {
	}
	$cont = ContenidoLogica.Buscar(id);
	$tipocont = cont.getTipo().toString().toLowerCase();
} catch (NullPointerException $e) {
	
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Ver Capitulo</title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
<link rel='stylesheet' type='text/css' href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" src="../Scripts/jquery-2.0.0.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="../Scripts/ajaxRequestScript.js" ></script>
<script type="text/javascript" src="../Scripts/ContenidoBindings.js"></script>
<script type="text/javascript">
	var objectParameters = $.getObjectParameters(document.location.search + "&accion=VerContenido");
	AjaxRequestPostWithHandler(JSON.stringify(objectParameters),"../Logica/Controller.php",ContenidoBindingForViewCapitulo)
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
                            <h2>Ver capitulo de </h2>

                            <div id='datoscontenido' class='detallesContenido' align='center'>
                                <div class='portada'>
                                    <img id='img_capitulo' src='' title='' alt='' />
                                </div>

                                <table style='width:504px;'>
                                    <tr>
                                        <td  valign='middle' colspan='4'>
                                            <h3></h3>
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
                                        <td valign='middle' align='right' colspan='2'>
                                            <form id='ver_capitulo_serie' action='alquiler_contenido' method='post'>
                                                <input type='hidden' name='id' value='' />
                                                <input type='submit' value='VER ESTE CAPITULO' align='right' class='botns'  />
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Si no hay trailer mostrar un mensaje NO HAY TRAILER -->
                            <div id='trailercap' class='detallesContenido'>
                                <h3>Trailer</h3>
                                <div id='trailer' class='trailer'>
                                    <?php 
//                                         String urltrailer = cont.getTrailer();
//                                         if (urltrailer.isEmpty()) {
//                                             out.print("<p>No hay un trailer disponible</p>");
//                             		} else {               
//                                     -- obtien URL trailer --
//                                     -- etiqueta Object flash para mostrar los trailer --
//                                     <object width='480px' height='270px'>
//                                         <param name='movie' value='<%= urltrailer%>?version=3&amp;hl=en_US'></param>
//                                         <param name='allowFullScreen' value='true'></param>
//                                         <param name='allowscriptaccess' value='always'></param>
//                                         <embed src='<%= urltrailer%>?version=3&amp;hl=en_US' type='application/x-shockwave-flash' width='560' height='315' allowscriptaccess='always' allowfullscreen='true'>
//                                         </embed>
//                                     </object>
//                                      }
                                     ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>