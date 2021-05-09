
@extends('layouts.admin')

@section('content')
﻿ <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}"> الخدمات </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل خدمة
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل خدمة </h4>
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
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                           
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.products.update',$product ->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الخدمة </h4>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم الخدمة </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="name" value="{{ $product->name }}">
                                                            <span class="text-danger"> </span>
                                                            @error('name')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        {!! Form::label('category_id', 'الاقسام', ['class' => 'control-label']) !!}
                                                        {!! Form::select('category_id', $categories, $product->category_id , ['class' => 'form-control selected']) !!}
                                                        <p class="help-block"></p>
                                                        @error('category_id')
                                                                <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                               

                                                <!-- <div class="row">
                                                            <div class="col-md-12 form-group">
                                                            <label for="projectinput1"> السعر </label>
                                                                <select name="price_values" class="form-control" id="price_values">
                                                                    <option value="0" @if ($product -> changed_price == "0") selected @endif >السعر ثابت تابع للمنطقة</option>
                                                                    <option value="1" @if ($product -> changed_price == "1") selected @endif >السعر تابع للفرع</option>
                                                                </select>
                                                                 @error("changed_price")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                  </div> -->

                                                  <!-- <div class="row">
                                                            <div class="col-md-12 form-group">
                                                            <label for="projectinput1"> المخزن </label>
                                                                <select name="countable" class="form-control" id="countable">
                                                                    <option value="0" @if ($product -> countable == "0") selected @endif >لا يوجد مخزن للخدمة</option>
                                                                    <option value="1" @if ($product -> countable == "1") selected @endif > يوجد مخزن للخدمة</option>
                                                                </select>
                                                                 @error("countable")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                  </div> -->


                                  


                                         


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
