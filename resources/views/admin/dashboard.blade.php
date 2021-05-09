@extends('layouts.admin')

@section('content')


 
    <div class="app-content content">
    
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div id="crypto-stats-3" class="row">
                    <div class="col-xl-4 col-12">
                      <div class="card crypto-card-3 pull-up">
                           <div class="card-content">
                             <div class="card-body pb-0">
                             <a href="{{ route('admin.stores') }}">   
                                   <div class="row">
                                        <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>

                                        </div>
                                        <div class="col-5 pl-2">
                                            <h2>الفروع</h2>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{ $stores->count()}}</h4>
                                        </div>
                                    </div>
                             </a>
                                </div>        
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="btc-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                  <a href="{{ route('admin.technicals') }}">   
                                    <div class="row">
                                        <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>

                                        </div>
                                        <div class="col-5 pl-2">
                                       <h4>العمالة</h4>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{ $technicals->count()}}</h4>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="eth-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <a href="{{ route('admin.clients') }}">   
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h4>العملاء</h4>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{ $clients->count()}}</h4>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="xrp-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>


            </div>

            <div class="content-body">
                <div id="crypto-stats-3" class="row">
                    <div class="col-xl-4 col-12">
                      <div class="card crypto-card-3 pull-up">
                           <div class="card-content">
                             <div class="card-body pb-0">
                             <a href="{{ route('admin.products') }}">   
                                 <div class="row">
                                        <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>

                                        </div>
                                        <div class="col-5 pl-2">
                                            <h2>الخدمات</h2>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{ $products->count()}}</h4>
                                        </div>
                                    </div>
                             </a>

                                </div>        
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="btc-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                  <a href="{{ route('admin.suppliers') }}">   
                                    <div class="row">
                                        <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>

                                        </div>
                                        <div class="col-5 pl-2">
                                       <h4>الموردين</h4>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{ $suppliers->count()}}</h4>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="eth-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <a href="{{ route('admin.countries') }}">   
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h4>المناطق</h4>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{ $countries->count()}}</h4>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="xrp-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>
    </div>


  

 
 <!-- Include Required Prerequisites -->
 <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

         
                <!-- Active Orders -->
          
                <!-- Active Orders -->
       


    <script type="text/javascript">

        $('.date1').datepicker({  
           
format: 'YYYY-MM-DD',
            

        });  

    </script>  
    <script type="text/javascript">

        $('.date2').datepicker({  

      
            
        });  
        

    </script>  





    
@endsection
