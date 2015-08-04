<?php 
    //String tipocont = null;
    // comprobar usuario administrador
    try {
    	/*
//      HttpSession
        $sesion = request.getSession();
         */
//      UsuarioLogica 
//      $ul = (UsuarioLogica) $sesion.getAttribute("usuario");
		/*
        $ul = $_SESSION["usuario"];
        
        if (!$ul->es_admin()) {
            throw new \Exception();
        }
        */
//         $tipocont = (String) request.getAttribute("t_cont");
//         if ($tipocont == null){
//             tipocont = "pelicula";
//         }

    } catch (\Exception $ex) {
        header("Location: http://localhost/ECinemaFinal/Pages/index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Alta nuevo capitulo</title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
<link rel='stylesheet' type='text/css'  href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" src="../Scripts/jquery-2.0.0.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="../Scripts/ajaxRequestScript.js" ></script>
<script type="text/javascript" src="../Scripts/CommonFunctions.js" ></script>
<script type="text/javascript" src="../Scripts/CapituloValidation.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
	InputDatePicker("#fechaEstreno");
	setFormPreventDefault();
	AjaxRequestPostWithHandler(JSON.stringify({accion:"GetAllSeries"}),"../Logica/Controller.php",CompleteSelect);
});

function CompleteSelect(dataSource){
	var selectElement = $("#titulo_serie");
	debugger;
	var jsonArray = JSON.parse(dataSource);
	$.each(jsonArray,function(idx,jsonObject){
		selectElement.append($("<option></option>").attr("value",jsonObject.ID).text(jsonObject.Description));
	});

	// Probado en: https://jsfiddle.net/c78tcdaz/1/
}
</script>
</head>
    <body>
        <div align='center'>
            <div id='recuadro_princ'>
                <!-- < ?php include("cabecera.php") ?> -->
                <div id='cont_central'>
                    <!-- < ?php include("navBar.php") ?> -->
                    <div id='ventana_alta_contenido' align='center' class='columnaDer'>
			            <div class='seccion'>
			                <h2>Alta nuevo capitulo</h2>
			                <form id='contenido_data' action='' method='post'>
			                    <div id='datoscapitulo' class='contenidos' align='center'>
			                        <table class='estilotabla'>
			                            <tr>
			                                <td  valign='middle' colspan='4'>
			                                    <p><b>Detalles del Capitulo</b></p>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td  width='182px' valign='middle'>
			                                    <p>Titulo de la Serie:</p>
			                                </td>
			                                <td width='522px' valign='middle'>
			                                	<input type='hidden' id='titulo_serie_id' name='titulo_serie_id' value='' />
			                                    <select id='titulo_serie' name='titulo_serie' class='campo' >
			                                    	<option value='-1'></option>
			                                    </select>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td  width='182px' valign='middle'>
			                                    <p>Titulo del Capitulo:</p>
			                                </td>
			                                <td width='522px' valign='middle'>
			                                    <input id='titulo_cap' name='titulo_cap' type='text' size='40' class='campo' value='' />
			                                </td>
			                            </tr>
			                            <tr>
			                                <td  width='182px' valign='middle'>
			                                    <p>Fecha Estreno:</p>
			                                </td>
			                                <td width='522px' valign='middle'>
			                                    <p>
			                                        <input type='text' id='fechaEstreno' name='fechaEstreno' size='6' value='' >
			                                    </p>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td  width='182px' valign='middle'>
			                                    <p>Imagen del Capitulo (URL):</p>
			                                </td>
			                                <td width='522px' valign='middle'>
			                                    <input id='img_cap' name='img_cap' type='text' size='50' class='campo' value='' />
			                                </td>
			                            </tr>
			                            <tr>
			                                <td width='182px' valign='top'>
			                                    <p>Trailer (URL) (Opcional):</p>
			                                </td>
			                                <td width='522px' valign='middle'>
			                                    <input id='trailer' name='urltrailer' type='text' size='50' class='campo' value='' />
			                                </td>			
			                            </tr>
			                            <tr>
			                                <td width='182px' valign='top'>
			                                    <p>URL:</p>
			                                </td>
			                                <td width='522px' valign='middle'>
			                                    <input id='url' name='url' size='50' type='text' class='campo' value='' />
			                                </td>			
			                            </tr>
			                            <tr>
			                                <td valign='middle' colspan='2'>
			                                    <span class='msjError'>                                       
			                                    </span>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td valign='middle' align='center' colspan='2'>
			                                    <input type='hidden' name='accion' value='alta_cap' />
			                                    <input type='hidden' name='tipo' value='capitulo' />
			                                    <input type='submit' value='Enviar' align='left' class='botns' />
			                                </td>
			                            </tr>
			                        </table>		
			
			                    </div>
			                </form>
			            </div>
                    </div>
                </div>
            </div>
			<div id="dialog-confirm"><p></p></div>
			<? include('footer.php'); ?>
        </div>
    </body>
</html>