var self = this; //Sauvegarde le contexte global

$("input[data-id=listedesespeces]").autocomplete({
    source: function (request, response) {
        var oiseau = $("input[data-id=listedesespeces]").val();
        var objData = 'oiseau=' + oiseau;
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


$("input[data-id=listedesespeces]").on('autocompleteselect',function(event, ui) {
  
	event.preventDefault();

    var contact = ui.item.label;
        id = ui.item.value;
    console.log('Event: ', event);
    console.log('UI :', ui.item);
    $(event.currentTarget).val(contact);
	
});	


//Redirection vers la page de saisie d'une observation
$("#formobs").click(function(){
	
	document.location.href="http://localhost/nature/web/app_dev.php/saisie/" + id ;
	
	return false;
	
});


//Redirection vers la page de recherche d'un oiseau
$("#formlist").click(function(){
	
	document.location.href="http://localhost/nature/web/app_dev.php/liste/" + id ;
	
	return false;

});


//Recuperation des observations pour generer les markers
$('#lecture').on('click', function() {
	var urlComplet = document.location.href;
	console.log(urlComplet);
	var index = urlComplet.substring(urlComplet.lastIndexOf( "/" )+1 );
	console.log(index);
	$.get('http://localhost/nature/web/app_dev.php/obs/' + index, function(response) {
	
		self.markers = [];
		
		var image = 'http://localhost/nature/web/assets/img/markeur/crow2.png';
		
		for (var i = 0; i < response.length; i++) {
			console.log(response.length);
		}
		
		$.each(response, function(ix, obs) {
			
			var date = new Date(obs['date'].date);
			var dateString = date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
			console.log(obs);
		
			var marker = new google.maps.Marker({
				position: {
					lat: obs.latitude*1,
					lng: obs.longitude*1
				},
				title: "Vu le " + dateString,
				icon: image,
				map: self.map
			});
			self.markers.push(marker);
		});
		
		var markerCluster = new MarkerClusterer(self.map, self.markers, {imagePath: 'http://localhost/nature/web/assets/img/markeur/m'});
	
	});
});
