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
    $.get('http://localhost/nature/web/app_dev.php/rechercher/' + id, function(response){
        console.log(response);
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