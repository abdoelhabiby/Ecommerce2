 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> A7LA Ecommerce</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{(request()->segment(1) == "dashboard" && request()->segment(2) == null)  ? "active" : ''}}">
        <a class="nav-link" href="{{route("admin.home")}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>{{__("admin.home")}}</span></a>

      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <!-- Nav Item - Languages Collapse Menu -->
      <li class="nav-item  {{request()->segment(2) == "languages" ? "active" : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#language" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>{{__("admin.languages")}}</span>
          <span class="badge badge badge-info badge-pill ">{{App\Models\Admin\Language::count()}}</span>


        </a>
        <div id="language" class="collapse {{request()->segment(2) == "languages" ? "show" : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route("admin.languages.index")}}" style="background:#ecedf7">{{__("admin.show_all")}}</a>
            <a class="collapse-item" href="{{route("admin.languages.create")}}">{{__("admin.create")}}</a>
          </div>
        </div>
      </li>

         <!-- Divider -->
      <hr class="sidebar-divider my-0">

{{-- ========================================================================================= --}}
      <!-- Nav Item - main-categories Collapse Menu -->
      <li class="nav-item  {{request()->segment(2) == "main-categories" ? "active" : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#main-categories" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>{{__("admin.main-categories")}}</span>
          <span class="badge badge badge-info badge-pill ">{{App\Models\Admin\MainCategory::where("translation_lang",languageLocal())->count()}}</span>


        </a>
        <div id="main-categories" class="collapse {{request()->segment(2) == "main-categories" ? "show" : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route("admin.main-categories.index")}}" style="background:#ecedf7">{{__("admin.show_all")}}</a>
            <a class="collapse-item" href="{{route("admin.main-categories.create")}}">{{__("admin.create")}}</a>
          </div>
        </div>
      </li>

         <!-- Divider -->
      <hr class="sidebar-divider my-0">






      {{-- ========================================================================================= --}}
      <!-- Nav Item - vendors Collapse Menu -->
      <li class="nav-item  {{request()->segment(2) == "vendors" ? "active" : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vendors" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>{{__("admin.vendors")}}</span>
          <span class="badge badge badge-info badge-pill ">{{App\Models\Admin\Vendor::count()}}</span>


        </a>
        <div id="vendors" class="collapse {{request()->segment(2) == "vendors" ? "show" : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route("admin.vendors.index")}}" style="background:#ecedf7">{{__("admin.show_all")}}</a>
            <a class="collapse-item" href="{{route("admin.vendors.create")}}">{{__("admin.create")}}</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">







      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>



    </ul>
