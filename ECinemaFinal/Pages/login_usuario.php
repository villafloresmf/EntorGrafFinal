<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title>
<link rel='stylesheet' type='text/css' href='css/stylesWeb2.css' />
</head>
<body>
	<div align='center'>
		<div id='recuadro_princ'>

			<jsp:include page="cabecera.jsp" />
			<div id='cont_central'>
				<!-- < ? include("navBar.php") ?> -->
				<div id='columnaDercha' class='columnaDer'>

					<div class='seccion'>
						<h2>Login Usuario</h2>
						<div align='center' style='width: 612px;'>
							<table>
								<tr>
									<td>
										<div id='datosUsu' class='contenidos' style='float: left;'>
											<form id='log_usuario' action='login' method='post'>
												<table
													style='width: 270px; border: 1px; border-color: #F2B800; border-style: solid;'>
													<tr>
														<td width='270px' valign='middle'>
															<p>
																<b>Correo electronico:</b>
															</p>
														</td>
													<tr>
													</tr>
													<td width='270px' valign='middle'><input id='usuario'
														name='usuario' size='36' type='text' class='campo' /></td>
													</tr>
													<tr>
														<td width='270px' valign='middle'>
															<p>
																<b>Password:</b>
															</p>
														</td>
													<tr>
													</tr>
													<td width='270px' valign='middle'><input id='pass'
														name='pass' size='36' type='password' class='campo' /></td>
													</tr>

													<tr>
														<td valign='middle' align='center' colspan='2'><input
															type='submit' value='Entrar' align='left' class='botns' />
														</td>
													</tr>

													<tr>
														<td valign='middle' colspan='4'><span class='msjError'> <%
																if(request.getAttribute("error")!=null){
																out.println(request.getAttribute("error")); } %> </span>
														</td>
													</tr>
												</table>
											</form>
										</div>

									</td>
									<td width='50px'></td>
									<td>
										<div id='datosUsu' class='detallesContenido'
											style='float: right;'>
											<table
												style='width: 270px; border: 1px; border-color: #F2B800; border-style: solid;'>
												<tr>
													<td width='270px' valign='middle'>
														<h3>
															Registrarme como<br /> NUEVO USUARIO:
														</h3>
													</td>
												</tr>
												<tr>
													<td valign='middle' align='center' colspan='2'><a
														href='registrarUsuario.jsp'> <input type='button'
															value='Continuar' align='left' class='botns' />
													</a></td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<jsp:include page="copyright.html" />
	</div>
</body>
</html>
