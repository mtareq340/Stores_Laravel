<!-- begin index.tpl -->
<!doctype html>
<html lang="ar">
  <head>

    @include('admin.includes.sitehead')

  </head>
  <body id="index" class="lang-ar lang-rtl country-gb currency-gbp layout-full-width page-index tax-display-enabled">
  

<div id="print-area">
    <div>
        <h3>#رقم الفاتورة : {{$order->id}}</h3>
    </div>
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th style="font-size:20px;"></th>
            <th style="font-size:20px;">الخدمات</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->category['name'] }}</td>
                <td>{{ $product->name }}</td>
                <!-- <td>{{ $product->pivot->quantity }}</td> 
                <td>{{ number_format($product->pivot->quantity * $product->price, 2) }}</td>  -->
            </tr>
        @endforeach
        </tbody>
    </table>

  <center><h4>من فضلك اتجه الي الكاشير للدفع</h4></center>  

</div>


<center><button style="margin-top:70px;" class="btn btn-primary print-order_numberbtn" ><i class="fa fa-print"></i> طباعة </button></center>



@include('admin.includes.sitefooter')


</body>
</html>