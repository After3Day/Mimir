var $collectionHolder; //Version

var $collection2Holder; // Designer

//Créer un bouton pour chaque element
//Créer une function pour factoriser
//split -> récupérer un id par ex

// setup an "add a tag" link
var $addTagButton = $('<button type="button" class="add_tag_link btn btn-primary">Ajouter une version</button>');
var $newLinkLi = $('<li></li>').append($addTagButton);

var $addTag2Button = $('<button type="button" class="add_tag_link btn btn-primary">Ajouter un Designer</button>');
var $newLink2Li = $('<li></li>').append($addTag2Button);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.versions');
    $collection2Holder = $('ul.designers');
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    $collection2Holder.append($newLink2Li);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $collection2Holder.data('index', $collectionHolder.find(':input').length);

    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
        $addTag2Button.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collection2Holder, $newLink2Li);
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
}
