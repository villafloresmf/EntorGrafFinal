/**
 * Valicion JS de un Contenido tipo Capitulo.
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
			titulo_serie : {
				required: true
			},
			titulo_cap : {
				required: true
			},
			fechaEstreno: {
				required: true
//				dateSpanishFormat: true
			},
			img_cap : {
				required: true,
				url: true
			},
			trailer : {
				url: true
			},
			url : {
				required: true,
				url: true
			}
		},
		messages: {
			titulo_serie : {
				required: "El campo Titulo Serie es obligatorio."
			},			
			titulo_cap : {
				required: "El campo Titulo Capitulo es obligatorio."
			},
			fechaEstreno : {
				required: "El campo Fecha de Estreno es obligtorio"
			},
			img_cap : {
				required: "El campo Imagen del Capitulo es obligatorio.",
				url: "URL no valida."
			},
			trailer : {
				required: "El campo Trailer es obligatorio."
			},
			url : {
				required: "El campo URL es obligatorio."
			}
		},
		submitHandler: function(form){
			var objForm = $("#contenido_data");
			var jSonObject = objForm.serializeFormJSON();
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