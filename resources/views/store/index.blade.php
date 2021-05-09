<!-- begin index.tpl -->
<!doctype html>
<html lang="ar">
  <head>

    @include('admin.includes.sitehead')
   

  </head>
  <body id="index" class="lang-ar lang-rtl country-gb currency-gbp layout-full-width page-index tax-display-enabled">



  <div class="header" id="home">
    <div class=" white agile-info">
        <nav class="navbar navbar-default " role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
     
                </div>

                <div class="nav navbar-nav  mr-auto" id="bs-example-navbar-collapse-1" style="margin-right: -5%">

                    <nav class="link-effect-2" id="link-effect-2">
                        <ul class="nav navbar-nav navbar-right mr-auto" >
                           
                            <li>
                              <a style="margin-top: -5%" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="float: right;background: #23B684;width: 100%;color: white" class="btn btn-block"> 
                                     <i class="fa fa-user" aria-hidden="true"> </i> تسجيل الخروج</button></a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                     </form>
                            </li>

                        </ul>


                    </nav>
                </div>
           
            </div>
        </nav>
    </div>
</div> 






  <form action="{{ route('store.orders.store')}}" method="post">

{{ csrf_field() }}
{{ method_field('post') }}

            <div class="row" style="margin-top:20px;">
                <div class="col-sm-8 col-sm-offset-2 form-group" style="text-align:center;">
                    {!! Form::label('technical_id', 'اختر أسم العامل', ['class' => 'control-label l']) !!}
                    {!! Form::select('technical_id', $technicals, old('technical_id'), ['class' => 'form-control select']) !!}
                    <p class="help-block"></p>
                    @error('technical_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

   <header id="header" class="header-3 sticky-menu">


   </header>

  
                        
        <div class="content-wrapper" style="margin:10px; ">

                
                <section class="content-header">
                   <h1>اضافة فاتورة</h1>
                    </section>


                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')
                    
                    <section class="content">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="box box-primary">

                                    <div class="box-header">

                                        <h3 class="box-title" style="margin-bottom: 10px">الخدمات</h3>

                                    </div><!-- end of box header -->

                                    <div class="box-body">

                                            
                                            <div class="panel-group">

                                                <div class="panel panel-info">

                                            


                                                        <div class="panel-body">

                                                            @if ($country->products->count() > 0)

                                                                <table class="table table-hover">
                                                                    <tr>
                                                                        <th>الخدمة</th>
                                                                        <th>سعر الخدمة</th>
                                                                        <th>اضافة</th>
                                                                    </tr>

                                                                    @foreach ($country->products as $product)
                                                                    <tr>
                                                                            <td>{{ $product->name }}</td>
                                                                            <!-- <td>{{ $product->pivot->price }}</td> -->
                                                                            @if($product->pivot->price == 0)
                                                                                <td> لم يتم تحديد السعر </td> 
                                                                                <td>
                                                                                <a href=""
                                                                                id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price="{{ $product->pivot->price }}"
                                                                                class="btn btn-success btn-sm add-product-btn disabled">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a>
                                                                                </td>
                                                                            @else  <td> {{ number_format($product->pivot->price, 2) }}</td>
                                                                            <td>
                                                                                <a href=""
                                                                                id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price="{{ $product->pivot->price }}"
                                                                                class="btn btn-success btn-sm add-product-btn">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a>
                                                                            </td>
                                                                            @endif

                                                                        
                                                                        </tr>
                                                                    @endforeach 
                                                                    @foreach ($storeproducts as $product)
                                                                        <tr>
                                                                            <td>{{ $product->name }}</td>
                                                                            <!-- <td>{{ $product->pivot->price }}</td> -->
                                                                            @if($product->pivot->price == 0)
                                                                                <td> لم يتم تحديد السعر</td> 
                                                                                <td>
                                                                                <a href=""
                                                                                id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price="{{ $product->pivot->price }}"
                                                                                class="btn btn-success btn-sm add-product-btn disabled">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a>
                                                                                </td>
                                                                            @else  <td> {{ number_format($product->pivot->price, 2) }}</td>
                                                                            <td>
                                                                                <a href=""
                                                                                id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price="{{ $product->pivot->price }}"
                                                                                class="btn btn-success btn-sm add-product-btn">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a>
                                                                            </td>
                                                                            @endif

                                                                        
                                                                        </tr>
                                                                    @endforeach 

                                                                    @foreach ($products_during_paid as $product)
                                                                        <tr>
                                                                            <td>{{ $product->name }}</td>
                                                                            <td>تابع للكاشير</td>
                                                               
                                                                            <td>
                                                                                <a href=""
                                                                                id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price=""
                                                                                class="btn btn-success btn-sm add-product-btn">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a>
                                                                            </td>

                                                                        
                                                                        </tr>
                                                                    @endforeach 
                                                      
                                                                    

                                                                </table><!-- end of table -->

                                                            @else
                                                                <h5>لا يوجد</h5>
                                                            @endif

                                                        </div><!-- end of panel body -->

                                                <!-- end of panel collapse -->

                                                </div><!-- end of panel primary -->

                                            </div><!-- end of panel group -->


                                    </div><!-- end of box body -->

                                </div><!-- end of box -->

                            </div><!-- end of col -->

                            <div class="col-md-6">

                                <div class="box box-primary">

                                    <div class="box-header">

                                        <h3 class="box-title">الطلبات</h3>

                                    </div><!-- end of box header -->

                                    <div class="box-body">


                                            <table class="table table-hover" id="print-area">
                                                <thead>
                                                <tr>
                                                    <th>الخدمة</th>
                                                    <th>العدد</th>
                                                    <!-- <th>السعر</th> -->
                                                </tr>
                                                </thead>

                                                <tbody class="order-list">


                                                </tbody>

                                            </table><!-- end of table -->

                                            <!-- <h4>المجموع : <span class="total-price">0</span></h4> -->
                                            @if($shift->start == 1)
                                            <button class="btn btn-primary  btn-block disabled"  id="add-order-form-btn" ><i class="fa fa-plus"></i>اضافة فاتورة</button>
                                            @else
                                          <center>
                                          <h3> الكاشير لم يبدء اليوم </h3> 
                                          </center>  
                                            @endif
                                        </form>


                                    </div><!-- end of box body -->

                                </div><!-- end of box -->

                        

                            </div><!-- end of col -->

                        </div><!-- end of row -->

                    </section><!-- end of content -->

        </div><!-- end of content wrapper -->




            

            </div><!-- end of wrapper -->




      
      
     @include('admin.includes.sitefooter')


      </body>
</html>
<!-- end index.tpl -->
