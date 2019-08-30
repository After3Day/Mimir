window.onload = function () {

    var urlAjax = $('#urlAjax').val();

    $('#selTest').on('change', function() {
        $("#results").html('');
        $("#searching").val('');

        if ($('#selTest').val() != 'Modele') {
            $('#brandSearch').hide();
        } else {
            $('#brandSearch').show();
        }
    });

    // check if input is keyup
    $('#searching').on("paste keyup", function () {

        let myString = $('#searching').val();

        let type = $('#selTest').val();

        let brand =$('#brandSearch').val();

        if (myString === '') {
            $("#results").html('');
        }

         if(myString.length > 0 ) {
            $("#results").html('');
             $.ajax({
                 method: "GET",
                 url: urlAjax+'/'+type+'/'+brand+'/'+myString
             }).done(function( result ) {
                 //do your job
                 $("#results").html(result);
             });
         }
    });
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
