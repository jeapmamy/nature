

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

    $.get('http://localhost/nature/web/app_dev.php/obs/' + id, function(response){
        console.log(response);
        document.getElementById('div2').style.display = 'block';
       /* $('#latitude').html(response[0].latitude)
        $('#longitude').html(response[0].longitude)
        $('#date').html(response[0]['date'].date)*/

        //boucle reponse
        //if(response.length>0) {
            for (var i = 0; i < response.length; i++) {
                    var ligne = $("<tr></tr>"); 
                    ligne.append($("<td>" + response[i]['date'].date + "</td>"));
                    ligne.append($("<td>" + response[i].username + "</td>"));
                    $("#ob").append(ligne);
            }
       // }

        var markers = [];

        $.each(response, function(ix, obs) {
            console.log(obs);
            var marker = new google.maps.Marker({
                position: {
                    lat: obs.latitude*1,
                    lng: obs.longitude*1
                },
                map: self.map
            });
            markers.push(marker);
        });
    })

    $.get('http://localhost/nature/web/app_dev.php/rechercher/' + id, function(response){
        //console.log(response);
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
    })


    //Soumission formulaire
    $("#formobs").submit(function(){
        date = $(this).find("#corebundle_observation_date").val();
        latitude = $(this).find("#corebundle_observation_latitude").val();
        longitude = $(this).find("#corebundle_observation_longitude").val();
        image = $(this).find("#corebundle_observation_image_file").val();
        
        $.post(
            'http://localhost/nature/web/app_dev.php/observation', 
            {date: date, latitude: latitude, longitude: longitude, id_espece: id, image: image}, 
            function(datae) {
            console.log(datae);
            }
        );
        return false;
        //alert(date + '--' + id + '--' + latitude + '--' + longitude);

    });
})