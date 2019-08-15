//var test = Routing.genenrate('searchModeles');

window.onload = function () {

            var urlAjax = $('#urlAjax').val();
                    console.log(urlAjax);



    // check if input is keyup
    $('#searching').keyup(function () {

        let myString = $('#searching').val();

        let type = $('.custom-control-input:checked').val();

        //console.log(myString);
         if(myString.length > 0) {
             $.ajax({
                 method: "GET",
                 url: urlAjax+'/'+type+'/'+myString,
                 //data: { myString: myString}
             }).done(function( result ) {
                 //do your job
                 $("#results").html(result);
             });
         }
    });
}

