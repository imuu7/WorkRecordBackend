<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="/assets/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css" />
    <link href="/assets/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="/assets/pages/css/themes/light.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    @yield('css')
  </head>
  <body class="fixed-header dashboard menu-pin">
  @if(!Auth::guest())
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
      <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
      <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
      <!-- BEGIN SIDEBAR MENU HEADER-->
      <div class="sidebar-header">
        <b>向邑數位行銷有限公司</b>
      </div>
      <!-- END SIDEBAR MENU HEADER-->
      <!-- START SIDEBAR MENU -->
      <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            @include('layouts.menu')
        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
          <div class="brand inline">
            <b>向邑數位行銷有限公司</b>
          </div>
        </div>
        <div class="d-flex align-items-center">
          <!-- START User Info-->
          <div class="pull-left p-r-10 fs-14 font-heading d-lg-inline-block d-none m-l-20">
            <span class="semi-bold">{{ Auth::user()->name }}</span>
          </div>
          <div class="dropdown pull-right d-lg-inline-block d-none">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline">
              <img src="/assets/img/profiles/avatar.jpg" alt="" data-src="/assets/img/profiles/avatar.jpg" data-src-retina="/assets/img/profiles/avatar_small2x.jpg" width="32" height="32">
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
              <a href="#" class="clearfix bg-master-lighter dropdown-item">
                <a href="{{ url('/logout') }}" class="pull-left"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    @lang('auth.sign_out')
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                        style="display: none;">
                    @csrf
                </form>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
            </div>
          </div>
          <!-- END User Info-->
        </div>
      </div>
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content">
            @yield('content')
        </div>
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    @else
    <nav class="page-sidebar" data-pages="sidebar">
        <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
        <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
        <!-- BEGIN SIDEBAR MENU HEADER-->
        <div class="sidebar-header">
            <b>向邑數位行銷有限公司</b>
        </div>
        <!-- END SIDEBAR MENU HEADER-->
        <!-- START SIDEBAR MENU -->
        <div class="sidebar-menu">
            <!-- BEGIN SIDEBAR MENU ITEMS-->
            <ul class="menu-items">
                <li>
                    <a href="{{ url('/login') }}">
                        <span class="title">登入</span>
                    </a>
                    <span class="icon-thumbnail"><i class="detailed fa fa-edit"></i></span>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- END SIDEBAR MENU -->
    </nav>

    <div class="page-container ">
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
          <div class="brand inline">
            <b>向邑數位行銷有限公司</b>
          </div>
        </div>
      </div>
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        @yield('content')
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    @endif
    <!-- END OVERLAY -->
    <!-- BEGIN VENDOR JS -->
    <script src="/assets/plugins/feather-icons/feather.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/classie/classie.js"></script>
    <script src="/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/lib/d3.v3.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/nv.d3.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/src/utils.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/src/tooltip.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/src/interactiveLayer.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/src/models/axis.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/src/models/line.js" type="text/javascript"></script>
    <script src="/assets/plugins/nvd3/src/models/lineWithFocusChart.js" type="text/javascript"></script>
    <script src="/assets/plugins/rickshaw/rickshaw.min.js"></script>
    <script src="/assets/plugins/mapplic/js/hammer.min.js"></script>
    <script src="/assets/plugins/mapplic/js/jquery.mousewheel.js"></script>
    <script src="/assets/plugins/mapplic/js/mapplic.js"></script>
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <!-- END VENDOR JS -->
    @stack('scripts')
  </body>
</html>
