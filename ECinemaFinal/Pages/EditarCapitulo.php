<?php
// ContenidoLogica 
$cont = null;
// String 
$tipocont = null;
// comprobar usuario administrador
try {
// 	HttpSession sesion = request.getSession();
// 	UsuarioLogica 
	//$ul = (UsuarioLogica) sesion.getAttribute("usuario");
	/*
	if (!$ul->es_admin()) {
		throw new \Exception();
	}
	*/
// 	int id = Integer.parseInt(request.getParameter("id"));
// 	cont = (ContenidoLogica) ContenidoLogica.Buscar(id);
// 	tipocont = cont.getTipo().toString().toLowerCase();
} catch (\Exception $ex) {
// 	<jsp:forward page ="index.jsp"/>
	header("Location: http://localhost/ECinemaFinal/Pages/index.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Editar Capitulo</title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
<link rel='stylesheet' type='text/css'  href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" src="../Scripts/jquery-2.0.0.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="../Scripts/ajaxRequestScript.js" ></script>
<script type="text/javascript" src="../Scripts/CommonFunctions.js" ></script>
<script type="text/javascript" src="../Scripts/CapituloValidation.js" ></script>
<script type="text/javascript" src="../Scripts/ContenidoBindings.js"></script>
<script type="text/javascript">
	debugger;
	var objectParameters = $.getObjectParameters(document.location.search + "&accion=EditarContenido");
	AjaxRequestPostWithHandler(JSON.stringify(objectParameters),"../Logica/Controller.php",ContenidoBindingForEditCapitulo);
</script>
</head>

    <body>
        <div align='center'>
            <div id='recuadro_princ'>
                <!-- < ? include('cabecera.php'); ?>  -->
                <div id='cont_central'>
                <!-- < ?php include("navBar.php") ?> -->
		        <div id='ventana_editar_contenido_capitulo' align='center' class='columnaDer seccion'>
		                <h2>Editar Capitulo</h2>
		
		                <div id='datosDelCapitilo' class='detallesContenido' align='center'>
		                    <form id='borrar_contenido' action='alta_contenido' method='post'>
		                        <div style='text-align:right;'>
		                            <!-- El sistema auto asigna el ID del contenido -->
		                            <input type='hidden' name='id' value='' />
		                            <input id='proceso' name='proceso' type='hidden' value='borrar' />                                        
		                            <input type='hidden' name='tipo' value='capitulo' />
		                            <input type='submit' value='Borrar este Contenido' align='right' class='botns' />
		                        </div>				
		                    </form>
		
		
		                    <form id='contenido_data' action='alta_contenido' method='post'>
		                        <div class='portada'>
		                            <img src='' title='' alt='' />
		                        </div>
		                        <table style='width:504px;'>
		
		                            <tr>
		                                <td valign='middle' colspan='4'>
		                                    <h3>Editar detalles del capitulo</h3>
		                                </td>
		                            </tr>
		                            
		                            <tr>
		                                <td  width='130px' valign='middle'>
		                                    <p><b>Titulo de la Serie:</b></p>
		                                </td>
		                                <td width='274px' valign='middle'>
		                                    <input id='titulo_serie' name='titulo_serie' type='text' size='50' class='campo' value='' />
		                                </td>
		                            </tr>
		                            
		                            <tr>
		                                <td  width='130px' valign='middle'>
		                                    <p><b>Titulo del Capitulo</b></p>
		                                </td>
		                                <td width='274px' valign='middle'>
		                                    <input id='titulo_cap' name='titulo_cap' type='text' size='50' class='campo' value='' />
		                                </td>
		                            </tr>
		
		                            <tr>
		                                <td width='130px'  valign='middle'>
		                                    <p><b>Fecha Estreno:</b></p>
		                                </td>
		                                <td width='274px' valign='middle'>
		                                    <p>
		                                    	<input type='text' id='fechaEstreno' name='fechaEstreno' size='6' value='' />		                                    
		                                    </p>
		                                </td>		
		                            </tr>					
		
		                            <tr>
		                                <td width='130px'  valign='middle'>
		                                    <p><b>Imagen del Capitulo (URL):</b></p>
		                                </td>
		                                <td width='274px' valign='middle'>
		                                    <input id='img_cap' name='img_cap' type='text' class='campo' size='50' value='' />
		                                </td>
		                            </tr>
		
		                            <tr>
		                                <td width='130px'  valign='middle'>
		                                    <p><b>Trailer (URL) (Opcional):</b></p>
		                                </td>
		                                <td width='274px' valign='middle'>
		                                    <input id='trailer' name='trailer' type='text' class='campo' size='50' value=''/>
		                                </td>
		                            </tr>
		
		                            <tr>
		                                <td width='130px'  valign='middle'>
		                                    <p><b>URL:</b></p>
		                                </td>
		                                <td width='274px' valign='middle'>
		                                    <input id='url' name='url' type='text' class='campo' size='50' value=''/>
		                                </td>
		                            </tr>
		                                       
		                            <tr>
		                                <td  valign='middle' colspan='2'>
		                                    <span class='msjError'> 
		                                        <%
		                                            if (request.getAttribute("error") != null) {
		                                                out.println(request.getAttribute("error"));
		                                            }
		                                        %>
		                                    </span>
		                                </td>
		                            </tr>
		
		                            <tr>
		                                <td valign='middle' align='left' colspan='2'>
		                                    <input id='proceso' name='proceso' type='hidden' value='editar_cap' />
		                                    <input type='hidden' name='tipo' value='capitulo' />                                                        
		                                    <input type='hidden' name='id' value='' />
		                                    <input type='submit' value='Guardar Cambios' align='left' class='botns'  />
		                                </td>
		                            </tr>
		                        </table>
		                    </form>
		                </div>
		
		            </div>
		        </div>
			</div>
		    <? include('footer.php'); ?>
		</div>
    </body>    

</html>