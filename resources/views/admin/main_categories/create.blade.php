@extends('layouts.admin')

@section("title")
 | {{__("admin.main-categories")}} | {{__("admin.create")}}
@endsection
@section('content')

 <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("admin.home")}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.main-categories.index')}}"> {{__("admin.main-categories")}} </a>
                                </li>
                                <li class="breadcrumb-item active">{{__("admin.create")}}
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
                                    <h4 class="card-title" id="basic-layout-form">
                                        {{__("admin.create")}} قسم جديد</h4>
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


                                  @if(getLanguagesActive()->count() > 0)

                                   <form class="form" action="{{route("admin.main-categories.store")}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="photo">صوره القسم</label>
                                                        <input type="file" id="photo" name="photo" class="form-controll">
                                                        @error('photo')
                                                              <span class="text-danger">هذا الحقل مطلوب </span>

                                                        @enderror
                                                        <hr>
                                                    </div>
                                                </div>

                                                @foreach(getLanguagesActive() as $index => $language)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">{{__("admin.name") . " " . __("admin.".$language->abbr)}}</label>
                                                            <input type="text"  id="name"
                                                                   class="form-control"
                                                                   value='{{old("category.$index.name")}}'
                                                                   name="category[{{$index}}][name]">
                                                            @error("category.$index.name")
                                                              <span class="text-danger">هذا الحقل مطلوب </span>

                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 d-none">
                                                        <div class="form-group">
                                                            <label for="translation_lang"> {{__("admin.abbr") . " " . __("admin.".$language->abbr)}} </label>
                                                            <input type="text"  id="translation_lang"
                                                                   class="form-control"
                                                                   value='{{$language->abbr}}'
                                                                   name="category[{{$index}}][translation_lang]">
                                                            @error("category.$index.translation_lang")
                                                            <span class="text-danger">هذا الحقل مطلوب </span>

                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p>{{__("admin.active") . " " . __("admin." . $language->abbr)}}</p>
                                                            <div class="form-check form-check-inline">
                                                              <input class="form-check-input" type="radio" name="category[{{$index}}][active]" id="yes" checked value="1">
                                                              <label class="form-check-label" for="yes">{{__("admin.enabled")}}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline ml-4">
                                                               <input class="form-check-input" type="radio" name="category[{{$index}}][active]" id="no" value="0">
                                                                <label class="form-check-label" for="no">{{__("admin.not_enabled")}}</label>
                                                            </div>
                                                         @error("category.$index.active")
                                                            <br>
                                                            <span class="text-danger">{{$message}} </span>
                                                         @enderror

                                                    </div>





                                                </div>

                                                                                                    <hr>


                                                @endforeach







                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{__("admin.back")}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{__("admin.save")}}
                                                </button>
                                            </div>
                                        </form>

                                  @else
                                     <p class="text-center"> please add language</p>

                                  @endif

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
