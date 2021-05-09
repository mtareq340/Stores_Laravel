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
                            <li class="nav-item "><a href="{{ route('cacheir.productsprice.index')}}" class="effect-3">اسعار الخدمات</a></li>
                            <li class="nav-item active"><a href="{{ route('cacheir.reports')}}" class="effect-3">التقارير</a></li>

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
  cursor: not-allowed;
}
</style>

<!-- <form name="form_main">
  <div>
    <span id="hour">00</span>:<span id="minute">00</span>:<span id="second">00</span>:<span id="millisecond">000</span>
  </div>

  <br />

  <button type="button" name="start">start</button>
  <button type="button" name="pause">pause</button>
  <button type="button" name="reset">reset</button>
</form> -->

<div class="row" style="margin-top:40px; margin-bottom:40px;">
    <div class="col-md-1">
    </div>
    <div class="col-md-1">
    <button type="submit" id="start_btn" data-start="{{$shift->start}}" data-start_date="{{Carbon\Carbon::today()->toDateString()}}"class="btn btn-success btn start-btn"><i class="fa fa-success"></i>ابدء اليوم</button>
    </div>
    <div class="col-md-1">
    <button type="submit" class="btn btn-danger  btn end-btn " id="end_btn"><i class="fa fa-success"></i>انهاء اليوم</button>    
    </div>
    <div class="col-md-1">
    <button type="submit" class="btn btn-primary  btn reset-btn " id="reset_btn"><i class="fa fa-success"></i>اعادة</button>
    </div>
</div>
<center> <h3 class="date"></h3></center>
<form id="Employeeform">
  <div class="container">
    <table id="tblEmployee" class="paginated table table-bordered">
      <thead class="bg-primary text-white">
        <tr>
          <th>الرقم</th>
          <th>اسم العامل</th>
          <th>عدد الطلبات</th>
          <th>اجمالي السعر</th>
        </tr>
      </thead>
      <tbody id="tabldata"></tbody>
    </table>

  </div>
</form>


<script>
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

        var start = $('#start_btn').data('start');
        if(start == 1){
            $('#start_btn').attr('disabled',true);
            $('#end_btn').attr('disabled',false);
            $('#reset_btn').attr('disabled',true);
        } else{
            $('#start_btn').attr('disabled',false);
            $('#end_btn').attr('disabled',true);
            $('#reset_btn').attr('disabled',true);
        }
     


            $(".start-btn").click(function () {
                
                jQuery.ajax({
                   
                    type: 'POST',
                    url: "{{ route('cacheir.shifts.create') }}",
                    success: function () {
                        $('#end_btn').attr('disabled',false);
                        $('#start_btn').attr('disabled',true);
                    },
                    error: function () {
                    }
                });
            });

            $(".end-btn").click(function () {
        var start_date = $('#start_btn').data('start_date');
                
                jQuery.ajax({
                   
                    type: 'POST',
                    url: "{{ route('cacheir.shifts.end') }}",
                    success: function (data) {
                        var grand_total = 0;
                        var employeeTable = $('#tblEmployee tbody');
                        employeeTable.empty();
                        $('#tblEmployee').show();
                        var len = data.length;
                        var id = 0;
                            for (var i = 0; i< len; i++) {
                            id++;
                            var name  = data[i].name;
                            var orderscount  = data[i].orderscount;
                            var total_price  = data[i].total_price;
                            // var discount  = data[i].total_discount;
                            grand_total += parseFloat(total_price);
                        
                            employeeTable.append("<tr><td>"+ id +"</td><td>"+ name +"</td><td>"+ orderscount +"</td><td>"+ total_price +"</td></tr>");
                         }
                            employeeTable.append("<tr style='background-color:#C0C0C0'><td> محصلة اليوم </td><td></td><td></td><td style='color:red;'>"+ grand_total +"</td></tr>");
                             $('.date').html('محصلة اليوم بتاريخ ' + start_date);
                    
                            $('#start_btn').attr('disabled',true);
                            $('#end_btn').attr('disabled',true);
                            $('#reset_btn').attr('disabled',false);

                    },
                    error: function () {
                    }
                });
            });

            
            $(".reset-btn").click(function () {
                var employeeTable = $('#tblEmployee tbody');
                        employeeTable.empty();
                        $('.date').html('');

                $('#end_btn').attr('disabled',true);
                $('#start_btn').attr('disabled',false);
                $('#reset_btn').attr('disabled',true);
            });

        });

        </script>


<!-- <div align="center">
    <a href="{{ route('cacheir.reports.excel') }}" class="btn btn-success">Export to Excel</a>
   </div> -->
   <br />

 <div class="">

        <section class="content-header">

            <!-- <h1> التقارير <small style="font-size:bold;"></small></h1> -->

        
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">


                    <form action="" method="get">

                       <div class="row">

                    
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                <div class="container box">
        <h3 align="center">تقارير عن مبيعات الفرع</h3><br/>

        <form action="{{ route('cacheir.reports.shifts') }}" method="get">

        <div class="panel panel-default">
            <div class="panel-heading">
            <div class="row">
            <div class="col-md-2">
            <button  type="submit" name="action" value="search" id="filter" class="btn btn-info">ابحث</button>
            </div>
            <div class="col-md-5">
            <button  type="submit" name="action" value="pdf"  id="filter" class="btn btn-primary">تصدير ملف PDF</button>
            <button  type="submit" name="action" value="excel"  id="filter" class="btn btn-success">تصدير ملف اكسيل</button>

            </div>
        
            <div class="col-md-5">
                <div class="input-group input-daterange">
                <div class="input-group-addon">من</div>  
                <input type="text" name="from_date" id="from_date" readonly class="form-control date1" />
                <div class="input-group-addon">إلي</div>  
                <input type="text"  name="to_date" id="to_date" readonly class="form-control date2" />
                </div>
            </div>
            
            </div>

            </div>
            </div>
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table shiftstable table-striped table-bordered">
            <thead>
                <tr>
                <th width="10%">الرقم</th>
                <th width="30%">بداية اليوم</th>
                <th width="22%">نهاية اليوم</th>
                <th width="20%">محصلةاليوم</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($shifts as $index=>$shift)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $shift->start_date }}</td>
                    <td>{{ $shift->end_date }}</td>
                    <td>{{ $shift->total_price }}</td>
                </tr>

            @endforeach
            <tr style="background-color:black;"><td style="color:white;">المحصلة</td><td></td><td></td><td style="color:white;">{{ $sum_total ?? ''}}</td></tr>
            
            </tbody>
         
            </table>
            {{ $shifts->appends(request()->query())->links() }}


            {{ csrf_field() }}
            </div>
            </div>
            </form>

     </div>
    </div>


        <script type="text/javascript">

            $('.date1').datepicker({  
            
            format: 'YYYY-MM-DD',

            });  

        </script>  
        <script type="text/javascript">

            $('.date2').datepicker({  

            });  
        </script>  

   


                </div><!-- end of box body -->



            </div><!-- end of box -->

        </section><!-- end of content -->

        </div><!-- end of content wrapper -->




        <!-- //////////////////// -->




        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">


                    <form action="" method="get">

                       <div class="row">

                    
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    <div class="container box">
                    <h3 align="center">تقارير عن حجم المنتجات في البيع</h3><br/>

                    <form action="{{ route('cacheir.reports.products') }}" method="get">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <div class="row">
                            <div class="col-md-2">
                            <!-- <button  type="submit" name="action" value="pdf"  id="filter" class="btn btn-primary ">ابحث</button> -->
                            </div>
                            <div class="col-md-5">
                            <button  type="submit" name="action" value="pdf"  id="filter" class="btn btn-primary ">تصدير ملف PDF</button>
                            <button  type="submit" name="action" value="excel"  id="filter" class="btn btn-success">تصدير ملف اكسيل</button>

                            </div>
                        
                            <div class="col-md-5">
                                <div class="input-group input-daterange">
                                <div class="input-group-addon">من</div>  
                                <input type="text" name="product_from_date" id="product_from_date" readonly class="form-control productdate1" />
                                <div class="input-group-addon">إلي</div>  
                                <input type="text"  name="product_to_date" id="product_to_date" readonly class="form-control productdate2" />
                                </div>
                            </div>
                            
                            </div>

                            </div>
                            </div>
                        
                        </form>

                    </div>
                    </div>


        <script type="text/javascript">

            $('.date1').datepicker({  
            
            format: 'YYYY-MM-DD',

            });  

        </script>  
        <script type="text/javascript">

            $('.date2').datepicker({  

            });  
        </script>  

        <script type="text/javascript">

            $('.productdate1').datepicker({  

            format: 'YYYY-MM-DD',

            });  

            </script>  
            <script type="text/javascript">

            $('.productdate2').datepicker({  

            });  
        </script>  

   


                </div><!-- end of box body -->



            </div><!-- end of box -->

        </section><!-- end of content -->




@endsection
