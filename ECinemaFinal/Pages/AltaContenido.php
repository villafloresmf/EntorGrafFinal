<?php
// String tipocont = null;
 $tipocont = null;
// comprobar usuario administrador
try {
	//Comentario
	//$tipocont = $_POST["nuevo_cont"];
	//$sesion = request.getSession();
	//UsuarioLogica 
	$usuarioLogica = null;
	//$usuarioLogica = $sesion->getAttribute("usuario");
	$usuarioLogica = $_SESSION["usuario"];
	
	if (isset($usuarioLogica) && !$usuarioLogica->es_admin()) {
		throw new \Exception();
	}
	
	//$tipocont = $_POST("t_cont");
	if (is_null($tipocont)){
		$tipocont = "pelicula";
	} else {
		if (($tipocont !== "pelicula") && ($tipocont !== "serie")){
			header("Location: http://localhost/ECinemaFinal/Pages/AltaCapitulo.php");
			exit;
		}
	}
} catch (\Exception $ex) {
	// redireccionar a  jsp:forward page ="index.jsp" 
	header("Location: http://localhost/ECinemaFinal/Pages/index.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Alta Nueva <?php echo($tipocont) ?></title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
<link rel='stylesheet' type='text/css'  href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" src="../Scripts/jquery-2.0.0.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" src="../Scripts/ajaxRequestScript.js" ></script>
<script type="text/javascript" src="../Scripts/AltasContenido.js" ></script>
<?php if($tipocont === "pelicula") {?>
<script type="text/javascript" src="../Scripts/PeliculaValidation.js" ></script>
<?php } else { ?>
<script type="text/javascript" src="../Scripts/SerieValidation.js" ></script>
<?php } ?>
</head>
<body>
	<div align='center'>
		<div id='recuadro_princ'>
			<!-- < ?php include("cabecera.php") ?> -->
			<div id='cont_central'>
				<!-- < ?php include("navBar.php") ?> -->
				<div id='ventana_alta_contenido' align='center' class='columnaDer'>

					<div class='seccion'>
						<h2>Alta nueva <?= $tipocont ?></h2>
						
						<!-- action='alta_contenido'-->
						<form id="contenido_data" method="post" action="" >
							<div id='datospersonales' class='contenidos' align='center'>
								<table class='estilotabla'>

									<tr>
										<td valign='middle' colspan='4'>
											<p>
												<b>Detalles de la <?= $tipocont ?></b>
											</p>
										</td>
									</tr>

									<tr>
										<td width='182px' valign='middle'>
											<p>Titulo:</p>
										</td>
										<td width='522px' valign='middle'>
											<input id='titulo' name='titulo' type='text' size='50' class='campo' value='' >
                                		</td>
									</tr>

									<tr>
										<td width='182px' valign='middle'>
											<p>Duracion:</p>
										</td>
										<td width='522px' valign='middle'>
											<p>
												<input id='duracion' name='duracion' size='1' maxlength='3' type='text' class='campo' value=''>
												Minutos
                                    		</p>
										</td>
									</tr>
									<tr>
										<td width='182px' valign='middle'>
											<p>Fecha Estreno:</p>
										</td>
										<td width='522px' valign='middle'>
											<p>
												<input type='text' id='fechaEstreno' name='fechaEstreno' size='6' value=''>
                                    		</p>
										</td>
									</tr>
									<tr>
										<td width='182px' valign='middle'>
											<p>Actores (separar por coma):</p>
										</td>
										<td width='522px' valign='middle'>
											<input id='actores' name='actores' size='60' type='text' class='campo' value=''>
                                		</td>
									</tr>
									<tr>
										<td width='182px' valign='middle'>
											<p>Categoria:</p>
										</td>
										<td width='522px' valign='middle'>
											<span id="categoriasList"></span>
                               			</td>
									</tr>
									<tr>
										<td width='182px' valign='middle'>
											<p>Imagen de Portada (URL):</p>
										</td>
										<td width='522px' valign='middle'>
											<input id='img_portada' name='img_portada' type='text' class='campo' value=''>
		                                </td>
									</tr>
									<tr>
										<td width='182px' valign='top'>
											<p>Trailer (Opcional):</p>
										</td>
										<td width='522px' valign='middle'>
											<input id='trailer' name='trailer' type='text' size='70' value=''>
                                		</td>
									</tr>
                            
                        			<?php if($tipocont === "pelicula"){ ?>
                            		<tr>
										<td width='182px' valign='top'>
											<p>URL:</p>
										</td>
										<td width='522px' valign='middle'>
											<input id='url' name='url' type='text' size='70' value=''>
                                		</td>
									</tr>
                        			<?php } ?>
                            		<tr>
										<td width='182px' valign='top'>
											<p>Sinopsis:</p>
										</td>
										<td width='522px' valign='middle'>
											<textarea id='sinopsis' name='sinopsis' cols='50' rows='5'></textarea>
										</td>
									</tr>
									<tr>
										<td valign='middle' colspan='2'>
											<span class='msjError'></span>
                                    	</td>
									</tr>
									<tr>
										<td valign='middle' align='center' colspan='2'>
											<input type='hidden' name='accion' value='alta_cont'>
											<input type='hidden' name='tipo' value='<?= $tipocont ?>'>
											<input type="submit" value='Enviar' align='left' class='botns'>
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