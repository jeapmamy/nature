$("input[data-id=dallalien]").autocomplete({
    source: function (request, response) {
		var company = $("input[data-id=dallalien]").val();
		var objData = 'company=' + company;
		var url = $(this.element).attr('data-url');
           
        $.ajax({
            url: url,
            dataType: "json",
            data : objData,
            type: 'POST',
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                    label: item.nomVern + ', ' + item.lbAuteur,
                    value: item.id
                    }
                }));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
})
$("input[data-id=dallalien]").on('autocompleteselect',function(event, ui) {
	event.preventDefault();
	var contact = ui.item.label;
		id = ui.item.value;
    	console.log('Event: ', event);
    	console.log('UI :', ui.item);
    	$(event.currentTarget).val(contact);
})
$.post('http://localhost/nature/web/app_dev.php/', {'id': id}, function(response){

})