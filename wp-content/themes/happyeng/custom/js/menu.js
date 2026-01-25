$(function () {
    "use strict";

    $('ul.sub-menu').each(function() {
        $(this).parent().addClass('dropdown');
        $(this).siblings('a').append('<i class="bi bi-chevron-down dropdown-indicator"></i>').attr('href', '#');
    });
});