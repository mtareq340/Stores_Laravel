$(document).ready(function(){

	//add material btn
	$('.add-material-btn').on('click',function(e) {
		e.preventDefault();

		var name  = $(this).data('name');
		var id = $(this).data('id');
        var price = $.number($(this).data('price'), 5);
        
      
    
		$(this).removeClass('btn-success').addClass('btn-default disabled');

		var html =
            `<tr>
                <td>${name}</td>
                <td><input type="number" name="materials[${id}][quantity]" data-price="${price}" 
                class="form-control input-sm material-quantity" min="1" value="1"></td>
                <input type=hidden  name=""materials_added[${id}]" />
                <td class="material-price">${price}</td>               
                <td><button class="btn btn-danger btn-sm remove-material-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;
    
             $('.material-list').append(html);

            //to calculate total price
       	 calculateSum();

	});

	 $('body').on('click', '.disabled', function(e) {

        e.preventDefault();

    });//end of disabled

        //remove-material-btn

	   $('body').on('click', '.remove-material-btn', function(e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#material-' + id).removeClass('btn-default disabled').addClass('btn-success');

        //to calculate total price
        calculateSum();

    });//end of remove product btn

       //change product quantity
    $('body').on('keyup change', '.material-quantity', function() {

        var quantity = Number($(this).val()); //2
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
        $(this).closest('tr').find('.material-price').html($.number(quantity * unitPrice, 5));
       // $("#total_price").val($.number(unitPrice, 5));
        calculateSum();
    });//end of product quantity change

    


  });

function calculateSum() {

    var price = 0.00000;

    $('.material-list .material-price').each(function(index) {
        
        price += parseFloat($(this).html().replace(/,/g, ''));

    });//end of product price

    $('.total-price').html($.number(price, 5));
    //   $("#total_price").val($.number(price, 5));
     // document.getElementById("#total_price").innerHTML = price;

    //check if price > 0
    if (price > 0) {

        $('#add-material-form-btn').removeClass('disabled')

    } else {

        $('#add-material-form-btn').addClass('disabled')

    }//end of else

}//end of calculate total

