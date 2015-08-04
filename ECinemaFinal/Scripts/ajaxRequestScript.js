/**
 * Manejador de solicitudes ajax.
 */
// Parse Function: Form Serialize to JSON Object  
(function ($) {
    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

jQuery.extend({
	getObjectParameters : function(str) {
		  return (str || document.location.search).replace(/(^\?)/,'').split("&").map(function(n){return n = n.split("="),this[n[0]] = n[1],this}.bind({}))[0];
	}
});

// Post Request JQuery Manager.
function AjaxRequestPost(objForm,actionPage){
	AjaxRequestPostWithHandler(objForm,actionPage,SuccessfulOperation)
}

function AjaxRequestPostWithHandler(objForm,actionPage,successFunction){
	if(!(typeof objForm === "undefined") && (objForm != null) && (typeof objForm !== 'string')){
		var jsonData = JSON.stringify(objForm);
	};
	if(typeof objForm === 'string'){
		var jsonData = objForm;
	}
	$.ajax({
		url: actionPage,
		type: "POST",
		//data: "data=" + jsonData,
		data: jsonData,
		//dataType: "json",
		contentType: "application/json; charset=utf-8",
		success: successFunction,
	}).fail(ErrorOperation);//.done(functionSucess);
	return false;
}

function SuccessfulOperation(data){
	var jsonObject = JSON.parse(data);
	callDialogConfirm("Alta Nueva Pelicula","La operacion se ha completado con exito.");
	event.preventDefault();
	return false;
}

function ErrorOperation(data){
	var jsonObject = JSON.parse(data);
	callDialogConfirm("Alta Nueva Pelicula","Ocurrio un error durante la operacion.");
	event.preventDefault();
	return false;
}

function callDialogConfirm(titleDialog,textDialog){
	callDialogConfirmWithtAceptarFunction(titleDialog,textDialog,AceptarYRedireccionarDefaultF);
}

function callDialogConfirmWithtAceptarFunction(titleDialog,textDialog,Aceptarfunction){
	debugger;
	$("#dialog-confirm").find("p").text(textDialog);
	
	$("#dialog-confirm").dialog({
		title: titleDialog,
		resizable: false,
		width: 350,
		height: 300,
		modal: true,
		buttons: {
			"Aceptar": Aceptarfunction
		}
	});
}

function AceptarYRedireccionarDefaultF(){
	$(this).dialog("close");
	//window.location.replace("http://personanosekai.blogspot.com");
}

function AceptarYRedireccionarF(url){
	$(this).dialog("close");
	window.location.replace(url);
}