/**
 * Script JS para binding de controles html con propiedades de objecto Json.
 */

function ContenidoBindingForEdit(stringObject){
	//Falta para bindear datos de serie.
	var jSonObject = JSON.parse(stringObject);
	var formElement = $("#contenido_data");
	formElement.find("#titulo").attr("value",jSonObject.Nombre);
	formElement.find("#duracion").attr("value",jSonObject.Duracion);
	formElement.find("#fechaEstreno").attr("value",jSonObject.FechaEstreno);
	formElement.find("#actores").attr("value",jSonObject.Actores);
	formElement.find("#img_portada").attr("value",jSonObject.Imagen);
	formElement.find("#trailer").attr("value",jSonObject.Trailer);
	formElement.find("#url").attr("value",jSonObject.Url);
	formElement.find("#sinopsis").text(jSonObject.Sinopsis);
	formElement.find("input[name='id']").attr("value",jSonObject.ID);
	
	$("#categoriasList input").each(function(idx,catCheck){
		$.each(jSonObject.Categorias, function(idy, catSelected) {
			if(catSelected.ID == catCheck.id){
				catCheck.checked = true;
			}
		});
	});
	
	$("#borrar_contenido").find("input[name='id']").attr("value",jSonObject.ID);
}

function ContenidoBindingForView(stringObject){
	//Falta para bindear datos de serie.
	debugger;
	var jSonObject = JSON.parse(stringObject);
	var formElement = $("#datoscontenido");
	formElement.find("h3").text(jSonObject.Nombre);
	formElement.find("span[id='duracion']").text(jSonObject.Duracion);
	formElement.find("span[id='fechaEstreno']").text(jSonObject.FechaEstreno);
	formElement.find("span[id='actores']").text(jSonObject.Actores);	
	formElement.find("span[id='sinopsis']").text(jSonObject.Sinopsis);
	
	var imgPortada = formElement.find("#img_portada");
	imgPortada.attr("src",jSonObject.Imagen);
	imgPortada.attr("title",jSonObject.Nombre);
	imgPortada.attr("alt", "Portada de "+ jSonObject.Nombre);
	
	var textoCategorias = '';
	$.each(jSonObject.Categorias, function(idy, catSelected) {
		textoCategorias += catSelected.descripcion + '\s|\s'
	});
	formElement.find("span[id='categorias']").text(textoCategorias);
	
	if(jSonObject.Trailer == null){
		$("#trailer").append("<strong>No hay un trailer disponible</strong>");
	} else {
		//Aca va un object con algun plugin para ver videos.
		$("#trailer").append("value",jSonObject.Trailer);
	}
	
	$("#ver_pelicula").find("input[name='id']").attr("value",jSonObject.ID);
}

function ContenidoBindingForViewCapitulo(stringObject){
	debugger;
	var jSonObject = JSON.parse(stringObject);
	var formElement = $("#datoscontenido");
	formElement.find("span[id='fechaEstreno']").text(jSonObject.FechaEstreno);
	formElement.find("h3").text(jSonObject.NombreCapitulo);
	formElement.find("#img_capitulo").attr("src",jSonObject.Imagen).attr("title",jSonObject.NombreCapitulo).attr("alt","Portada de " + jSonObject.NombreCapitulo);
	$("#ver_capitulo_serie").find("input[name='id']").attr("value",jSonObject.ID);
	
	var seccionElement = $("#seccion");
	seccionElement.find("h2").text(function (idx,texto) {
		return texto + jSonObject.Nombre;
	});
	
	if(jSonObject.Trailer == null){
		seccionElement.find("#trailer").append("<strong>No hay trailer disponible</strong>");
	} else {
		seccionElement.find("#trailer").append("value",jSonObject.Trailer);
	}
}

function ContenidoBindingForEditCapitulo(stringObject){
	debugger;
	var jSonObject = JSON.parse(stringObject);
	var formElement = $("#datoscontenido");
	formElement.find("#titulo_serie").val(jSonObject.Nombre);
	formElement.find("#titulo_cap").val(jSonObject.NombreCapitulo);
	formElement.find("#fechaEstreno").val(jSonObject.FechaEstreno);
	formElement.find("#img_cap").attr("src",jSonObject.Imagen).attr("title",jSonObject.NombreCapitulo).attr("alt","Portada de " + jSonObject.NombreCapitulo);
	if(jSonObject.Trailer != null){
		formElement.find("#trailer").val(jSonObject.Trailer);
	}
	formElement.find("#url").val(jSonObject.Url);
	
	$("#borrar_contenido").find("input[name='id']").attr("value",jSonObject.ID);
}

