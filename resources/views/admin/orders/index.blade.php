
@extends('layouts.admin')

@section('content')

<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-4 ">
                    <h3 class="content-header-title"> الفواتير </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الفواتير
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-left col-md-4 col-12">
                    <a href="{{ route('admin.orders.discount') }}" style="font-size:17px;" class="btn btn-warning" >فواتير لديها خصم</a>
                </div>
                <div class="content-header-left col-md-4 col-12">
                    <a href="{{ route('admin.orders.misorders') }}" style="font-size:17px;" class="btn btn-danger " > الفواتير الملغية </a>
                </div>

            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الفواتير </h4>
                                    <form action="{{ route('admin.orders')}}" method="get">

                                        <div class="row">

                                            <div class="col-md-8">
                                                <input type="text" name="search" class="form-control" placeholder="بحث" value="{{ request()->search }}">
                                            </div>

                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> بحث </button>
                                            </div>

                                        </div><!-- end of row -->

                                    </form><!-- end of form -->

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
                                    <div class="card-body card-dashboard panel-body table-responsive">
                                        <table
                                            class="table table-bordered table-striped {{ count($orders) > 0 ? 'datatable' : '' }} ">
                                            <thead>
                                            <tr>
                                                <th> الرقم</th>
                                                <th>  العميل</th>
                                                <th>  التليفون</th>
                                                <th> الفني</th>
                                                <th> التكلفة</th>
                                                <th> تم اضافته</th>
                                                <!-- <th>الإجراءات</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @isset($orders)
                                           @foreach($orders as $index=>$order)
                                                    <tr>
                                                        <td>{{ $order->id }} </td>
                                                       <td>{{$order->client->name ?? 'لا يوجد'}} </td> 
                                                        <td>{{$order->client->phone ?? 'لا يوجد'}} </td>
                                                        <td>{{$order->technical->name ?? 'لا يوجد'}} </td> 
                                                        <td> {{ number_format($order->total_price, 2) }} </td>
                                                        <td>{{$order->created_at}} </td>
                                                        <!-- <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.orders.edit',$order -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                   <a href="{{route('admin.orders.delete',$order -> id)}}"
                                                                class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                

                                                            </div>
                                                        </td> -->
                                                    </tr>
                                            @endforeach

                                            @endisset
                                                

                                            </tbody>
                                        </table>
                                {{ $orders->appends(request()->query())->links() }}

                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
