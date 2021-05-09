
@extends('layouts.admin')

@section('content')

<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-4 ">
                    <h3 class="content-header-title"> فواتير لديها خصم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"> <a href="{{ route('admin.orders') }}">الفواتير</a>
                                </li>
                                <li class="breadcrumb-item active"> الفواتير
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
                                    <h4 class="card-title">جميع الفواتير </h4>
                                    <form action="{{ route('admin.orders.discount')}}" method="get">

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
                                            class="table table-bordered table-striped ">
                                            <thead>
                                            <tr>
                                                <th> الرقم</th>
                                                <th> الفني</th>
                                                <th> المبلغ</th>
                                                <th> الخصم</th>
                                                <th> تم اضافته</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @isset($orders)
                                           @foreach($orders as $index=>$order)
                                                    <tr>
                                                        <td>{{ $order->id }} </td>
                                                        <td>{{$order->technical->name ?? 'لا يوجد'}} </td> 
                                                        <td>{{ number_format($order->total_price, 2) }} </td>
                                                        <td>{{ number_format($order->discount, 2) }} </td>
                                                        <td>{{$order->created_at}} </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">

                                                                   <button class="confirm-discount btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1" data-id="{{$order->id}}" data-price="{{$order->total_price}}" data-discount="{{$order->discount}}">
                                                                <span class="glyphicon glyphicon-edit"></span> عرض الخصم</button>

                                                                <form action="{{ route('admin.orders.discount.delete', $order->id) }}" method="post" style="display: inline-block">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('delete') }}
                                                                    <button type="submit" class="btn btn-xs btn-danger delete"><i class="fa fa-trash"></i> الغاء الخصم </button>
                                                                </form> 
                                                                

                                                            </div>
                                                        </td>
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

              <!-- Add discount modal -->
              <div class="modal fade" id="discount-modal" aria-hidden="true" >
         <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="discountModal"></h4>
            </div>
          <div class="modal-body">

         <form name="discountForm" id="discountForm" action="{{ route('admin.orders.discountconfirm') }}" method="POST">
             <input style="display:none;" name="order_id" class="order_id" id="" >
             @csrf
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                        <strong>رقم الطلب:</strong>
                         <input type="text" disabled value="" name="order_id" id="order_id" class="form-control" >
                       </div>
      
                  </div>
                 <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                        <strong>المبلغ:</strong>
                        <input type="text" disabled value="" data-totals_price=""  name="price" id="price" class="form-control" >
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
                        <input type="number" step="0.01" min="0" name="total_price" id="total_price" class="form-control" >
                     </div>
                  </div>

          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" id="btn-discount" name="btn-discount" class="btn btn-warning">تأكيد الخصم</button>
              <a href="" class="btn btn-danger">اغلاق</a>
          </div>
         </div>
        </form>
      </div>
    </div>
    </div>
    </div>

    <script>
    $(document).ready(function () {
    
        $('.confirm-discount').click(function () {
            var price = $(this).data('price');
            var discount = $(this).data('discount');
            $('.order_id').val($(this).data('id'));
            $('#discountModal').html("عرض الخصم");
            $('#order_id').val($(this).data('id'));
            $('#price').val($(this).data('price'));
            $('#discount').val($(this).data('discount'));
            document.getElementById("total_price").value = price - discount;
            $('#total_price').attr('disabled',true);
            $('#btn-discount').prop('disabled',false);
            jQuery.noConflict();
            $('#discount-modal').modal('show');
         
            });

            $('body').on('keyup change', '.discount', function() {
            var discount = Number(document.getElementById("discount").value); 
            var price = Number(document.getElementById("price").value); 
            $('#total_price').attr('disabled',false);
            if (discount > price) {
                this.value = price;
                document.getElementById("total_price").value = (0).toFixed(2);
            }else{
                document.getElementById("total_price").value = (price - discount).toFixed(2);
                $('#total_price').attr('disabled',true);
            }
            if(discount > 0){
                $('#btn-discount').prop('disabled',false);
            }
            else{
                $('#btn-discount').prop('disabled',true);

            }


        });//end of product add_price change

        });
        

    </script>

@endsection
