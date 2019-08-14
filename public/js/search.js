//var test = Routing.genenrate('searchModeles');

window.onload = function () {

            var urlAjax = $('#urlAjax').val();
                    console.log(urlAjax);



    // check if input is keyup
    $('#modeleSearching').keyup(function () {

        let myString = $('#modeleSearching').val();

        let type = $('#typeSearch').val();

        //console.log(myString);
         if(myString.length > 1) {
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

