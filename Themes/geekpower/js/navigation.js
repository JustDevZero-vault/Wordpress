$(document).ready(function() {
    // Muestra y oculta los menús
    $('ul#menu-secondary li:has(ul)').hover(
        function(e)
        {
            $(this).find('ul').fadeIn('slow');
        },
        function(e)
        {
            $(this).find('ul').fadeOut('slow');
        }
    );
});