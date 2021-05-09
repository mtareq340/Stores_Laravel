<?php

namespace App\Http\Controllers\Cacheir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\TechnicalExports;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;
use App\Shift;
use App\Order;
use PdfReport;
use ExcelReport;
use PDF;
class ReportController extends Controller
{

    function reports()
    {
    //     $technicals= DB::select('SELECT
    //      technicals.id,technicals.name,
    //     COUNT(*) as orderscount,
    //     SUM(orders.total_price)as total_price
    //     from technicals
    //     JOIN orders 
    //     ON technicals.id = orders.technical_id
    //     GROUP BY technicals.id;
    //    ');
        $shifts = Shift::where('store_id',Auth::user()->id)->paginate(10);

        $shift = Shift::latest()->where('cacheir_id', Auth::user()->id)->first();
     
        return view('cacheir.reports', compact('shifts','shift'));
        
    }
    function shiftsReport(Request $request)
    {
        $from_date = \Carbon\Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = \Carbon\Carbon::parse($request->to_date)->format('Y-m-d');
        $title = 'تقرير عن مبيعات الفرع'; // Report title
        $meta = [ // For displaying filters description on header
            'مبيعات من ' => $from_date . ' الي ' . $to_date,
        ];
        
        $columns = [ // Set Column to be displayed
            'بداية اليوم' => 'start_date',
            'نهاية اليوم' => 'end_date',
            'محصلة اليوم' => 'total_price',
        ];

     
            $shifts = Shift::select('id','start_date','end_date','total_price')
            ->whereBetween('created_at', [$from_date, $to_date])
            ->where('store_id', Auth::user()->store_id)
            ->paginate(10);
            $sum_total = shift::where('store_id', Auth::user()->store_id)->whereBetween('created_at', [$from_date, $to_date])
            ->sum('total_price');
            
            $shift = Shift::latest()->where('cacheir_id', Auth::user()->id)->first();
        
        if($request->action == 'pdf')
        {
            $queryBuilder = Shift::select('id','start_date','end_date','total_price')
            ->whereBetween('created_at', [$from_date, $to_date])
            ->where('store_id', Auth::user()->store_id);

        return PdfReport::of($title, $meta, $queryBuilder, $columns)
        ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
            'displayAs' => function($result) {
                return $result->created_at->format('d M Y');                        },
            'class' => 'left'
        ])
        ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            'محصلة اليوم' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
        ])
        ->limit(20) // Limit record to be showed
        ->stream();
        }
        elseif($request->action == 'excel')
        {
            $queryBuilder = Shift::select('id','start_date','end_date','total_price')
            ->whereBetween('created_at', [$from_date, $to_date])
            ->where('store_id', Auth::user()->store_id);

            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Registered At', [
                'class' => 'right bolder italic-red'
            ]) 
            ->setCss([
                '.bolder' => 'font-weight: 800;',
                '.italic-red' => 'color: red;font-style: italic;'
            ])
            ->setOrientation('landscape')
            ->simple()
            ->download('تقرير للفرع');
        }
        else{}

        return view('cacheir.reports', compact('shifts','shift','sum_total'));

        

    }


    public function products(Request $request)
    {
        $fromDate = \Carbon\Carbon::parse($request->product_from_date)->format('Y-m-d');
        $toDate =  \Carbon\Carbon::parse($request->product_to_date)->format('Y-m-d');

        $title = 'تقرير عن مبيعات الفرع'; // Report title

        $meta = [ // For displaying filters description on header
            'مبيعات من ' => $fromDate . ' الي ' . $toDate,
        ];

        $queryBuilder = DB::table('orders')
        ->join('product_order','orders.id', '=', 'product_order.order_id')
        ->join('products', 'product_order.product_id', '=', 'products.id')
        ->select('products.id','products.name',DB::raw("SUM(product_order.quantity) as quantity"))
        ->where('products.countable', 1)
        ->whereBetween('orders.created_at', [$fromDate, $toDate])
        ->groupBy('products.id')
        ->orderBy('quantity','asc');

        // dd($queryBuilder);

        $columns = [ // Set Column to be displayed
            'اسم النتج' => 'name',
            'عدد المبيعات' => 'quantity',
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        // return PdfReport::of($title, $meta, $queryBuilder, $columns)
        // ->simple()
        // ->download('filename.pdf');

        if($request->action == "pdf")
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                        'displayAs' => function($result) {
                            return $result->created_at->format('d M Y');                        },
                        'class' => 'left'
                    ])
                    ->setOrientation('landscape')
                    ->limit(20) // Limit record to be showed
                    ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
         else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Registered At', [
                'class' => 'right bolder italic-red'
            ]) 
            ->setCss([
                '.bolder' => 'font-weight: 800;',
                '.italic-red' => 'color: red;font-style: italic;'
            ])
            ->setOrientation('landscape')
            ->simple()
            ->download('تقرير مبيعات');
         }           
                    
    }

}