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

        let type = $('#selTest').val();
        let primary = $('#primary').val();

        if (type == 'Brand') {
            $('#secondary').show();
            $.ajax({
                 method: "GET",
                 url: urlAjax + type + '/' + primary
             }).done(function( result ) {
                 //do your job
                 $(function() {
                      // choose target dropdown
                      var select = $('#secondary');
                      select.html(select.find('option').sort(function(x, y) {
                        // to change to descending order switch "<" for ">"
                        return $(x).text() === $(y).text() ? 0 : $(x).text() === $(y).text() ? -1 : 1;
                      }));
                      // select default item after sorting (first item)
                      $('#secondary').val(0).prop('selected', true);
                    });
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

}

function cleanUp() {
    $("#results").html('');
    $('#primary').html('');
    $('#secondary').html('');
}


