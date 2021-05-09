
@extends('layouts.admin')

@section('content')
<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> العملاء </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة عميل
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة عميل جديد </h4>
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
                                        <form class="form" action="{{ route('admin.clients.store' )}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                         

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  العميل </h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> اسم العميل </label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    name="name">
                                                                    @error("client.name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>

                                                     
                                                        <!-- <div class="col-md-12 ">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> البريد الالكتروني </label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    value=""
                                                                    name="email">
                                                                    @error("client.email")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div> -->

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> رقم الموبيل </label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    name="phone">
                                                                    @error("client.name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                      


                                                            <div class="row">
                                                                <div class="col-xs-12 form-group">
                                                                    {!! Form::label('store', 'المتجر', ['class' => 'control-label']) !!}
                                                                    {!! Form::select('store_id', $stores, old('store_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                                                                    <p class="help-block"></p>
                                                                    @if($errors->has('store'))
                                                                        <p class="help-block">
                                                                            {{ $errors->first('store') }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-xs-12 form-group">
                                                                    {!! Form::label('technical', 'العامل', ['class' => 'control-label']) !!}
                                                                    {!! Form::select('technical_id', $technicals, old('technical_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                                                                    <p class="help-block"></p>
                                                                    @if($errors->has('technical'))
                                                                        <p class="help-block">
                                                                            {{ $errors->first('technical') }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                    </div> 

                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
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
