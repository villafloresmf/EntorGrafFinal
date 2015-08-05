<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Nuevo Contenido</title>
<!-- <link rel='stylesheet' type='text/css'  href="../Scripts/stylesWeb2.css">  -->
</head>
<body>
        <div align='center'>
            <div id='recuadro_princ'>
                <!-- < ? include('cabecera.php'); ?>  -->
                <div id='cont_central'>
                    <!-- < ? include("navBar.php") ?> -->
			        <div id='ventana_ver_contenido' align='center' class='columnaDer'>
			
						<div class='seccion'>
							<h2>Alta Nuevo Contenido</h2>
							<div id='tipos_contenido' class='contenidos'>
							<form id='seleccionar_contenido' action='../Pages/AltaContenido.php' method='post' >			
									<table class='estilotabla'>
										<tr>
											<td valign='middle'>
												<p><b>Seleccione el tipo de contendo:</b></p>
											</td>
										</tr>
										
										<tr>
											<td valign='middle' align='center'>
											<!-- Comienzo formulario de seleccion nuevo contenido -->
												<div class='recuadroTipoContenido'>
													<img src='img/iconopelicula.png' />
													<br />
													<p><input type='radio' name='nuevo_cont' checked='checked' value='pelicula'/>Nueva Pelicula</p>
												</div>
							
												<div class='recuadroTipoContenido'>
													<img src='img/iconoserie.png' />
													<br />
													<p><input type='radio' name='nuevo_cont' value='serie'/>Nueva Serie</p>
												</div>
				                                                        
												<div class='recuadroTipoContenido'>
													<img src='img/iconocapitulo.png' />
													<br />
													<p><input type='radio' name='nuevo_cont' value='capitulo'/>Nueva Capitulo de Serie</p>
												</div>                                                        
											<!-- Fin formulario de seleccion nuevo contenido -->
											</td>
										</tr>
										<tr>
											<td valign='middle' align='center'>
												<input type='hidden' name='accion' value='seleccion'/>
												<input type='submit' value='Enviar' align='left' class='botns' />			
											</td>
										</tr>
									</table>
								</form>			
							</div>
						</div>
					</div>
                </div>
            	</div>
            <?php include(copyright.html) ?>
        </div>
</body>
</html>