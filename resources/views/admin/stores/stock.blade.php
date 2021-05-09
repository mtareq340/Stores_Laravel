
@extends('layouts.admin')

@section('content')

<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> مخزن فرع <span>{{ $store->name }}</span> </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.stores')}}">الفروع</a>
                                </li>
                                <li class="breadcrumb-item active"> المخزن
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
                                    <h4 class="card-title">جميع الخدمات </h4>
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
                                            class="table table-bordered table-striped {{ count($mainproducts) > 0 ? 'datatable' : '' }} ">
                                            <thead>
                                            <tr>
                                                <th> الرقم</th>
                                                <th>القسم</th>
                                                <th> الخدمة</th>
                                                <th> الكمية الموجودة</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @isset($mainproducts)
                                           @foreach($mainproducts as $index=>$mainproduct)
                                                    <tr>
                                                        <td>{{ $index + 1 }} </td>
                                                        <td>{{ $mainproduct->category['name'] }} </td>
                                                        <td>{{ $mainproduct->name }} </td>
                                                        <td>{{ $mainproduct->pivot->quantity }} </td>
                                                   
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
