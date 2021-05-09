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
                            <li class="nav-item"><a href="{{ route('cacheir') }}" class="effect-3">الرئيسية</a></li>
                           
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
        <div class="container">
             <h1 align="center">طلب رقم <span>{{ $order->id }}</span></h1>
             <br/>
             <div class="row">
               <div class="col-lg-6 margin-tb">
                 <div class="pull-left">
                  <a class="btn btn-success mb-2" id="new-user" data-toggle="modal">اضافة عميل جديد</a>
                 </div>
                </div>  
                <div class="col-lg-6 margin-tb">
                 <div class="pull-right">
                 @if($order->discount > 0)
                  <a class="btn btn-warning btn-sm disabled" id="new-discount" data-totals_price="{{ $order->total_price }}" data-toggle="modal"><i class="fa fa-pencil"></i> اضافة خصم للفاتورة </a>
                @else
                <a class="btn btn-warning btn-sm" id="new-discount" data-totals_price="{{ $order->total_price }}" data-toggle="modal"><i class="fa fa-pencil"></i> اضافة خصم للفاتورة </a>
                @endif
                 </div>
                </div>
             </div>

        
        <table class="table table-bordered data-table" >
        <thead>
        <tr id="">
        <th width="5%">No</th>
        <!-- <th width="5%">Id</th> -->
        <th width="25%">اسم العميل</th>
        <th width="25%">رقم الموبيل</th>
        <th width="25%">السيارات</th>
        <th width="25%">الاجراءات</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
        </div>

        <!-- Add and Edit customer modal -->
        <div class="modal fade" id="crud-modal" aria-hidden="true" >
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="userCrudModal"></h4>
        </div>
        <div class="modal-body">

        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>

        <form name="userForm" id="userForm" action="{{ route('cacheir.clients.store')}}" method="POST">
        <input style="display:none;" name="client_id" id="client_id" >
        <input style="display:none;" value="{{ $order->id }}" name="order_id" id="order_id" >
        @csrf
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>اسم العميل:</strong>
        <input type="text" name="name" id="name" class="form-control" placeholder="اسم العميل" onchange="validate()" >
        </div>
        <p class="help-block"></p>
        @error("name")
            <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>رقم الموبيل:</strong>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="الموبيل" onchange="validate()">
        </div>
        <p class="help-block"></p>
        @error("phone")
            <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>حفظ</button>
        <a href="" class="btn btn-danger">اغلاق</a>
        </div>
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>

          <!-- Add discount modal -->
        <div class="modal fade" id="discount-modal" aria-hidden="true" >
         <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="discountModal"></h4>
            </div>
          <div class="modal-body">

         <form name="discountForm" id="discountForm" action="{{ route('cacheir.order.discount', $order->id)}}" method="POST">
             <input style="display:none;" name="client_id" id="client_id" >
             @csrf
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                        <strong>رقم الطلب:</strong>
                         <input type="text" disabled value="{{ $order->id }}" name="order_id" id="order_id" class="form-control" >
                       </div>
      
                  </div>
                 <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                        <strong>المبلغ:</strong>
                        <input type="text" disabled value="{{ $order->total_price }}" data-totals_price="{{ $order->total_price }}"  name="price" id="price" class="form-control" >
                     </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                        <strong>الخصم:</strong>
                        <input type="number" step="0.01" min="0" name="discount" id="discount" class="form-control discount" autofocus>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                        <strong>المبلغ بعد الخصم:</strong>
                        <input type="number" step="0.01" min="0" name="totals_price" id="totals_price" class="form-control" >
                     </div>
                  </div>

          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" id="btn-discount" name="btn-discount" class="btn btn-warning">اضافة الخصم</button>
              <a href="" class="btn btn-danger">اغلاق</a>
          </div>
         </div>
        </form>
      </div>
    </div>
    </div>
    </div>


          <!-- Add car modal -->
        <div class="modal fade" id="car-modal" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="carCrudModal"></h4>
            </div>
            <div class="modal-body">
            <form name="userForm" action="{{ route('cacheir.clients.storecar')}}" method="POST">
                <input type="hidden" name="carclient_id" id="carclient_id" >
                <input type="hidden" value="{{ $order->id }}" name="order_id" id="order_id" >
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('car_id', 'نوع السيارة', ['class' => 'control-label']) !!}
                            {!! Form::select('car_id', $cars, old('car_id'), ['class' => 'form-control select2']) !!}
                            <p class="help-block"></p>
                            @error("car_id")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>رقم السيارة:</strong>
                            <input type="text" name="carnumber" id="carnumber" class="form-control" placeholder="رقم السيارة"  >
                        </div>
                        <p class="help-block"></p>
                            @error("carnumber")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('carcolor_id', 'لون السيارة', ['class' => 'control-label']) !!}
                            {!! Form::select('carcolor_id', $carcolors, old('carcolor_id'), ['class' => 'form-control select2']) !!}
                            <p class="help-block"></p>
                            @error("carcolor_id")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
                

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" >حفظ</button>
                        <a href="" class="btn btn-danger">اغلاق</a>
                    </div>
                </div>
            </form>
            </div>
            </div>
            </div>
            </div>




       
       
        <!-- confirm modal -->
        <div class="modal fade" id="confirm-modal" aria-hidden="true" >
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="confirmModal"></h4>
        </div>
        <div class="modal-body">

        <form name="confirmForm" id="confirmForm" action="{{ route('cacheir.order.clients.storeconfirm')}}" method="POST">
        <input style="display:none;" name="confirmclient_id" id="confirmclient_id" >
        <input style="display:none;" name="order_id" id="order_id" value="{{$order->id}}">
        @csrf
        <div class="row" id="orderproduct">
       

        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        
         <script type="text/javascript">

        $(document).ready(function () {
        var id = document.getElementById("order_id").value;
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:'',
            type: "GET",
        },
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        // {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'phone', name: 'phone'},
        {data: 'cars', name: 'cars', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        });

        /* When click New customer button */
        $('#new-user').click(function () {
        document.getElementById("userForm").reset();
        $('#btn-save').val("create-user");
        $('#user').trigger("reset");
        $('#userCrudModal').html("اضافة عميل جديد");
        $('#btn-save').prop('disabled',false);
        $('#crud-modal').modal('show');
        });

        $('#new-discount').click(function () {
        document.getElementById("discountForm").reset();
        $('#discountModal').html("اضافة خصم للفاتورة");
        $('#btn-discount').prop('disabled',false);
        $('#btn-discount').attr('disabled',true);
        $('#discount-modal').modal('show');
        document.getElementById("totals_price").value = $(this).data('totals_price');
        document.getElementById("discount").value = 0;
        $('#totals_price').attr('disabled',true);
        });

      
        
        $('body').on('click', '#new_car', function () {
            table.ajax.reload();
        var client_id = $(this).data('client_id');
        $('#carCrudModal').html("اضافة سيارة");
        $('#btn-save').prop('disabled',false);
        $('#car-modal').modal('show');
        $('#carclient_id').val(client_id);
        
        });

            /* confirm order */
        $('body').on('click', '#confirm-order', function () {
            
            table.ajax.reload();

                var client_id = $(this).data('id');
                var client_name = $(this).data('name');
                var client_phone = $(this).data('phone');
                $.get('clients/'+client_id+'/confirm', function (data) {
                $('#confirmModal').html("تأكيد دفع الفاتورة");
                $('#confirmclient_id').val(client_id);
                $('#confirmclientname').val(client_name);
                $('#confirmclientphone').val(client_phone);

                $('#btn-save').prop('disabled',false);
                $('#orderproduct').html(data);
                $('#confirm-modal').modal('show');
               
                })
            });


        /* Edit customer */
        // $('body').on('click', '#edit-user', function () {
            //     var client_id = $(this).data('id');
            //     $.get(client_id+'/edit', function (data) {
            //     $('#userCrudModal').html("تعديل العميل");
            //     $('#btn-update').val("تحديث");
            //     $('#btn-save').prop('disabled',false);
            //     $('#crud-modal').modal('show');
            //     $('#client_id').val(data.id);
            //     $('#name').val(data.name);
            //     $('#phone').val(data.phone);

            //     })
            // });
    
        /* Delete customer */
        //$('body').on('click', '#delete-user', function () {
            //     var client_id = $(this).data("id");
            //     var token = $("meta[name='csrf-token']").attr("content");
            //     var result = confirm("هل انت متاكد من الحذف !");

            //     if(result){
            //         $.ajax({
            //         type: "DELETE",
            //         url: client_id+"/delete",
            //         data: {
            //         "id": client_id,
            //         "_token": token,
            //         },
            //         success: function (data) {
            //         table.ajax.reload();
            //         },
            //         error: function (data) {
            //         console.log('Error:', data);
            //         }
            //         });
            //     }
        
            // });

      

       
       
      

                /* Delete client_car */
        $('body').on('click', '#delete-client_car', function () {
                var client_car_id = $(this).data("client_car");
                var token = $("meta[name='csrf-token']").attr("content");
                var result = confirm("هل انت متاكد من الحذف !");

                if(result){
                    $.ajax({
                    type: "DELETE",
                    url: "clients/"+client_car_id+"/delete_client_car",
                    data: {
                    "id": client_car_id,
                    "_token": token,
                    },
                    success: function (data) {
                    table.ajax.reload();
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
                    });
                }
        
            });

        });
        </script>
        <script>
          $('body').on('keyup change', '.discount', function() {
            var discount = Number(document.getElementById("discount").value); 
            var price = Number(document.getElementById("price").value); 
            $('#totals_price').attr('disabled',false);
            if (discount > price) {
                this.value = price;
                document.getElementById("totals_price").value = (0).toFixed(2);
            }else{
                document.getElementById("totals_price").value = (price - discount).toFixed(2);
                $('#totals_price').attr('disabled',true);
            }
            if(discount > 0){
                $('#btn-discount').prop('disabled',false);
            }
            else{
                $('#btn-discount').prop('disabled',true);

            }


        });//end of product add_price change
 
        </script>


@endsection
