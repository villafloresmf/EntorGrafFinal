<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Insert title here</title>
<link rel='stylesheet' type='text/css'  href="../Scripts/jquery-ui.min.css">
<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery-ui.min.js" ></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	debugger;
	$("#btnEnviar").click(AjaxRequest);	
});

function AjaxRequest(){
	var serializado = $("#pruebaSerializacion").serialize();
	$.post(
			'ajaxResponse.php',
			serializado,
			function(data){
			$("#txtResultado").val(data.resultado);
			alert(data.descripcion);
		},"json");
}
</script>
</head>
<body>
	<form id="pruebaSerializacion" action="">
		<label>Numero A:</label>
		<input id="numeroA" type="text" name="numeroA"><br />
		<label>Numero B:</label>
		<input id="numeroB" type="text" name="numeroB"><br />	
		<input type="button" id="btnEnviar" value="Sumar">
	</form>
	
	<input id="txtResultado" type="text" name="txtResultado" >
</body>
</html>