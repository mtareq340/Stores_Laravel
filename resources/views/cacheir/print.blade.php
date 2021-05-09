<!-- begin index.tpl -->
<!doctype html>
<html lang="ar">
  <head>
    @include('admin.includes.sitehead')
    
  </head>
  <body id="index" class="lang-ar lang-rtl country-gb currency-gbp layout-full-width page-index tax-display-enabled">



  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper">
  <!-- Main content -->
  <section class="invoice" style="margin-right:50px;">
    <!-- title row -->
    <!-- <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Tires Plus, Inc.
          <small class="float-right"> {{ $order->created_at->toFormattedDateString ()}} التاريخ:</small>
        </h2>
      </div>
    </div> -->
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        من
        <address>
          <strong>Tires Plus.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        الي
        <address>
          <strong>{{ $client->name }}</strong><br>
          <!-- 795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br> -->
          الموبيل: {{ $client->phone }}<br>
          <!-- Email: john.doe@example.com -->
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>الفاتورة </b><br>
        <br>
        <b>رقم الفاتورة:</b> {{ $order->id }}<br>
        <b>تاريخ الدفع:</b> {{ $order->created_at->toFormattedDateString() }}<br>
        <!-- <b>Account:</b> 968-34567 -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>الخدمة</th>
            <th>العدد</th>
            <th>تكلفة (الوحده)</th>
            <th>تكلفة الخدمة</th>
          </tr>
          </thead>
          <tbody>
        @foreach($order->products as $order_item)
          <tr>
            <td>{{ $order_item->name}}</td>
            <td>{{ $order_item->pivot->quantity }}</td>
            <td>{{ $order_item->pivot->price }}</td>
            <td>{{ number_format($order_item->pivot->quantity * $order_item->pivot->price, 2) }}</td>
          </tr> 
       @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
 
      <!-- /.col -->
      <div class="col-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">السعر:</th>
              <td> {{ number_format($order->total_price, 2) }}</td>
            </tr>
            <!-- <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr> -->
            <tr>
              <th>الخصم:</th>
              <td>{{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr>
              <th>المبلغ المدفوع:</th>
              <td>{{ number_format($order->price_after_discount, 2) }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<button class="btn btn-block btn-primary print-order"><i class="fa fa-print"></i> طباعة </button> -->

<!-- Page specific script -->
<script>

//   window.addEventListener("load", window.print());
//   window.location.href='http://127.0.0.1:8000/cacheir';
</script>






  
  <!-- <div id="print-area">
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th></th>
            <th>الخدمة</th>
            <th>الكمية</th>
            <th>التكلفة</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($order->products as $product)
            <tr>
                <td>{{ $product->category['name'] }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3> المجموع <span>{{ number_format($order->total_price, 2) }}</span></h3>

</div>

<button class="btn btn-block btn-primary print-order"><i class="fa fa-print"></i> طباعة </button> -->

@include('admin.includes.sitefooter')


</body>
</html>


