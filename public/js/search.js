window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    $('.custom-control-input').on('change', function(){
        $("#results").html('');
        $("#searching").val('');
    });

    // check if input is keyup
    $('#searching').on("paste keyup", function () {

        let myString = $('#searching').val();

        if (myString === '') {
            $("#results").html('');
        }

        let type = $('.custom-control-input:checked').val();

         if(myString.length > 0 ) {
            $("#results").html('');
             $.ajax({
                 method: "GET",
                 url: urlAjax+'/'+type+'/'+myString
             }).done(function( result ) {
                 //do your job
                 $("#results").append(result);
             });
         }
    });
}

