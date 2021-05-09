<style>
    .menu-title{
        font-size:20px;
    }
    .menu-item{
        font-size:18px;
    }
</style>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <!-- <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li> -->
          
            @can('عرض_الاقسام')
            <li class="nav-item "><a href="{{ route('admin.categories') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
               
            </li>
            @endcan
            @can('عرض_الخدمات')
            <li class="nav-item"><a href="{{ route('admin.products') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الخدمات </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
              
            </li>
            @endcan
            @can('عرض_المناطق')
            <li class="nav-item "><a href="{{ route('admin.countries') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> المناطق </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
               
            </li>
            @endcan

            @can('عرض_الفروع')
            <li class="nav-item">
                <a href="{{ route('admin.stores') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الفروع </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
         
            </li>
            @endcan

            @can('عرض_المخزن')
            <li class="nav-item">
                <a href="{{ route('admin.mainproducts') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المخزن الرئيسي</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            </li>
            @endcan
            
            @can('عرض_الموردين')
            <li class="nav-item">
                <a href="{{ route('admin.suppliers') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الموردين</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            </li>
            @endcan

            @can('عرض_طلبات_الموردين')
            <li class="nav-item">
                <a href="{{ route('admin.supplierorders') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">طلبات الموردين</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            </li>
            @endcan
         
            @can('عرض_العمالة')
            <li class="nav-item">
                <a href="{{ route('admin.technicals') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">العمالة </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            </li>
            @endcan
            @can('عرض_مديرين_الفروع')

            <li class="nav-item">
                <a href="{{ route('admin.cacheirs') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">مديرين الفروع(الكاشير)</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            </li>
            @endcan
            
            @can('عرض_الفواتير')
            <li class="nav-item"><a href="{{ route('admin.orders') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الفواتير </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
             
            </li>
            @endcan
            @can('عرض_العملاء')
            <li class="nav-item"><a href="{{ route('admin.clients') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">العملاء </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            
            </li>
            @endcan

         

            @can('عرض_الوان_السيارات')
            <li class="nav-item"><a href="{{ route('admin.carcolors') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الوان السيارات </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            
            </li>
            @endcan
            @can('عرض_الوان_السيارات')
            <li class="nav-item"><a href="{{ route('admin.carsorts') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">انواع السيارات </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
            
            </li>
            @endcan

            @can('عرض_المستخدمين')
            <li class="nav-item"><a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">ادارة الأدمن </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content" style="">   
                    <li class=""><a class="menu-item" href="{{ route('admin.permissions') }}"> - الصلاحيات </a>
                    </li>
                    <li class=""><a class="menu-item" href="{{ route('admin.roles') }}"> - المهام</a>
                    </li>
                    <li class=""><a class="menu-item" href="{{ route('admin.admins') }}"> - المستخدمين </a>
                    </li>
   
                </ul>
            </li>
            @endcan

            <li class="nav-item"><a  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> تسجيل الخروج </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </li>

          




         


         
      
        </ul>
    </div>
</div>
