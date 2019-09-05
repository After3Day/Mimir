window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    var type = $('#selTest').val();

    $('#nameDesignerSearch').hide();
    $('#nameCollectorSearch').hide();


    $('#brandSearch').on('change', function() {
        cleanUp();
    });

    $('#selTest').on('change', function() {
        type = $('#selTest').val();
        $('#brandSearch').val(0);
        $('#nameCollectorSearch').val(0);
        $('#nameDesignerSearch').val(0);
        cleanUp();
        testSelect();

    });



    $('#searching').on("paste keyup", function () {

        let myString = $('#searching').val();
        let criteria = $('#brandSearch').val();

        if ( type === 'Designer') {
            let criteria = $('#nameDesignerSearch').val();
        } else if ( type === 'Collector') {
            let criteria = $('#nameCollectorSearch').val();
        } else {
            let criteria = '';
        }

        if (myString === '') {
            cleanUp();
        }

         if(myString.length > 0 ) {

             $.ajax({
                 method: "GET",
                 url: urlAjax+'/'+type+'/'+criteria+'/'+myString
             }).done(function( result ) {
                 //do your job
                 $("#results").html(result);
             });
         }
    });
}

function cleanUp() {
    $("#results").html('');
    $("#searching").val('');
    $('#nameSearch').val(0);
    $('#surnameSearch').val('');
}

function testSelect() {
    if ($('#selTest').val() != 'Modele') {
    $('#brandSearch').hide();
    $('#nameDesignerSearch').hide();
    $('#nameCollectorSearch').hide();
    $('#surnameSearch').hide();

        if($('#selTest').val() != 'Club' && $('#selTest').val() != 'Event') {

            if ($('#selTest').val() != 'Designer') {
                $('#nameCollectorSearch').show();
            } else {
                $('#nameDesignerSearch').show();
            }

            $('#surnameSearch').show();
        }
    } else {
        $('#brandSearch').show();
        $('#nameDesignerSearch').hide();
        $('#nameCollectorSearch').hide();
        $('#surnameSearch').hide();
    }
}



/*
class SearchItems {

    constructor() {

        this.type = $('#selTest').val();
        this.myString = $('#searching').val();
        this.urlAjax = $('#urlAjax').val();
    }

    search()
}
*/
