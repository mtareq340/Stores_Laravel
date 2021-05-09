
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
                           
                            <!-- <li class="nav-item"><a href="{{ route('cacheir.misorders') }}" class="effect-3">الفواتير الملغية</a></li> -->

                            <li class="nav-item "><a href="{{ route('cacheir.stock')}}" class="effect-3">المخزن</a></li>

                            <li class="nav-item active"><a href="{{ route('cacheir.productsprice.index')}}" class="effect-3">اسعار الخدمات</a></li>

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
﻿ <div class="app-content content">
        <div class="">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.countries')}}"> المناطق </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل المنطقة
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                              
                           
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('cacheir.productsprice.update')}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                            <div class="form-body">

                                             

                                        
                                                <div class="row">

                                                        <div class="col-md-10">

                                                            <div class="box box-primary">

                                                                <div class="box-header">

                                                                    <h3 class="box-title">اسعار الخدمات</h3>

                                                                </div><!-- end of box header -->

                                                                <div class="box-body">


                                                                        <table class="table table-hover" id="print-area">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>الخدمة</th>
                                                                                <th>سعر الخدمة</th>
                                                                            </tr>
                                                                            </thead>

                                                                            <tbody class="order-list">

                                                                            @isset($products)

                                                                            @foreach($products as $product)
                                                                            <tr>
                                                                            <td>{{ $product->name }}</td>
                                                                            <td><input type="number" step="0.01" name="products[{{$product->id}}][price]" data-price="${price}"
                                                                            class="form-control input-sm product-quantity" min="0" value="{{ $product->pivot->price }}"></td>
                                                                            </tr>
                                                                            @endforeach
                                                                            
                                                                            @endisset
                                                                            </tbody>

                                                                        </table><!-- end of table -->

                                                                        <!-- <h4>المجموع : <span class="total-price">0</span></h4> -->

                                                                        <!-- <button class="btn btn-primary  btn-block disabled "  id="add-order-form-btn" ><i class="fa fa-plus"></i>اضافة فاتورة</button> -->

                                                                        @error("products")
                                                                            <span class="text-danger">{{$message}}</span>
                                                                            @enderror

                                                                </div><!-- end of box body -->

                                                            </div><!-- end of box -->



                                                        </div><!-- end of col -->

                                                        </div><!-- end of row -->


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
