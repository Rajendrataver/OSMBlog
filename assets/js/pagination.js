$(document).ready(function () {
    var rowsShown = 6;
    var rowsTotal = document.getElementsByClassName('blog').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('.blog').hide();
    $('.blog').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');


    $('#nav a').bind('click', function () {
        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('.blog').css('opacity', '0.0').hide().slice(startItem, endItem).
            css('display', 'flex').animate({ opacity: 1 }, 300);
    });
}); 