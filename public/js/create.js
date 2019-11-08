window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    var type = $('#createTest :selected').val();

    $('#createTest').on('change', function() {
        var type = $('#createTest :selected').val();
        if (type === 'Brand') {
            type = 'Modele';
        }
        $.ajax({
                 method: "GET",
                 url: urlAjax + type
             }).done(function( result ) {
                 //do your job
                 $("#create").html(result);
             });

    });


}


