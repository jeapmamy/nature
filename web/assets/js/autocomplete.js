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
        $('#latitude').html(response[0].latitude)
        $('#longitude').html(response[0].longitude)
        $('#date').html(response[0]['date'].date)
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
    })


})

            var map;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 5,
                    center: new google.maps.LatLng(46.606111,1.845278),
                    mapTypeId: 'terrain'
                });

                var script = document.createElement('script');
                script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
                document.getElementsByTagName('head')[0].appendChild(script);
            }


            window.eqfeed_callback = function(results) {
                for (var i = 0; i < results.features.length; i++) {
                    var coords = results.features[i].geometry.coordinates;
                    var latLng = new google.maps.LatLng(45,3);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                }
            }