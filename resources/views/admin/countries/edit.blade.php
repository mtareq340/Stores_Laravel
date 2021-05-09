
@extends('layouts.admin')

@section('content')
﻿ <div class="app-content content">
        <div class="content-wrapper">
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
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل المنطقة </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                           
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.countries.update',$country ->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المنطقة </h4>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنطقة </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="name" value="{{ $country->name }}">
                                                            <span class="text-danger"> </span>
                                                            @error('name')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                        
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

                    @isset($countryProducts)

                    @foreach($countryProducts as $product)
                    <tr>
                    <td>{{ $product->name }}</td>
                    <td><input type="number" name="products[{{$product->id}}][price]" data-price="${price}"
                    class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->price }}"></td>
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
