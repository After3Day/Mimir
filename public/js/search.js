window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    $('.custom-control-input').on('change', function(){
        $("#results").html('');
        $("#searching").val('');
    });

    // check if input is keyup
    $('#searching').keyup(function () {

        let myString = $('#searching').val();

        let type = $('.custom-control-input:checked').val();

         if(myString.length > 0) {
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

