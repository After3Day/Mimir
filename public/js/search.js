window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    var type = $('#selTest').val();

    $('#primary').hide();
    $('#secondary').hide();

    $('#selTest').on('change', function() {
        cleanUp();
        $('#primary').show();
        $('#secondary').hide();

        type = $('#selTest').val();


        $.ajax({
                 method: "GET",
                 url: urlAjax + type
             }).done(function( result ) {
                 //do your job
                 $("#primary").html(result);
             });
    });


    $('#primary').on('change', function() {

        let primary = $('#primary').val();

        if (type != 'Club' && type != 'Event') {
            $('#secondary').show();

            $.ajax({
                 method: "GET",
                 url: urlAjax + type + '/' + primary
             }).done(function( result ) {
                 //do your job
                 $("#secondary").html(result);
             });
        } else {
            $.ajax({
                 method: "GET",
                 url: urlAjax + 'result/' + type + '/' + primary
             }).done(function( result ) {
                 //do your job
                 $("#results").html(result);
             });
        }



    });


    $("#secondary").on('change', function() {

        let primary = $('#primary').val();
        let secondary = $("#secondary").val();

        if (secondary != null) {
            if ( type != 'Club' || type != 'Event') {
                secondary = '/'+ secondary;
                console.log(secondary);
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

}

function cleanUp() {
    $("#results").html('');
    $('#primary').html('');
    $('#secondary').html('');
}


