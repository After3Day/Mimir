var $collectionHolder; //Version

//Créer un bouton pour chaque element
//Créer une function pour factoriser
//split -> récupérer un id par ex

// setup an "add a tag" link
var $addTagButton = $('<button type="button" class="add_tag_link btn btn-primary">Ajouter une version</button>');
var $newLinkLi = $('<li></li>').append($addTagButton);

jQuery(document).ready(function() {

  $('#VerAdd').on('click', function(event) {
    let Value = $('#Version').val();
    Value = Value + event.target.id + ",";

    $('#Version').val(Value);
    event.target.remove();
  });

  //Designer
    $('#addDesigner').click( function() {
      let type = $('#createTest :selected').val();
      $.ajax({
        method: "GET",
        url:  '/create/Designer/'
      }).done(function( result ) {
        $("#Modal_Designer").html(result);
        document.getElementById('Add2').style.display = 'none';
      });
    });

    $('#AddDbbDes').click( function() {
      $.ajax({
        type: "POST",
        url: "/create/Designer/Js",
        data: $('#form_person_create').serialize()
      }).done( function(result) {
        $('#modele_designers').append("<option value="+result+">"+$('#designer_surname').val()+ " " +$('#designer_name').val()+"</option>");
        $('#modele_designers').formSelect();
        $('#modele_designers').val('');
      });
    });

    $('#modele_designers').on('change', function() {
      let asdf = $('#Designer').val().split(",");
      let asdf2 = $('#modele_designers :selected').val();

      if( asdf2 != null) {
        if (asdf == "") {
          asdf.push(asdf2);
          $('#Designer').val(asdf);
          $('#DesAdd').append('<li id='+asdf2+' '+'class="collection-item">'+$('#modele_designers :selected').html()+'</li>');
          $('#modele_designers').val('');
        } else {
          for ( let i = 0 ; i < asdf.length ; i++ ) {
            if ( $.inArray(asdf2, asdf) != -1) {
            } else {
              asdf.push(asdf2);
              $('#Designer').val(asdf);
              $('#DesAdd').append('<li id='+asdf2+' '+'class="collection-item">'+$('#modele_designers :selected').html()+'</li>');
              $('#modele_designers').val('');
              break;
            }
            $('#modele_designers').val('');
          }
        }
      }
    });

    $('#DesAdd').on('click', function(event) {
      let values = $('#Designer').val().split(",");
      let asdf2 = event.target.id;
      let hidden = $('#Designer');

      handleHiddenInput(values, asdf2, hidden);

    });

  //Collector
    $('#addCollector').click( function() {
      let type = $('#ecreateTest :selected').val();
      $.ajax({
        method: "GET",
        url:  '/create/Collector/'
      }).done(function( result ) {
        $("#Modal_Collector").html(result);
        document.getElementById('Add2').style.display = 'none';
      });
    });

    $('#AddDbbCol').click( function() {
      $.ajax({
        type: "POST",
        url: "/create/Collector/Js",
        data: $('#form_collector_create').serialize()
      }).done( function(result) {
        $('#modele_collectors').append("<option value="+result+">"+$('#collector_surname').val()+ " " + $('#collector_name').val()+"</option>");
        $('#modele_collectors').formSelect();
        $('#modele_collectors').val('');
      });
    });

    $('#modele_collectors').on('change', function() {
      let asdf = $('#Collector').val().split(",");
      let asdf2 = $('#modele_collectors :selected').val();

      if( asdf2 != null) {
        if (asdf == "") {
          asdf.push(asdf2);
          $('#Collector').val(asdf);
          $('#ColAdd').append("<li id="+asdf2+' '+'class="collection-item">'+$('#modele_collectors :selected').html()+"</li");
          $('#modele_collectors').val('');
        } else {
          for ( let i = 0 ; i < asdf.length ; i++ ) {
            if ( $.inArray(asdf2, asdf) != -1){
            } else {
              asdf.push(asdf2);
              $('#Collector').val(asdf);
              $('#ColAdd').append("<li id="+asdf2+' '+'class="collection-item">'+$('#modele_collectors :selected').html()+"</li");
              $('#modele_collectors').val('');
              break;
            }
            $('#modele_collectors').val('');
          }
        }
      }
    });

    $('#ColAdd').on('click', function(event) {
      let values = $('#Collector').val().split(",");
      let asdf2 = event.target.id;
      let hidden = $('#Collector');

      handleHiddenInput(values, asdf2, hidden);

    });

  //Media
    $('#addMedia').click( function() {
      let type = $('#createTest :selected').val();
      $.ajax({
        method: "GET",
        url:  '/create/Media/'
      }).done(function( result ) {
        $("#Modal_Media").html(result);
      });
    });

    $('#AddDbbMed').click( function() {
      $.ajax({
        type: "POST",
        url: "/create/Media/Js",
        data: $('#form_media_create').serialize()
      }).done( function(result) {
        $('#MedAdd').append('<li id='+result+' '+'class="collection-item">Type : '+$('#media_type').val()+'<br> '+'Nom du fichier : '+$('#media_name').val()+'</li>');
        let asdf = $('#Media').val();
        let asdf2 = result;
        asdf = asdf + ',' + asdf2;
        $('#Media').val(asdf);
      });
    });

    $('#MedAdd').on('click', function(event) {
      let values = $('#Media').val().split(",");
      let asdf2 = event.target.id;
      let hidden = $('#Media');

      handleHiddenInput(values, asdf2, hidden);
    });

  //Marque
    $('#addMarque').click( function() {
      let type = $('#ecreateTest :selected').val();
      $.ajax({
        method: "GET",
        url: '/create/Brand/'
      }).done(function( result ) {
        $("#Modal_Marque").html(result);
      });
    });

    $('#AddDbbMar').click( function() {
      $.ajax({
        type: "POST",
        url: "/create/Brand/Js",
        data: $('#form_brand_create').serialize()
      }).done( function(result) {
        $('#modele_brand').append("<option value="+result+" selected >"+$('#brand_brandName').val()+"</option>");
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

function handleHiddenInput(values, asdf2, hidden) {
  if( values != '') {
    if ( $.inArray(asdf2, values) != -1)
    {
      values.splice($.inArray(asdf2, values), 1);
      event.target.remove();
      hidden.val(values);
    } else {
      values.push(asdf2);
      hidden.val(values);
      event.target.remove();
    }
  }
}
