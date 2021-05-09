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

                            <li class="nav-item active"><a href="{{ route('cacheir.stock')}}" class="effect-3">المخزن</a></li>
                            <li class="nav-item "><a href="{{ route('cacheir.productsprice.index')}}" class="effect-3">اسعار الخدمات</a></li>
                            <li class="nav-item"><a href="{{ route('cacheir.reports')}}" class="effect-3">التقارير</a></li>

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

<div class="app-content content">
        <div class="">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المخزن </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('cacheir') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> المخزن
                                </li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
            <p>
        <!-- <a href="{{ route('admin.mainproducts.create') }}" class="btn btn-success">اضافة جديدة</a> -->
        <h4 class="card-title">جميع الخدمات </h4>

             </p>

            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                             
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard panel-body table-responsive">
                                        <table
                                            class="table table-bordered table-striped  ">
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
