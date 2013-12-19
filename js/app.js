$(document).ready(function () {

   /** delete tag */
    $('a.delete-tag').ajax_delete({
        post: 'delete-tag',
        element: 'p'
    });
    event.preventDefault();
    
    /** add some animation */
    $('#login .alert-animated').addClass('animated bounceInDown');
    $('#content .alert-animated').addClass('animated bounceIn');

    /** create modal */
    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none'
    });


});