<div id="print-area">

<form class="form" action="{{ route('cacheir.orders.priceconfirm', $order) }}" method="post"  
          enctype="multipart/form-data">
          @csrf

    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th></th>
            <th>الخدمة</th>
            <th>الكمية</th>
            <th>سعر (الوحده)</th>
            <!-- <th>التكلفة</th> -->
        </tr>
        </thead>

        <tbody>

            @foreach ($products as $product)
                @if($product->price_value == 2)
                    <tr style="background-color:#C0C0C0;">
                        <td>{{ $product->category['name'] }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td><input type="number" min="0" value="{{ $product->pivot->price }}" class="product-price" name="products[{{$product->id}}][price]" style="width: 4em"></td>
                        <!-- <td data-price="price_value">0</td> -->
                    </tr>
                @else
                <tr>
                        <td>{{ $product->category['name'] }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->price }}</td>
                        <!-- <td>{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}</td> -->
                    </tr>
                @endif
            
        @endforeach

     
        </tbody>
    </table>
    <!-- <h3> المجموع <span>{{ number_format($order->total_price, 2) }}</span></h3> -->
        @if($order->price_confirmed == 0)
        <button type="submit" class="btn btn-block btn-primary "><i class="fa fa-edit"></i> تأكيد الاسعار </button>
        @endif
    </form>

</div>

<!-- <button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> طباعة </button> -->


