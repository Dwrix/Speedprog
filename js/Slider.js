$(document).ready(function () {
  /*------- SLIDER ------- */  
    var imgItems = $('.slider li').length;
    var imgPos = 0;
  
    for (var i = 0; i < imgItems; i++) {

        $('.paginacion').append("<li class='fa fa-book'></li>");
    }
   
    $('.slider li').hide();
    $('.slider li').first().show();
   
    $('.paginacion li').first().css({ 'color': 'black' });
 
    $('.paginacion li').click(paginacion);
    $('.izq span').click(anterior);
    $('.der span').click(siguiente);

    setInterval(function () {
        siguiente();
    }, 10000);


    function paginacion() {

        var pagPos = $(this).index();
        $('.slider li').hide();
        $('.slider li').eq(pagPos).fadeIn();
        
        $('.paginacion li').css({ 'color': 'gray' });
        $('.paginacion li').eq(pagPos).css({ 'color': 'black' })

        imgPos = pagPos;

    }

    function siguiente() {

        if (imgPos < imgItems - 1) {
            imgPos++;
        } else {
            imgPos = 0;
        }


        $('.slider li').hide();
        $('.slider li').eq(imgPos).fadeIn();

        $('.paginacion li').css({ 'color': 'gray' });
        $('.paginacion li').eq(imgPos).css({ 'color': 'black' })
    }

    function anterior() {

        if (imgPos < 1) {
            imgPos = imgItems - 1;
        } else {
            imgPos--;
        }
        $('.slider li').hide();
        $('.slider li').eq(imgPos).fadeIn();

    }



});