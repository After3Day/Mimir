var $collectionHolder; //Version

//Créer un bouton pour chaque element
//Créer une function pour factoriser
//split -> récupérer un id par ex

// setup an "add a tag" link
var $addTagButton = $('<button type="button" class="add_tag_link btn btn-primary">Ajouter une version</button>');
var $newLinkLi = $('<li></li>').append($addTagButton);


jQuery(document).ready(function() {


    //Designer
        $('#addDesigner').click( function() {
            let type = $('#createTest :selected').val();
            $.ajax({
                    method: "GET",
                    url: 'Designer/'
                }).done(function( result ) {
                    $("#Modal_Designer").html(result);
                    document.getElementById('Add2').style.display = 'none';
            });
        });

        $('#AddDbbDes').click( function() {
          $.ajax({
            type: "POST",
            url: "Designer/Js",
            data: $('#form_person_create').serialize()
            }).done( function(result) {
              $('#modele_designers').append("<option value="+result+" selected>"+$('#designer_name').val()+"</option>");
              $('#modele_designers').formSelect();
            });
        });

        $('#modele_designers').on('change', function() {
            let asdf = $('#DesAddId').val();
            let asdf2 = $('#modele_designers :selected').val();

            asdf = asdf + ',' + asdf2;

            $('#DesAddId').val(asdf);
            $('#DesAdd').append("<li id="+asdf2+">"+$('#modele_designers :selected').html()+"</li");
        });

        $('#DesAdd').on('click', function(event) {
            let values = $('#DesAddId').val().split(",");
            let newValue = "";
            for ( let i = 0 ; i < values.length ; i++ )
            {
                if ( event.target.id != values[i] )
                {
                    newValue = newValue + values[i] + ",";
                }
            }

            $('#DesAddId').val(newValue);
            event.target.remove();
        })

    //Collector
        $('#addCollector').click( function() {
            let type = $('#ecreateTest :selected').val();
            $.ajax({
                    method: "GET",
                    url: 'Collector/'
                 }).done(function( result ) {
                    $("#Modal_Collector").html(result);
                 });
        });

        $('#AddDbbCol').click( function() {
          $.ajax({
            type: "POST",
            url: "Collector/Js",
            data: $('#form_collector_create').serialize()
            }).done( function(result) {
              $('#modele_collectors').append("<option value="+result+">"+$('#collector_contact_name').val()+$('#collector_contact_surname').val()+"</option>");
              $('#modele_collectors').formSelect();
            });
        });

        $('#modele_collectors').on('change', function() {
            let asdf = $('#ColAddId').val();
            let asdf2 = $('#modele_collectors :selected').val();
            asdf = asdf + ',' + asdf2;

            $('#ColAddId').val(asdf);
            $('#ColAdd').append("<li id="+asdf2+">"+$('#modele_collectors :selected').html()+"</li");
        });

        $('#ColAdd').on('click', function(event) {
            let values = $('#ColAddId').val().split(",");
            let newValue = "";
            for ( let i = 0 ; i < values.length ; i++ )
            {
                if ( event.target.id != values[i] )
                {
                    newValue = newValue + values[i] + ",";
                }
            }

            $('#ColAddId').val(newValue);
            event.target.remove();
        })

    //Media
        $('#addMedia').click( function() {
        let type = $('#createTest :selected').val();
        console.log(type);
        $.ajax({
                method: "GET",
                url: 'Media/'
             }).done(function( result ) {
                $("#Modal_Media").html(result);
             });
        });
        $('#AddDbbMed').click( function() {
          $.ajax({
            type: "POST",
            url: "Media/Js",
            data: $('#form_media_create').serialize()
          }).done( function(result) {
              $('#MedAdd').append("<li value ="+result+">Type:"+$('#media_type').val()+"Nom du fichier:"+$('#media_name').val()+"</li>");
              let asdf = $('#MedAddId').val();
              let asdf2 = result;
              asdf = asdf + ',' + asdf2;
              $('#MedAddId').val(asdf);
            });
        });

        $('#MedAdd').on('click', function(event) {
            let values = $('#MedAddId').val().split(",");
            let newValue = "";
            for ( let i = 0 ; i < values.length ; i++ )
            {
                if ( event.target.id != values[i] )
                {
                    newValue = newValue + values[i] + ",";
                }
            }

            $('#ColAddId').val(newValue);
            event.target.remove();
            //$.ajax({
            //type: "POST"
            //url: "Media/Delete"+id,
            //});
        })

    //Marque
        $('#addMarque').click( function() {
        let type = $('#ecreateTest :selected').val();
        console.log(type);
        $.ajax({
                method: "GET",
                url: 'Brand/'
             }).done(function( result ) {
                $("#Modal_Marque").html(result);
             });
        });
        $('#AddDbbMar').click( function() {

          $.ajax({
            type: "POST",
            url: "Brand/Js",
            data: $('#form_brand_create').serialize()
          }).done( function(result) {
              console.log(result);
              $('#modele_brand').append("<option value="+result+">"+$('#brand_brandName').val()+"</option>");
              $('#modele_brand').formSelect();
            });
        });

      $('.modal').modal();
      $('select').formSelect();
        // Get the ul that holds the collection of tags
        $collectionHolder = $('ul.versions');
        // add the "add a tag" anchor and li to the tags ul
        $collectionHolder.append($newLinkLi);

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        $collectionHolder.data('index', $collectionHolder.find(':input').length);

        $addTagButton.on('click', function(e) {
            // add a new tag form (see next code block)
            addTagForm($collectionHolder, $newLinkLi);
        });

});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    $newLinkLi.before($newFormLi);
     addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<a class="btn"><i id="close" class="material-icons">close</i></a><br><br>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        $tagFormLi.remove();
    });
}
