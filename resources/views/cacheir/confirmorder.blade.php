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
                           
                            <li class="nav-item"><a href="{{ route('cacheir.misorders') }}" class="effect-3">الفواتير الملغية</a></li>

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
<style>

p{
 font-size: 1.12rem;
}

#radio-btn,
#check-box {
 margin-right: 0.5rem;
 min-height: 1.2rem;
 min-width: 1.2rem;
}

label {
 display: flex;
 align-items: center;
 font-size: 1.125rem;
 margin-bottom: 0.5rem;
}



</style>

@section('content')

<div class="container">
       <header>
           <h1 id='title'>Web Developer's Survey Form</h1>
           <p id='description'>
               Thank you for taking the time to do this survey
           </p>
       </header>

       <form id='survey-form'>
           <div class='form-input'>
               <label id='name-label'>Name</label>
               <input type='text' id='name' placeholder='Enter your name' class='form-input-size' required />
           </div>
           <div class='form-input'>
               <label id='email-label'>Email</label>
               <input type='email' id='email' placeholder='Enter your email' class='form-input-size' required />
           </div>
           <div class='form-input'>
               <label id='number-label'>Age
                   <span>(optional)</span>
               </label>
               <input type='number' id='number' placeholder='25' min='0' max='80' class='form-input-size' />
           </div>

           <div class='form-input'>
               <p>Which option best describes your current role?</p>
               <select id='dropdown' class='form-input-size' required>
                   <option disabled selected value>Select current role</option>
                   <option value='Student'>Student</option>
                   <option value='Senior Software Engineer'>Senior Software Engineer</option>
                   <option value='Junior Software Engineer'>Junior Software Engineer</option>
                   <option value='Full Stack Web Developer'>Full Stack Web Developer</option>
                   <option value='Front-end Web Developer'>Front-end Web Developer</option>
                   <option value='Back-end Web Developer'>Back-end Web Developer</option>
                   <option value='Prefer not to say'>Prefer not to answer</option>
                   <option value='Other'>Other</option>
               </select>
           </div>

           <div class='form-input'>
               <p>Would you recommend Web Development career to a friend or family?</p>
               <input type='radio' name='answer' id='radio-btn' value='Definately' checked />Definately    </br>
               <input type='radio' name='answer' id='radio-btn' value='Maybe' />Maybe </br>
               <input type='radio' name='answer' id='radio-btn' value='Not sure' />Not sure </br>
           </div>

           <div class='form-input'>
               <p>What are your favorite Technology Languages and Frameworks?
                   <span>(Check all that apply)</span>
               </p>
               <label><input type='checkbox' id='check-box' value='Ruby on Rails'>Ruby on Rails</label>
               <label><input type='checkbox' id='check-box' value='JavaScript'>JavaScript</label>
               <label><input type='checkbox' id='check-box' value='React'>React</label>
               <label><input type='checkbox' id='check-box' value='Python'>Python</label>
               <label><input type='checkbox' id='check-box' value='Java'>Java</label>
               <label><input type='checkbox' id='check-box' value='PHP'>PHP</label>
               <label><input type='checkbox' id='check-box' value='Angular'>Angular</label>
               <label><input type='checkbox' id='check-box' value='Vue'>Vue</label>
               <label><input type='checkbox' id='check-box' value='Swift'>Swift</label>
               <label><input type='checkbox' id='check-box' value='HTML'>HTML</label>
               <label><input type='checkbox' id='check-box' value='CSS'>CSS</label>
               <label><input type='checkbox' id='check-box' value='Other'>Other</label>
           </div>

           <div class='form-input'>
               <p>Any comments or suggestions to a new Web Developers?</p>
               <textarea type='text' placeholder='Enter your comment here...'></textarea>
           </div>

           <div class='form-input'>
               <button type='submit' id='submit'>Submit</button>
           </div>
       </form>
   </div>
       



@endsection
