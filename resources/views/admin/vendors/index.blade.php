@extends("layouts.admin")

@section('title')
| {{__("admin.vendors")}}

@endsection

@section('content')

 <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route("admin.home")}}">{{__("admin.home")}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__("admin.vendors")}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{__("admin.vendors")}}  </h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th>{{__("admin.name")}}</th>
                                                <th> {{__("admin.phone")}}</th>
                                                <th> {{__("admin.main-category")}}</th>
                                                <th>{{__("admin.active")}}</th>
                                                <th>{{__("admin.logo")}}</th>
                                                <th>{{__("admin.action")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($vendors)
                                            @if($vendors->count() > 0)
                                            @foreach($vendors as $vendor)

                                                    <tr>
                                                        <td>{{$vendor->name}}</td>
                                                        <td>{{$vendor->phone}}</td>
                                                        <td>{{$vendor->mainCategory->name}}</td>
                                                         <td>{{$vendor->getCaseActive()}} </td>
                                                        <td>
                                                           @if(!empty($vendor->logo) || $vendor->logo != null)
                                                             <img src="{{asset($vendor->logo)}}" width="70" height="55" class="thumbnail">
                                                            @else

                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route("admin.vendors.edit",$vendor->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                   {{__("admin.edit")}}
                                                                </a>
                                                                <button type="button"
                                                                        id="button_delete"
                                                                        data-action="{{route("admin.vendors.destroy",$vendor->id)}}"
                                                                        data-name="{{$vendor->name}}"
                                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                        >
                                                                    {{__("admin.delete")}}
                                                                </button>

                                                                <a href="{{route("admin.vendors.change_active",$vendor->id)}}"
                                                                   class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">
                                                                      {{$vendor->active == 1 ? __("admin.deactivate") : __("admin.activation")}}
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                            @endforeach

                                            @endif

                                            @endisset




                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
            <div class="d-flex justify-content-center mt-5">

              {{ $vendors->appends(request()->query())->links() }}

          </div>
    </div>



 <!-- Modal -->
  <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  {{__("admin.delete")}} <span class="name"></span>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                      @csrf()
                      @method("delete")

                      <input type="submit" value="{{__('admin.delete')}}" class="btn btn-danger">
                  </form>


              </div>
          </div>
      </div>
  </div>

@endsection
