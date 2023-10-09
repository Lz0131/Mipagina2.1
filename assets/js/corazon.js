// jQuery
$(document).ready(function() {
  $('.heart').on('click', function() {
    $(this).toggleClass('heart_animate');
    // Agrega o quita la clase 'heart_animate' para activar o desactivar la animación
  });
});
