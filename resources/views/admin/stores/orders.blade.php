
@extends('layouts.admin')



    <style>
        .form-group {
            height: 80px
        }
        
        label {
            color: black!important;
        }
        
        .form {
            direction: rtl;
        }
        .pSize{
            height:15px;
        }

    </style>
@section('content')

<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> طلبات الفرع </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">الرئيسية</a>
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

                              

   
                       
                                                <table id="orderTable" class="table table-striped table-bordered table-hover {{ count($storeorders) > 0 ? 'datatable' : '' }} " >
                                                    <thead>
                                                        <tr>
                                                 
                                                            <th>رقم الطلب</th>
                                                            <th>اسم الفرع</th>
                                                            <th>السعر الكلي</th>
                                                            <th>السعر المدفوع</th>
                                                            <th>السعر المتبقي</th>
                                                            <th>الدفع</th>
                                                            <th>الاجراءات</th>
                                                            
                                                        </tr>
                                                        {{ csrf_field() }}
                                                    </thead>
                                                    <tbody>
                                                        @foreach($storeorders as $index=>$storeorder)
                                                    <tr class="item{{$storeorder->id}}">
                                                            <td> {{ $storeorder->id}}</td>
                                                            <td>{{$storeorder->store['name']}} </td>
                                                            <td>{{$storeorder->total_price}} </td>
                                                            <td>{{$storeorder->paid_price }} </td>
                                                            <td>{{$storeorder->remaining_price }} </td>
                                                            @if( $storeorder->remaining_price < 1)
                                                            <td align="center" style="text-align:center; font-size:150%; font-weight:bold; color:green;">&#10004;</td> 
                                                            @else
                                                            <td align="center" style="text-align:center; font-size:150%; font-weight:bold; color:red;">&#x1F5F6;</td>
                                                            @endif                                                     
                                                            <td>
                                                              
                                                                <button class="edit-modal btn btn-xs btn-success" data-id="{{$storeorder->id}}"  data-name="{{$storeorder->store['name']}}" data-total_price="{{$storeorder->total_price}}" data-paid_price="{{$storeorder->paid_price}}" data-remaining_price="{{$storeorder->remaining_price}}">
                                                                <span class="glyphicon glyphicon-edit"></span> اضافة مبلغ</button>

                                                                <form action="{{ route('admin.storeorders.delete',$storeorder -> id) }}" method="post" style="display: inline-block">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('delete') }}
                                                                    <button type="submit" class="btn btn-xs btn-danger delete"><i class="fa fa-trash"></i> الغاء الطلب </button>
                                                                </form> 
                                            

                                                                
                                                            </td>
                                                                
                                                            </tr>
                                                        @endforeach
                                            
                                                    </tbody>
                                                </table>
                               





                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




      <!-- Modal form to edit a form -->
      <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">رقم الطلب</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_edit" disabled>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">اسم المورد:</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" id="name_edit" autofocus>
                                <p class="errorName text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">السعر الكلي:</label>
                            <div class="col-sm-10">
                                <input type="number" disabled class="form-control" id="total_price_edit" autofocus>
                                <p class="errorEmail text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">السعر المدفوع:</label>
                            <div class="col-sm-10">
                                <input type="number" disabled class="form-control" id="paid_price_edit" autofocus>
                                <p class="errorPhone text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2 " for="title">اضافة مبلغ:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control add_price" min="0"  id="add_price_edit" autofocus>
                                <p class="errorPhone text-center alert alert-danger hidden"></p>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2 " for="title">السعر المتبقي:</label>
                            <div class="col-sm-10">
                                <input type="number" disabled class="form-control remaining_price" id="remaining_price_edit" autofocus>
                                <p class="errorPhone text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> تحديث الطلب
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> اغلاق
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(window).load(function(){
            $('#orderTable').removeAttr('style');
        })
    </script>
   <script>
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('تحديث الطلب');
            $('#id_edit').val($(this).data('id'));
            $('#name_edit').val($(this).data('name'));
            $('#total_price_edit').val($(this).data('total_price'));
            $('#paid_price_edit').val($(this).data('paid_price'));
            $('#remaining_price_edit').val($(this).data('remaining_price'));
            id = $('#id_edit').val();
            jQuery.noConflict();
            $('#editModal').modal('show');
        });
    </script>
<script>
$('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.storeorders.update')}}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'add_price': $('#add_price_edit').val(),
                    'remaining_price': $('#remaining_price_edit').val(),
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');
                      location.reload();
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                }
                }
            });
        });

        </script>


 <script>  
    $('body').on('keyup change', '.add_price', function() {
    var add_price = Number(document.getElementById("add_price_edit").value); 
    // alert(add_price);
    var remaining_price = Number(document.getElementById("remaining_price_edit").value); 
    if (add_price > remaining_price) {
        this.value = remaining_price;
    } 

    });//end of product add_price change
  
 </script>

@endsection
