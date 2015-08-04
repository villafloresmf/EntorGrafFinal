/**
 * Funciones comunes para cualquier tipo de pagina.
 */

function InputDatePicker(stringSelector){
    $(stringSelector).datepicker({
        dateFormat: "dd/mm/yy",
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Augosto", "Septiembre", "Octobre", "Noviembre", "Deciembre" ],
        dayNamesMin: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
        maxDate: '0'
        
    });
}

function InputAutoComplete(stringSelector,dataSource){	
	$(stringSelector).autocomplete({
		source: dataSource,
		select: function(event, ui){
			var idSelect = stringSelector + "_id";
			$(idSelect).val(ui.item.value);
			//$(stringSelector).text(ui.item.value);
		}
	});
}

function setFormPreventDefault(){
	$('form').submit(function (e) {
		e.preventDefault();
	});
}