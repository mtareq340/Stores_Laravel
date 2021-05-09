
@extends('layouts.admin')

@section('content')

<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> طلبات الفروع </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.stores')}}">الفروع</a>
                                </li>
                                <li class="breadcrumb-item active"> طلبات الفروع
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
         
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع طلبات الفروع </h4>
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
                                            class="table table-bordered table-striped {{ count($storeorders) > 0 ? 'datatable' : '' }} ">
                                            <thead>
                                            <tr>
                                                <th> الرقم</th>
                                                <th> اسم الفرع</th>
                                                <th>السعر الكلي</th>
                                                <th>السعر المدفوع</th>
                                                <th>السعر المتبقي</th>
                                                <th>الدفع</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @isset($storeorders)
                                           @foreach($storeorders as $index=>$storeorder)
                                                    <tr>
                                                        <td>{{ $index + 1 }} </td>
                                                        <td>{{$storeorder->store['name'] ?? ''}} </td>
                                                        <td>{{$storeorder->total_price}} </td>
                                                        <td>{{$storeorder->paid_price }} </td>
                                                        <td>{{$storeorder->remaining_price }} </td>
                                                        @if( $storeorder->remaining_price < 1)
                                                            <td align="center" style="text-align:center; font-size:150%; font-weight:bold; color:green;">&#10004;</td> 
                                                            @else
                                                            <td align="center" style="text-align:center; font-size:150%; font-weight:bold; color:red;">&#x1F5F6;</td>
                                                            @endif          
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                            

                                                                <form action="{{ route('admin.storeorders.delete',$storeorder -> id) }}" method="post" style="display: inline-block">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('delete') }}
                                                                    <button type="submit" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 delete"><i class="fa fa-trash"></i> الغاء </button>
                                                                </form> 

                                                            </div>
                                                        </td>
                                                    </tr>
                                            @endforeach

                                            @endisset
                                                


                                            </tbody>
                                        </table>
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
