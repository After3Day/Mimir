var elems = document.querySelectorAll('.collapsible');
var instances = M.Collapsible.init(elems);


    $('#DeleteModele').click( function (e) {

      if (
        confirm('Voulez-vous supprimer ?')
        ) {
        return true;
      } else {
        return false;
      }
    })
