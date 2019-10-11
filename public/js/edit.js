window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    var type = $('#editTest :selected').val();

    $('#editTest').on('change', function() {
        var type = $('#editTest :selected').val();
        $.ajax({
                 method: "GET",
                 url: urlAjax + type
             }).done(function( result ) {
                 //do your job
                 $("#edit").html(result);
             });

    });


}


