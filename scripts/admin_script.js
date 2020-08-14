$('#hamburguer_menu').click(function() {
    $('.to_hide').toggleClass('hidden');
    $(this).toggleClass('closed');
})

function activateHamburguerMenu(size) {
    if (size.matches) {
        $('.to_hide').addClass('hidden');
        $('#hamburguer_menu').removeClass('hidden');
    } else {
        $('.to_hide').removeClass('hidden');
        $('#hamburguer_menu').addClass('hidden');
    }
  }
  
  var size = window.matchMedia("(max-width: 768px)")
  activateHamburguerMenu(size)
  size.addListener(activateHamburguerMenu)