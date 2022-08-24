<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="{{url('admin/company')}}">
              <span class=""> <img src="{{ URL::asset('resources/uploads/logo/01.png')}}" alt="GirValley" height="50" width="150" class="p-auto"> </span>
              {{-- <h2 class="brand-text">{{ config('app.name') }}</h2> --}}
            </a>
          </li>
          <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
              <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
      </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content" style="padding-top: 15px">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item @if(Request::is('admin/company') ||Request::is('admin/company/*') ) active @endif">
            <a class="d-flex align-items-center" href="{{url('admin/company')}}">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span class="menu-title text-truncate" data-i18n="Dashboard">
                 {{trans('messages.Company')}}
              </span>
            </a>
          </li> 
          <li class=" nav-item @if(Request::is('admin/employee') ||Request::is('admin/employee/*') ) active @endif">
            <a class="d-flex align-items-center" href="{{url('admin/employee')}}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span class="menu-title text-truncate" data-i18n="Dashboard">
                 {{trans('messages.Employee')}}
              </span>
            </a>
          </li>  
  </div>
</div>
