$(document).ready(function(){
    $('.add-to-cart-js').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/cart/" + id,
            type: "POST",
            data: "id=" + id,
            success: function (result) {
                $(window).scrollTop(0);
                if($.type(result) === "object"){
                    $('.cart-count').text(result.total_qty);
                    $('.cart-message').show();
                }
                else alert(result);
            }
        });
        return false;
    }) ;
    $('.addqty').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/cart/" + id,
            type: "POST",
            data: "id=" +id,
            success: function (result) {
                if($.type(result) === "object"){
                    $('.item_qty'+id).text(result.item_qty);
                    $('.item_price'+id).text(result.item_price.toLocaleString('vi-vn'));
                    $('#sum_price_old').text(result.sum_price_old.toLocaleString('vi-vn'));
                    $('#total_qty').text(result.total_qty);
                    $('#sum_sale').text(result.sum_sale.toLocaleString('vi-vn'));
                    $('#subtotal').text(result.subtotal.toLocaleString('vi-vn'));
                    if(result.item_qty == 0){
                        $('.row_cart'+id).remove();
                    }
                    $('.cart-count').text(result.total_qty);
                }
                else alert(result);
            }
        });
        return false;
    });
    $('.decreaseqty').click(function(){
       var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/cart/decrease/" + id,
            type: "post",
            data: "id=" +id,
            success: function (result) {
                $('.item_qty'+id).text(result.item_qty);
                $('.item_price'+id).text(result.item_price.toLocaleString('vi-vn'));
                $('#sum_price_old').text(result.sum_price_old.toLocaleString('vi-vn'));
                $('#total_qty').text(result.total_qty);
                $('#sum_sale').text(result.sum_sale.toLocaleString('vi-vn'));
                $('#subtotal').text(result.subtotal.toLocaleString('vi-vn'));
                if(result.item_qty == 0){
                    $('.row_cart'+id).remove();
                }
                $('.cart-count').text(result.total_qty);
            }
        });
        return false;
    });
    $('.removerow').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/cart/delete/" + id,
            type: "POST",
            data: "id=" + id,
            success: function (result) {
                $('.row_cart'+id).remove();
                $('.item_qty'+id).text(result.item_qty);
                $('.item_price'+id).text(result.item_price.toLocaleString('vi-vn'));
                $('#sum_price_old').text(result.sum_price_old.toLocaleString('vi-vn'));
                $('#total_qty').text(result.total_qty);
                $('#sum_sale').text(result.sum_sale.toLocaleString('vi-vn'));
                $('#subtotal').text(result.subtotal.toLocaleString('vi-vn'));
                $('.cart-count').text(result.total_qty);
            }
        });
        return false;
    }) ;
    $('.add-slider-btn').click(function () {
        var html = '<div class="slider-item">'+ $('.slider-item').html() + '</div>';
        //console.log(html);
        $('#slider-container').append(html);
            return false;
    });
});
