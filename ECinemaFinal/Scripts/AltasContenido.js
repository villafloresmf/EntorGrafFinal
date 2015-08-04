$(function() {
    $( "#fechaEstreno" ).datepicker({
        dateFormat: "dd/mm/yy",
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Augosto", "Septiembre", "Octobre", "Noviembre", "Deciembre" ],
        dayNamesMin: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
        maxDate: '0'
        
    });
 });

$(document).ready(function() {	
	setFormPreventDefault();
	AjaxRequestPostWithHandler(JSON.stringify({accion:"GetAllCategorias"}),"../Logica/Controller.php",createCategoriasCheckList);
});

function createCategoriasCheckList(categorias){
	$.each(JSON.parse(categorias), function(idx, categoria) {
		var checkbox = $("<input type='checkbox' id='' name='categorias'>").attr('value',categoria.ID);
		checkbox.attr('id',categoria.ID);
		var lablefor = $("<label for=''></label>").attr('for',categoria.descripcion);
		lablefor.text(categoria.descripcion);
		$("#categoriasList").append(checkbox);
		$("#categoriasList").append(lablefor);
	});
}

function setFormPreventDefault(){
	$('form').submit(function (e) {
		e.preventDefault();
	});
}
