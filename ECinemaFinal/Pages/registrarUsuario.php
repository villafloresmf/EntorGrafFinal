<?php
	include "java.Negocio.UsuarioLogica"; 
	include "java.util.Collection";
	include "java.Negocio.PlanLogica";

    //si es modificar entonces verifica session sino es alta de usuario
    $modo = request.getParameter("proceso");
    //HttpSession $sesion = request.getSession();
    //UsuarioLogica ul = null;
    $ul = null;
//     if (modo != null)
//     {
//         if (modo.equalsIgnoreCase("modificar")) {
//             if (sesion == null) {
//                 response.sendRedirect("index.jsp");
//             }
//             ul = (UsuarioLogica) sesion.getAttribute("usuario");
//             if (ul == null){
//                 response.sendRedirect("index.jsp");
//             }
//      }
//    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <?
    if (ul != null) {
    ?>
    <title>Perfil de Usuario</title>
    <? } else { ?>
    <title>Registrar Nuevo Usuario</title>
    <? } ?>
    <link rel='stylesheet' type='text/css' href='css/stylesWeb2.css'>
</head>

<body>
<div align='center'>
	<div id='recuadro_princ'>
		<!-- < ? include('cabecera.php'); ?>  -->
		
		<div id='cont_central'>

			<div id='columan_derecha' class='columnaDer'>

                <!-- INICIO FORMULARIO DE NUEVO USUARIO --------------------------------------------------------------------------------- -->			
				<div class='seccion'>
                <?
                if (ul != null) {
                ?>
                <h2>Perfil de Usuario</h2>
                <? } else { ?>
                <h2>Registrarse como Usuario</h2>
                <? } ?>
				
				<form id='nuevo_usuario' action='registrar_usu' method='post'>
					
					<div id='datospersonales' class='contenidos' align='center'>
						<table class='estilotabla'>
					
							<tr>
								<td  valign='middle' colspan='4'>
									<p><b>Paso 1. Completa tus datos personales</b></p>
								</td>
							</tr>
					
							<tr>
								<td  width='152px' valign='middle'>
									<p>Correo Electronico:</p>			
								</td>
								<td colspan='3' valign='middle'>
									<input id='email' name='email' size='42' type='text' class='campo'
                                       <? if(request.getAttribute("error") != null){
                                            out.println("value='" + request.getParameter("email") + "'");
                                        } else {
                                        if (ul!=null) out.println("value='" + ul.getEmail() + "'");
                                        }
                                        ?> />
								</td>
							</tr>	
			
							<tr>
								<td  width='152px' valign='middle'>
									<p>Nombre:</p>
								</td>
								<td width='168px' valign='middle'>
									<input id='nombre' name='nombre' type='text' class='campo'
                                       <? if(request.getAttribute("error") != null){
                                        out.println("value='" + request.getParameter("nombre") + "'");
                                        } else {
                                        if (ul!=null) out.println("value='" + ul.getNombre() + "'");
                                        }
                                        ?> />
								</td>
								<td  width='152px' valign='middle'>
									<p>Apellido:</p>
								</td>
								<td width='168px' valign='middle'>
									<input id='apellido' name='apellido' type='text' class='campo'
                                       <? if(request.getAttribute("error") != null){
                                        out.println("value='" + request.getParameter("apellido") + "'");
                                        } else {
                                        if (ul!=null) out.println("value='" + ul.getApellido() + "'");
                                        }
                                        ?> />
								</td>			
							</tr>
			
							<tr>
								<td valign='middle'>
									<p>Password: (long. minima <?= UsuarioLogica.getPasswordMinimo() ?>)</p>
								</td>
								<td valign='middle'>
									<input id='pass' name='pass' type='password' class='campo' 
                                      <? if (ul!=null) out.println("value='" + ul.getPassword() + "'");
                                        ?> />
								</td>
								<td valign='middle'>
									<p>Confirmar Password:</p>	
								</td>
								<td valign='middle'>
									<input id='conpass' name='conpass' type='password' class='campo'
                                      <? if (ul!=null) out.println("value='" + ul.getPassword() + "'");
                                        ?> />
								</td>			
							</tr>
							
							<tr>
								<td  width='152px' valign='middle'>
									<p>Tipo Documento:</p>
								</td>
								<td width='168px' valign='middle'>
									<select name='tipodoc'>
                                        <?
//                                             String[] tipoDocs = {"DNI", "LC", "LE"};
//                                             foreach (String tp : tipoDocs) {
//                                                 out.println("<option value='" + tp + "' ");
//                                                 if (request.getAttribute("error") != null && tp.equalsIgnoreCase(request.getParameter("tipodoc"))) {
//                                                     out.println("selected='selected'");
//                                                 } else {
//                                                     if (ul!=null && tp.equalsIgnoreCase(ul.getTipoDoc())) {
//                                                         out.println("selected='selected'");
//                                                     }
//                                                 }
//                                                 out.println(" >" + tp + "</option>");
//                                             }
                                        ?>
									</select>
								</td>
								<td  width='152px' valign='middle'>
									<p>Nro Doc:</p>
								</td>
								<td width='168px' valign='middle'>
									<input id='nrodoc' name='nrodoc' type='text' class='campo'
                                    <? if(request.getAttribute("error") != null){
                                        out.println("value='" + request.getParameter("nrodoc") + "'");
                                        } else {
                                        if (ul!=null) out.println("value='" + ul.getNroDoc() + "'");
                                        }
                                        ?> />
								</td>			
							</tr>
						</table>		
					
					</div>
							
					<div id='planes' class='contenidos'>
					
						<table class='estilotabla'>
							<tr>
								<td valign='middle'>
									<p><b>Paso 2. Elige un PLAN DE SERVICIOS que mas se adecue a tus gustos.</b></p>
								</td>
							</tr>
							
							<tr>
								<td valign='middle'>
                                    <?
//                                         Collection<PlanLogica> planes = PlanLogica.GetAll();
//                                         foreach(PlanLogica p : planes) {
                                    ?>
                                    <div class='recuadroPlanes'>
                                        <h3><input type='radio' name='planes' value='<?= p.getID()?>'
                                                   <?
//                                                        if (request.getAttribute("error") != null) {
//                                                            try {
//                                                                int plan_id = Integer.parseInt(request.getParameter("planes"));
//                                                                if (p.getID() == plan_id) {
//                                                                    out.print("checked='checked'");
//                                                                }
//                                                            } catch (Exception ex) {
//                                                            }
//                                                        } else {
//                                                            if (ul != null && p.getID() == ul.getIdPlan()) {
//                                                                out.print("checked='checked'");
//                                                            }
//                                                        }
                                                   ?> /> <?= p.getDescripcion()?> </h3>
                                        <img src='<?= p.getImagen()?>' />
                                        <ul>
                                            <li>Max Alquiler Peliculas: <?= p.getMaxAlquileresPeliculas()?></li>
                                            <li>Max Alquiler Series: <?= p.getMaxAlquileresSeries()?></li>
                                            <li>Precio: <?= p.getPrecio()?></li>
                                        </ul>
                                    </div> 
                                    <? //} ?>
								</td>
							</tr>
							
							<tr>
								<td valign='middle' align='center'>
                                    <span class='msjError'>
                                        <?
                                            if (request.getAttribute("error") != null) {
                                                out.println(request.getAttribute("error"));
                                            }
                                        ?>   
                                    </span>
								</td>
							</tr>
																
							<tr>
								<td valign='middle' align='center'>
									<input type='submit' value='Enviar' align='left' class='botns' />
                                    <?
                                    if (ul != null) {
                                    ?>
                                    <a href="registrar_usu?proceso=eliminar"><input type='button' value='Darme de Baja' align='left' class='botns' /></a>
                                    <? } ?>
                                    <input type='hidden' name='proceso' value='<?= modo ?>' />
								</td>
							</tr>
							
						
						</table>
						
					</div>
				</form>
				</div>
			
			<!-- FIN FORMULARIO DE NUEVO USUARIO --------------------------------------------------------------------------------- -->
        
			</div>
			<!-- < ?php include("navBar.php") ?> -->
		</div>
		<? include('footer.php'); ?>
	</div>
</div>
</body>
</html>