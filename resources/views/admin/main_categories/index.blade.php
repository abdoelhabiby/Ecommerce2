@extends("layouts.admin")
@section("title")
| {{__("admin.main-categories")}}

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
                                <li class="breadcrumb-item active">{{__("admin.main-categories")}}
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
                                    <h4 class="card-title"> {{__("admin.main-categories")}}  </h4>
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
                                            class="table display nowrap table-striped  table-bordered scroll-horizontal">
                                            <thead>
                                            <tr>
                                                <th>{{__("admin.name")}}</th>
                                                <th> {{__("admin.abbr")}}</th>
                                                <th>{{__("admin.active")}}</th>
                                                <th>{{__("admin.photo")}}</th>
                                                <th>{{__("admin.action")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($main_categories)
                                            @if($main_categories->count() > 0)
                                            @foreach($main_categories as $main_category)

                                                    <tr>
                                                        <td>{{$main_category->name}}</td>
                                                        <td>{{$main_category->translation_lang}}</td>
                                                        <td>
                                                            {{$main_category->getCaseActive()}}
                                                        </td>
                                                        <td>
                                                            @if(!empty($main_category->photo) || $main_category->photo != null)
                                                             <img src="{{asset($main_category->photo)}}" width="70" height="55" class="thumbnail">
                                                            @else

                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route("admin.main-categories.edit",$main_category->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                   {{__("admin.edit")}}
                                                                </a>
                                                                <button type="button"
                                                                        id="button_delete"
                                                                        data-action="{{route("admin.main-categories.destroy",$main_category->id)}}"
                                                                        data-name="{{$main_category->name}}"
                                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                        >
                                                                    {{__("admin.delete")}}
                                                                </button>

                                                                <a href="{{route("admin.main-categories.change_active",$main_category->id)}}"
                                                                   class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">
                                                                      {{$main_category->active == 1 ? __("admin.deactivate") : __("admin.activation")}}
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

              {{ $main_categories->appends(request()->query())->links() }}

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
                  {{__("admin.delete") . " " . __("admin.category")}} <span class="name"></span>
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
