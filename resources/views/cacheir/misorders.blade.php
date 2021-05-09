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
                            <li class="nav-item "><a href="{{ route('cacheir') }}" class="effect-3">الرئيسية</a></li>
                           
                            <li class="nav-item active"><a href="{{ route('cacheir.misorders') }}" class="effect-3">الفواتير الملغية</a></li>

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

<section class="content">

    <div class="row">

        <div class="col-md-8">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title" style="margin-bottom: 10px; color:red;">الفواتير الملغية</h3>

                    <form action="" method="get">

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

                @if ($misorders->count() > 0)

                            <div class="box-body table-responsive">

                                <table class="table table-bordered table-striped ">
                                    <thead class="sorting">
                                        <tr>
                                            <th class="sorting">رقم الفاتورة</th>
                                            <th class="sorting">اسم العميل</th>
                                            <th>التكلفة</th>
                                            <th>تم اضافته</th>
                                            <th>الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($misorders as $misorder)
                                            <tr data-entry-id="{{ $misorder->id }}">
                                                <td>{{ $misorder->order_id }}</td>
                                                <td>{{$misorder->client->name}} </td>
                                                <td>{{ number_format($misorder->total_price, 2) }}</td>
                                                <td>{{ $misorder->created_at->toFormattedDateString() }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm order-products"
                                                            data-url="{{ route('cacheir.orders.misproducts', $misorder->id) }}"
                                                            data-method="get"
                                                    >
                                                        <i class="fa fa-list"></i>
                                                        عرض
                                                    </button>
                       

                                                </td>

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table><!-- end of table -->
                                {{ $misorders->appends(request()->query())->links() }}


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
