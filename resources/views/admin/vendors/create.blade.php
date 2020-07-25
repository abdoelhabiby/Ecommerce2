@extends('layouts.admin')

@section("title")
 | {{__("admin.vendors")}} | {{__("admin.create")}}
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
                                <li class="breadcrumb-item"><a href="{{route('admin.vendors.index')}}"> {{__("admin.vendors")}} </a>
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
                                        {{__("admin.create") . " " . __("admin.vendor"). " " . __("admin.new")}} </h4>
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
                                        <form class="form" action="{{route("admin.vendors.store")}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                            <div class="form-body">

                                               <div class="form-group">
                                                   <label for="logo">{{__("admin.logo")}}</label>
                                                   <input type="file" name="logo" class="form-control">

                                                   @error('logo')
                                                              <span class="text-danger">{{$message}} </span>

                                                   @enderror
                                               </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">{{__("admin.name")}}</label>
                                                            <input type="text"  id="name"
                                                                   class="form-control"
                                                                   value="{{old("name")}}"
                                                                   placeholder="{{__("admin.input") ." " . __("admin.name")}}"
                                                                   name="name">
                                                            @error('name')
                                                              <span class="text-danger">{{$message}} </span>

                                                            @enderror
                                                        </div>
                                                    </div>

                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="category"> {{__("admin.category")}} </label>
                                                             <select class="form-control" id="category" name="category_id">


                                                                @if($main_categories && $main_categories->count() > 0)
                                                                     <option  disabled selected>{{__("admin.choose category")}}</option>

                                                                @foreach($main_categories as $index => $main_category)

                                                                   <option {{old("category_id") == $main_category->id ? "selected" : ''}} value="{{$main_category->id}}">{{$main_category->name}}</option>

                                                                @endforeach

                                                                @else
                                                                <option disabled selected>{{__("admin.please add category")}}</option>
                                                                @endif

                                                             </select>



                                                            @error('category_id')
                                                            <span class="text-danger">{{$message}} </span>

                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">{{__("admin.email")}}</label>
                                                            <input type="email"  id="email"
                                                                   class="form-control"
                                                                   value="{{old("email")}}"
                                                                   placeholder="{{__("admin.input") ." " . __("admin.email")}}"
                                                                   name="email">
                                                            @error('email')
                                                              <span class="text-danger">{{$message}} </span>

                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone"> {{__("admin.phone")}} </label>
                                                            <input type="text"  id="phone"
                                                                   class="form-control"
                                                                   value="{{old("phone")}}"
                                                                   placeholder="{{__("admin.input") ." " . __("admin.phone")}}"
                                                                   name="phone">
                                                            @error('phone')
                                                            <span class="text-danger">{{$message}} </span>

                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">{{__("admin.password")}}</label>
                                                            <input type="password"  id="password"
                                                                   class="form-control"
                                                                   placeholder="{{__("admin.input") ." " . __("admin.password")}}"
                                                                   name="password">
                                                            @error('password')
                                                              <span class="text-danger">{{$message}} </span>

                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password_confirmation"> {{__("admin.password_confirmation")}} </label>
                                                            <input type="password"  id="password_confirmation"
                                                                   class="form-control"
                                                                   placeholder="{{__("admin.input") ." " . __("admin.password_confirmation")}}"
                                                                   name="password_confirmation">
                                                            @error('password_confirmation')
                                                            <span class="text-danger">{{$message}} </span>

                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>





                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p>{{__("admin.active")}}</p>
                                                            <div class="form-check form-check-inline">
                                                              <input class="form-check-input" type="radio" name="active" id="yes"  value="1">
                                                              <label class="form-check-label" for="yes">{{__("admin.enabled")}}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline ml-4">
                                                               <input class="form-check-input" type="radio" name="active" id="no" checked value="0">
                                                                <label class="form-check-label" for="no">{{__("admin.not_enabled")}}</label>
                                                            </div>
                                                         @error('active')
                                                            <br>
                                                            <span class="text-danger">{{$message}} </span>
                                                         @enderror

                                                    </div>
                                                </div>
                                            </div>
<hr>
                                                <div class="row mt-2">

                                                    <div class="col-md-6 d-none">

                                                        <input type="hidden" name="latitude" id="latitude">
                                                        <input type="hidden" name="longitude" id="longitude">
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="pac-input"> العنوان  </label>
                                                            <input type="text" id="pac-input"
                                                                   class="form-control"
                                                                   placeholder="  " name="address">

                                                            @error("address")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div id="map" style="height: 500px;width: 1000px; margin-bottom:20px"></div>


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


@section('scripts')

  <script src="{{asset("plugins")}}/google_map.js"> </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKZAuxH9xTzD2DLY2nKSPKrgRi2_y0ejs&libraries=places&callback=initAutocomplete&language=ar&region=EG
         async defer">
        </script>

@endsection
