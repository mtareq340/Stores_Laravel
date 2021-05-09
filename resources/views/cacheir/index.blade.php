@extends('cacheir.layout')

@section('navbar')

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
                            <li class="nav-item active"><a href="{{ route('cacheir') }}" class="effect-3">الرئيسية</a></li>
                           
                            <!-- <li class="nav-item"><a href="{{ route('cacheir.misorders') }}" class="effect-3">الفواتير الملغية</a></li> -->

                            <li class="nav-item"><a href="{{ route('cacheir.stock')}}" class="effect-3">المخزن</a></li>
                            <li class="nav-item "><a href="{{ route('cacheir.productsprice.index')}}" class="effect-3">اسعار الخدمات</a></li>
                            <li class="nav-item "><a href="{{ route('cacheir.reports')}}" class="effect-3">التقارير</a></li>

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

@endsection


@section('content')
<style>
.disabled{
  pointer-events: none;
}

</style>

<section class="content">

    <div class="row">

        <div class="col-md-8">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title" style="margin-bottom: 10px">الفواتير</h3>

                    <form action="{{ route('cacheir')}}" method="get">

                        <div class="row">

                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="بحث" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>بحث</button>
                            </div>

                        </div><!-- end of row -->

                    </form><!-- end of form -->

                </div><!-- end of box header -->

                @if ($orders->count() > 0)

                            <div class="box-body table-responsive">

                                <table class="table table-bordered table-striped {{ count($orders) > 0 ? 'data-table' : '' }} dt-select">
                                    <thead class="sorting">
                                        <tr>
                                            <th class=""> الفاتورة</th>
                                            <th>التكلفة</th>
                                            <th>تم اضافته</th>
                                            <th>الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr data-entry-id="{{ $order->id }}">
                                                <td>{{ $order->id }}</td>
                                     
                                                <td>{{ number_format($order->total_price, 2) }}</td>
                                                <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm order-products"
                                                            data-url="{{ route('cacheir.orders.products', $order->id) }}"
                                                            data-method="get"
                                                    >
                                                        <i class="fa fa-list"></i>
                                                        عرض الأسعار
                                                    </button>
                                                    @if($order->confirmed == 0 && $order->price_confirmed == 1)
                                                    <a href="{{route('cacheir.order.clients', ['id' => $order->id])}}"
                                                                   class="btn btn-success btn-sm"> <i class="fa fa-pencil"></i>تأكيد الدفع</a>
                                                    @elseif( $order->price_confirmed == 0)
                                                    <a href="{{route('cacheir.order.clients', ['id' => $order->id])}}"
                                                                   class="btn btn-success btn-sm disabled"> <i class="fa fa-pencil"></i>تأكيد الدفع</a> 
                                                    @else               
                                                    @endif
                                                     @if($order->confirmed == 0)
                                                     <form action="{{ route('cacheir.orders.destroy', $order) }}" method="post" style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> الغاء </button>
                                                    </form> 
                                                    @else
                                                    <!-- <button  class="btn btn-danger delete btn-sm disabled"><i class="fa fa-trash"></i> الغاء </button> -->
                                                    @endif

                                                </td>

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table><!-- end of table -->
                                {{ $orders->appends(request()->query())->links() }}


                            </div>

                        @else

                            <div class="box-body">
                                <h3>لا توجد فواتير</h3>
                            </div>

                        @endif


            </div><!-- end of box -->

        </div><!-- end of col -->

        <div class="col-md-4">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 10px">عرض الخدمات</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                        <div class="loader"></div>
                        <p style="margin-top: 10px">جاري التحميل</p>
                    </div>

                    <div id="order-product-list">

                    </div><!-- end of order product list -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </div><!-- end of col -->

    </div><!-- end of row -->

</section><!-- end of content section -->


@endsection
