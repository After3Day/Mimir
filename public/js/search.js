window.onload = function () {

    $('select').formSelect();



    var urlAjax = $('#urlAjax').val();
    var type = $('#selTest').val();

    $('#primary').hide();
    $('#secondary').hide();
    $('#idNumberDiv').hide();

    $('#selTest').on('change', function() {

        cleanUp();

        $('#primary').show();
        $('#secondary').hide();
        $('#idNumberDiv').hide();

        type = $('#selTest :selected').val();

        if(type == 'Brand') {
            $('#idNumberDiv').show();
        }

        $.ajax({
            method: "GET",
            url: urlAjax + type
        }).done(function( result ) {
            //do your job
            $("#primary").html(result);
        });
    });

    $('#search').keyup(function() {

        let myString = $('#search').val();
        let type = $('#selTest :selected').val();
        let criteria = $('#selCrit :selected').val();

        if(myString.length > 1) {
            $.ajax({
                method: "GET",
                url: urlAjax + 'numbers/' + criteria + '/' + myString
            }).done(function( result ) {
                //do your job
                $("#results").html(result);
            });
        }
    });

    $('#primary').on('change', function() {

        let type = $('#selTest :selected').val();
        let primary = $('#primary :selected').val();

        if (type == 'Brand') {
            $('#secondary').show();
            $.ajax({
                method: "GET",
                url: urlAjax + type + '/' + primary
            }).done(function( result ) {
                //do your job
                $('select').formSelect();
                $("#secondary").html(result);
            });
        } else {
            $.ajax({
                method: "GET",
                url: urlAjax + 'result/' + type + '/' + primary
            }).done(function( result ) {
                //do your job
                $("#results").html(result);
                $('select').formSelect();
            });
        }
    });

    $("#secondary").on('change', function() {

        let primary = $('#primary :selected').val();
        let secondary = $('#secondary :selected').val();

        if (secondary != null) {
            if ( type != 'Club' || type != 'Event') {
                secondary = '/'+ secondary;
                type = 'Modele';
            } else {
                secondary = null;
            }
        }
        $.ajax({
            method: "GET",
            url: urlAjax + 'result/' + type + '/' + primary  + secondary
        }).done(function( result ) {
            //do your job
            $("#results").html(result);
        });
    });

    $('#close').on('click', function() {
        $('#search').val('');
    });
}
function cleanUp() {
    $("#results").html('');
    $('#primary').html('');
    $('#secondary').html('');
}
