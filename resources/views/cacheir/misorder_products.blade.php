<div id="print-area">
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th>الاسم</th>
            <!-- <th>الكمية</th> -->
            <!-- <th>التكلفة</th> -->
        </tr>
        </thead>

        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <!-- <td>{{ $product->pivot->quantity }}</td> -->
                <!-- <td>{{ number_format($product->pivot->quantity * $product->price, 2) }}</td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3> المجموع <span>{{ number_format($misorder->total_price, 2) }}</span></h3>

</div>

