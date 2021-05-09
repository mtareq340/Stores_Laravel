$(document).ready(function () {
    
    //add product btn
    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        //  var price = $.number($(this).data('price'), 2);

        $(this).removeClass('btn-success').addClass('btn-default disabled');

        var html =
            `<tr>
                <td>${name}</td>
                <td><input type="number" name="mainproducts[${id}][quantity]" data-price=""
                 class="form-control input-sm product-quantity" min="1" value="1"></td>
                 <td><input type="number" id="unitPrice" step="0.01" name="mainproducts[${id}][unitprice]" data-price="unitprice"
                 class="form-control input-sm product-unitprice" min="1" value="1"></td>

                 <td class="product-price">1</td>            

                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;

        $('.order-list').append(html);

        calculateTotal();
  
    });

    //disabled btn
    $('body').on('click', '.disabled', function(e) {

        e.preventDefault();

    });//end of disabled

    //remove product btn
    $('body').on('click', '.remove-product-btn', function(e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        calculateTotal();

    });//end of remove product btn

    //change product quantity
    $('body').on('keyup change', '.product-quantity', function() {
        var quantity = Number($(this).val()); //2 product-unitprice
        var unitPrice = $(this).closest('tr').find('.product-unitprice').val(); 
        
        $(this).closest('tr').find('.product-price').html((quantity * unitPrice).toFixed(2));
        calculateTotal();

    });//end of product quantity change

    $('body').on('keyup change', '.product-unitprice', function() {
        var quantity = $(this).closest('tr').find('.product-quantity').val();  //2 product-unitprice
        var unitPrice = Number($(this).val());
        
        $(this).closest('tr').find('.product-price').html((quantity * unitPrice).toFixed(2));
        calculateTotal();

    });//end of product product-unitprice change

    
    $('body').on('keyup change', '.total_price', function() {

    var total_price = (Number($(this).val())).toFixed(2);
    var paid_price = document.getElementById("paid_price").value;
    document.getElementById("remaining_price").value = (total_price - paid_price).toFixed(2);
    if (paid_price > this.value) {
        document.getElementById("paid_price").value = this.value;
        document.getElementById("remaining_price").value = 0.00;
    } 
    });//end of product total_price change

    $('body').on('keyup change', '.paid_price', function() {
    var total_price = document.getElementById("total_price").value; 
    var paid_price = document.getElementById("paid_price").value; 
    if (paid_price > total_price) {
        this.value = total_price;
    } 
    document.getElementById("remaining_price").value = (total_price - Number($(this).val())).toFixed(2);
    });//end of product paid_price change


    });//end of document ready

    function calculateTotal() {

        var price = 0;

        $('.order-list .product-price').each(function(index) {
            
            price += parseFloat($(this).html().replace(/,/g, ''));

        });//end of product price

        $('.total-price').html(price.toFixed(2));
        document.getElementById("total_price").value = price.toFixed(2);
        //check if price > 0
        if (price > 0) {

            $('#add-order-form-btn').removeClass('disabled')

        } else {

            $('#add-order-form-btn').addClass('disabled')

        }//end of else

    }//end of calculate total