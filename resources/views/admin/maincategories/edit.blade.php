@extends('layouts.admin')
@section('content')
<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('languages.all')}}"> المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل -{{$category->name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم </h4>
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
                                    <div class="card-body">
                                        <form class="form" action="{{route('Maincategories.update',$category->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                                <input name="id" type="hidden" value="{{$category->id}}">

                                              <div class="form-group">
                                                    <label for="projectinput1" class="file center-block"> صورة القسم</label>
                                                    <img src="{{$category->photo}}" alt="no" height="100px" width="100px">

                                              </div>

                                              <div class="form-group">
                                                    <label for="projectinput1" class="file center-block"> صورة القسم</label>
                                                    <input type="file" value="" id="file"
                                                            class="form-control"
                                                            placeholder=""
                                                            name="photo">
                                                    @error('photo')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                              </div>

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اسم القسم - {{__('message.'.$category->translation_lang)}}   </label>
                                                                    <input type="text" value="{{$category->name}}" id="name"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اختصار اللغة - {{__('message.'.$category->translation_lang)}}</label>
                                                                    <input type="text" value="{{$category->abbr}}" id="name"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="category[0][abbr]">
                                                                    @error("category.0.abbr")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" name="category[0][active]"
                                                                        id="switcheryColor4" value="1"
                                                                        class="switchery" data-color="success"
                                                                       @if($category->active == 1) checked @endif/>
                                                                    <label for="switcheryColor4"
                                                                        class="card-title ml-1"> الحالة - {{__('message.'.$category->translation_lang)}}</label>
                                                                    @error("category.0.active")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
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
                                                    <i class="la la-check-square-o"></i> تعديل
                                                </button>
                                            </div>
                                        </form>





                                        <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                            @isset($category->categories)
                                                @foreach($category->categories as $index => $lang)
                                                    <li class="nav-item @if($index==0) active @endif">
                                                        <a class="nav-link " id="tabIcon11-tab11" data-toggle="tab" aria-controls="tabIcon11"
                                                        href="#tabIcon11{{$index}}" aria-expanded="{{$index == 0 ? 'true':'false'}}"> {{$lang->translation_lang}}</a>
                                                    </li>
                                                @endforeach
                                            @endisset

                                        </ul>
                                    <div class="tab-content px-1 pt-1">

                                        @isset($category->categories)
                                        @foreach($category->categories as $index => $lang)
                                            <div role="tabpanel" class="tab-pane  @if($index == 0) active @endif" id="tabIcon11{{$index}}" aria-expanded="{{$index == 0 ? 'true':'false'}}"
                                            aria-labelledby="baseIcon-tab11">
                                            <form class="form" action="{{route('Maincategories.update',$lang->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                                <input name="id" type="hidden" value="{{$lang->id}}">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اسم القسم - {{__('message.'.$lang->translation_lang)}}   </label>
                                                                    <input type="text" value="{{$lang->name}}" id="name"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="category[{{$index}}][name]">
                                                                    @error("category.$index.name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اختصار اللغة - {{__('message.'.$lang->translation_lang)}}</label>
                                                                    <input type="text" value="{{$lang->abbr}}" id="name"
                                                                        class="form-control"
                                                                        placeholder=""
                                                                        name="category[{{$index}}][abbr]">
                                                                    @error("category.$index.abbr")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" name="category[{{$index}}][active]"
                                                                        id="switcheryColor4" value="1"
                                                                        class="switchery" data-color="success"
                                                                       @if($lang->active == 1) checked @endif/>
                                                                    <label for="switcheryColor4"
                                                                        class="card-title ml-1"> الحالة - {{__('message.'.$lang->translation_lang)}}</label>
                                                                    @error("category.$index.active")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
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
                                                    <i class="la la-check-square-o"></i> تعديل
                                                </button>
                                            </div>
                                        </form>
                                        </div>
                                        @endforeach
                                        @endisset
                                    </div>




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
