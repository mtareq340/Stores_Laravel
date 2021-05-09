<?php

namespace App\Http\Controllers\Cacheir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Redirect,Response;
use App\Client;
use App\Order;
use App\Car;
use App\Carcolor;
use App\Client_Car;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class ClientController extends Controller
{

    public function index(Request $request,$order_id)
    {
            $cars = Car::all()->pluck('name', 'id')->prepend('-- من فضلك اختار نوع السيارة --', '');
            $carcolors = Carcolor::all()->pluck('name', 'id')->prepend('-- من فضلك اختار لون السيارة --', '');
            $order = Order::FindOrFail($order_id);

            if ($request->ajax()) {

            $data = Client::latest()->with('cars')->get();
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cars', function($row){
                $cars = '
                <button style="pull-right;" class="btn btn-xs btn-success" id="new_car" data-client_id='.$row->id.' data-toggle="modal"><i class="fa fa-plus"></i></button>
                <ul>';
                foreach($row->cars as $car)
                {
                    $carcolor = Carcolor::find($car->pivot->carcolor_id);
                    $cars .=' <li>'.$car->name. ' - ' .$carcolor->name. ' - ['. $car->pivot->carnumber. ']
                    </li>
                    <button style="pull-right; " class="btn btn-xs btn-danger" id="delete-client_car" data-client_car='.$car->pivot->id.' data-toggle="modal"><i class="fa fa-minus"></i></button>
                    ';  
                }
                $cars .= '</ul>';
                return $cars;
                })
            ->addColumn('action', function($row){
            $action = '
            <a class="btn btn-success btn-sm" id="confirm-order" data-toggle="modal" data-id='.$row->id.' data-name='.$row->name.' data-phone='.$row->phone.'>تأكيد الفاتورة </a>
             <meta name="csrf-token" content="{{ csrf_token() }}">
            ';
        //     <a href="'. route('cacheir.order.clients', 1) .'" class="btn btn-success btn-sm">
        //                  تأكيد الفاتورة</a>
        //     <a class="btn btn-success btn-sm" id="edit-user" data-toggle="modal" data-id='.$row->id.'>تعديل </a>
        //     <meta name="csrf-token" content="{{ csrf_token() }}">
        //     <a id="delete-user" data-id='.$row->id.' class="btn btn-danger btn-sm delete">حذف</a>
            return $action;

            })
          
            ->rawColumns(['cars','action'])
            ->make(true);
          
            }

            return view('cacheir.orderclients',compact('cars','carcolors','order'));
    }

    public function discount(Request $request, $order_id)
    {
        $order = Order::FindOrFail($order_id);
        $order->discount = $request->discount;
        $order->save();
        $msg = 'تم ارسال الخصم بنجاح.';
        return redirect()->route('cacheir.order.clients',$order_id)->with('success',$msg);
    }

    public function confirm($order_id,$client_id)
    {
           $order = Order::FindOrFail($order_id);
           $orderProducts = $order->products()->get();
           $client = Client::FindOrFail($client_id);
           $cars = $client->cars()->get();
           if($order->discount_confirmed){
            $all_total_price = $order->total_price - $order->discount;
            $discount = $order->discount;
           }else{
            $all_total_price = $order->total_price;
            $discount = 0;
           }
        // dd($cars);
           $output="";
           $output.=' <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="form-group">
               <strong>رقم الطلب:</strong>
               <input type="text" disabled value="'.$order->id.'" class="form-control" >
           </div>
           </div>
           <div class="col-xs-6 col-sm-6 col-md-6">
           <div class="form-group">
               <strong>اسم العميل:</strong>
               <input type="text" disabled value="'.$client->name.'"name="name" id="name" class="form-control" >
           </div>
           </div>
           <div class="col-xs-6 col-sm-6 col-md-6">
           <div class="form-group">
               <strong>رقم الموبايل:</strong>
               <input type="text" disabled value="'.$client->phone.'"name="phone" id="phone" class="form-control" >
           </div>
           </div>
        <div class="row">
           <div class="col-xs-8 col-sm-8 col-md-8">
           <div class="form-group">
           <select name="confirmcar_id" class="form-group" required>
           <option value="" style="color:red;"> --- من فضلك اختار السيارة الخاصة بالعميل --- </option>';
           foreach ($cars as $car){
                  $carcolor = Carcolor::find($car->pivot->carcolor_id);
                   $output.='<option value="'.$car->pivot->id.'">'.$car->name. ' - ' .$carcolor->name.' - ['. $car->pivot->carnumber. ']</option>';
           }
           $output.='</select> 
           
           </div>
        </div>
       
      </div>
       <div class="col-xs-4 col-sm-4 col-md-4">
           <div class="form-group">
               <strong>المبلغ:</strong>
               <input type="text" disabled value="'.$order->total_price.'" class="form-control" >
           </div>
           </div>
           <div class="col-xs-4 col-sm-4 col-md-4">
           <div class="form-group">
               <strong>الخصم:</strong>
               <input type="text" disabled value="'.$discount.'" class="form-control" >
           </div>
           </div>
           <div class="col-xs-4 col-sm-4 col-md-4">
           <div class="form-group">
               <strong>المبلغ بعد الخصم:</strong>
               <input type="text" disabled value="'.$all_total_price.'" class="form-control" >
           </div>
           </div>
           <div style="margin-top:35px;" class="col-xs-12 col-sm-12 col-md-12 text-center">
           <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" >تأكيد الدفع</button>
           <a href="" class="btn btn-danger">اغلاق</a>
       </div>';

           return Response($output);
    }

    public function storeConfirm(Request $request)
    {
        $client = Client::FindOrFail($request->confirmclient_id);
        $order = Order::FindOrFail($request->order_id);
        $order->client_id = $request->confirmclient_id;
        $order->client_car_id = $request->confirmcar_id;
        $order->confirmed = 1;
        $order->price_after_discount = $order->total_price - $order->discount;
        $order->save();
        return view('cacheir.print',compact('order','client'));


    }

     public function storeCar(Request $request)
    {
            $r=$request->validate([
            'car_id' => 'required',
            'carnumber' => 'required|regex:/^[a-zA-Z0-9]/',
            'carcolor_id' => 'required',
            ]);
  
            if($r){
                $client = Client::FindOrFail($request->carclient_id);
                $client->cars()->attach([$request->car_id => ['carnumber' => $request->carnumber, 'carcolor_id' => $request->carcolor_id]]);
                $msg = 'تم اضافة السيارة بنجاح.';
                return redirect()->route('cacheir.order.clients',$request->order_id)->with('success',$msg);
            }
            else{
                $msg = 'لم تتم الاضافة.';
                return redirect()->route('cacheir.order.clients',$request->order_id)->with('errors',$msg);

            }
           
    }

    public function store(Request $request)
    {

            $r=$request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            ]);

            $uId = $request->client_id;
            Client::updateOrCreate(['id' => $uId],['name' => $request->name, 'phone' => $request->phone, 'store_id' => Auth::user()->store_id]);
            if(empty($request->client_id))
            $msg = 'تم اضافة العميل بنجاح.';
            else
            $msg = 'تم التعديل بنجاح';
            return redirect()->route('cacheir.order.clients',$request->order_id)->with('success',$msg);
    }


    public function show($id)
    {
            $where = array('id' => $id);
            $user = Client::where($where)->first();
            return Response::json($user);
            //return view('users.show',compact('user'));
    }

 

    public function edit($id)
     {
            $where = array('id' => $id);
            $user = Client::where($where)->first();
             return Response::json($user);
     }


     public function delete_client_car($order_id, $client_car_id)
     {
        //  $client_car = Client_Car::FindOrFail($client_car_id);
         $user = Client_Car::where('id',$client_car_id)->delete();
        //  $client_car->delete();
         return Response::json($user);
     }
     public function destroy($id)
     {
            $user = Client::where('id',$id)->delete();
            return Response::json($user);
            //return redirect()->route('users.index');
     }



    
}
