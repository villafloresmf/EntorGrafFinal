/**
 * Valicion JS de un Contenido tipo Pelicula.
 */
$(document).ready(function() {
	
	$.validator.setDefaults({
		errorClass: 'form_error',
		errorElement: 'span'//,
//		errorPlacement: function(error,element){
//			error.after(element);
//		}
		
	});
	
	$.validator.addMethod("dateSpanishFormat",
		    function(value, element) {
		        return value.match(/^dd?-dd?-dddd$/);
		    }, "El formato de fecha es invalido.");
	
	$("#contenido_data").validate({
		rules: {
			titulo : {
				required: true
			},
			duracion : {
				required: true,
				digits: true,
				minlength: 2
			},
			fechaEstreno: {
				required: true
//				dateSpanishFormat: true
			},
			actores : {
				required: true,
				accept: "([a-zA-Z]|[\s])+$"
			},
			categorias : {
				required: true,
				minlength: 1
			},
			img_portada : {
				required: true,
				url: true
			},
			trailer : {
				url: true
			},
			url : {
				required: true,
				url: true
			},
			sinopsis : {
				maxlength: 200
			}
		},
		messages: {
			titulo : {
				required: "El campo Titulo es obligatorio."
			},
			duracion : {
				required: "El campo duracion es obligatorio.",
				digits: "Solo numeros",
				minlength: "minimo 2",
				maxlength: "maximo 3"
			},
			fechaEstreno : {
				required: "El campo Fecha de Estreno es obligtorio"
			},
			actores : {
				required: "El campo Actores es obligatorio.",
				accept: "Se ha ingresado un caracter invalido."
			},
			categorias : {
				required: "El campo Categorias  es obligatorio.",
				minlength: "Selecciona al menos una categoria."
			},
			img_portada : {
				required: "El campo Imagen Portada  es obligatorio.",
				url: "URL no valida."
			},
			trailer : {
				required: "El campo Trailer es obligatorio."
			},
			url : {
				required: "El campo URL es obligatorio.",
				url: "URL no valida."
			},
			sinopsis : {
				maxlength: "Excediste el maximo."
			}
		},
		submitHandler: function(form){
			var objForm = $("#contenido_data");
			var jSonObject = objForm.serializeFormJSON();
			// Cuando pasa una sola categoria, solo pasa una valor y no un array.
			if(jSonObject.categorias.length == 1){
				jSonObject.categorias = [jSonObject.categorias];
			} 
			AjaxRequestPost(jSonObject,"../Logica/ControllerABM.php");
          return false;
        },
		invalidHandler: function(event, validator) {
			alert('paso algo');
		},
		success: function(element){
			element.remove();
		}
	});
});



