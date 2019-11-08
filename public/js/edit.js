$(document).ready(function(){
    $('.collapsible').collapsible();
    $('#Add2').click( function (e) {
      e.preventDefault();
      if (
        confirm('Voulez-vous supprimer ?')
        ) {
        return true;
      } else {
        return false;
      }
    })
  });
