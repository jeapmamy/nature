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
this.markers = [];
$("input[data-id=listedesespeces]").on('autocompleteselect',function(event, ui) {
    event.preventDefault();
    //vide le tableau
    for (var i = 0; i < self.markers.length; i++) {
        self.markers[i].setMap(null);
    }
    self.markers = [];
    $("#ob").html('');


    var contact = ui.item.label;
        id = ui.item.value;
    console.log('Event: ', event);
    console.log('UI :', ui.item);
    $(event.currentTarget).val(contact);

    $.get('http://localhost/nature/web/app_dev.php/obs/' + id, function(response){
        console.log(response);
        document.getElementById('div2').style.display = 'block';

        for (var i = 0; i < response.length; i++) {
                var ligne = $("<tr></tr>"); 
                var date = new Date(response[i]['date'].date);
				var dateString = date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();

                ligne.append($("<td>" + dateString + "</td>"));
                ligne.append($("<td>" + response[i].username + "</td>"));
                $("#ob").append(ligne);
        }

        var image = 'http://localhost/nature/web/assets/img/markeur/crow2.png';
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
    })

    $.get('http://localhost/nature/web/app_dev.php/rechercher/' + id, function(response){
        //console.log(response[0]);
        $('#lbnomvern').html(response[0].a_nomVern)
        $('#lbauteur').html(response[0].a_lbAuteur)
        $('#famille').html(response[0].a_famille)
        $('#nomVernEng').html(response[0].a_nomVernEng)
        $('#habitat').html(response[0].a_habitat)
        $('#fr').html(response[0].a_fr)
        $('#lbnom').html(response[0].a_lbNom)
        $('#classe').html(response[0].a_classe)
        $('#ordre').html(response[0].a_ordre)
        $('#phylum').html(response[0].a_phylum)
        $('#url').html(response[0].a_url)
        $('#url').attr("href", response[0].a_url)
		$('#idEspece').html(response[0].a_id)
    })
	


	//Soumission formulaire
	$("#formobs").click(function(){
		
		document.location.href="http://localhost/nature/web/app_dev.php/saisie/" + id ;
		//window.location="http://localhost/nature/web/app_dev.php/";
		
		return false;
		//alert(date + '--' + id + '--' + latitude + '--' + longitude);

	});

})		
