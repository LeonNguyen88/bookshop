$(document).ready(function(){
    $('.add-to-cart-js').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: "/cart/" +id,
            type: "GET",
            success: function (result) {
                $(window).scrollTop(0);
                if($.isNumeric(result)){
                    $('.cart-count').text(result);
                    $('.cart-message').show();
                }
                else alert(result);
            }
        });
        return false;
    }) ;
});