
@extends('layouts.admin')

@section('content')
<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.stores')}}"> الفروع </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة طلب
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة طلب جديد </h4>
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
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.storeorders.store' )}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                         

                                            <section class="">

                                                <div class="row">

                                                    <div class="col-md-4">

                                                        <div class="box box-primary">

                                                            <div class="box-header">

                                                                <h3 class="box-title" style="margin-bottom: 10px">المنتجات</h3>

                                                            </div><!-- end of box header -->

                                                            <div class="box-body">

                                                                    
                                                                    <div class="panel-group">

                                                                        <div class="panel panel-info">


                                                                                <div class="panel-body">

                                                                                    @if ($mainproducts->count() > 0)

                                                                                        <table class="table table-hover">
                                                                                            <tr>
                                                                                                <th>المنتج</th>
                                                                                                <th>اضافة</th>
                                                                                            </tr>

                                                                                            @foreach ($mainproducts as $mainproduct)
                                                                                                <tr>
                                                                                                    <td>{{ $mainproduct->name }}</td>
                                                                                               
                                                                                                    <td>
                                                                                                        <a href=""
                                                                                                        id="product-{{ $mainproduct->id }}"
                                                                                                        data-name="{{ $mainproduct->name }}"
                                                                                                        data-id="{{ $mainproduct->id }}"
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

                                                    <div class="col-md-8">

                                                        <div class="box box-primary">

                                                            <div class="box-header">

                                                                <h3 class="box-title">المطلوب</h3>

                                                            </div><!-- end of box header -->

                                                            <div class="box-body">


                                                                    <table class="table table-hover" id="print-area">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>المنتج</th>
                                                                            <th>الكمية</th>
                                                                            <th>سعر الوحدة</th>
                                                                            <th>تكلفةالمنتج</th>
                                                                            <th>حذف</th>
                                                                            <!-- <th>السعر</th> -->
                                                                        </tr>
                                                                        </thead>

                                                                        <tbody class="order-list">


                                                                        </tbody>

                                                                    </table><!-- end of table -->

                                                                    @error("mainproducts")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror

                                                                    <h4>المجموع : <span class="total-price">0</span></h4>

                                                                    <!-- <button class="btn btn-primary  btn-block disabled "  id="add-order-form-btn" ><i class="fa fa-plus"></i>اضافة فاتورة</button> -->



                                                            </div><!-- end of box body -->

                                                        </div><!-- end of box -->

                                                

                                                    </div><!-- end of col -->

                                                </div><!-- end of row -->

                                            </section><!-- end of content -->


                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  الطلب </h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">اسم الفرع : </label>
                                                                <input type="text" disabled value="{{ $store->name }}" id="name"
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    name="total_price">
                                                                    @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>

                                                        <input type="text"  value="{{ $store->id }}" id="name"
                                                                    class="form-control" style="display:none;"
                                                                    placeholder=""
                                                                    name="store_id">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">السعر الكلي</label>
                                                                <input type="number" step="0.01" min="1" value="0.00" id="total_price"
                                                                    class="form-control total_price"
                                                                    placeholder=""
                                                                    name="total_price">
                                                                    @error("total_price")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">السعر المدفوع</label>
                                                                <input type="number" step="0.01" value="0.00" min="0" id="paid_price"
                                                                    class="form-control paid_price"
                                                                    placeholder=""
                                                                    name="paid_price">
                                                                    @error("paid_price")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> السعر المتبقي </label>
                                                                <input type="number"  value="0.00" min="1" readonly="" id="remaining_price"
                                                                    class="form-control remaining_price"
                                                                    placeholder=""
                                                                    name="remaining_price">
                                                                    @error("remaining_price")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>



                                                    </div> 

                                            </div>




                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
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
