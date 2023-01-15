<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accounts</title>

    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!--Fonr Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!--DATA TABLES-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <!--custom css-->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!--SummerNote-->
    <link href="{{asset('assets/summernote/summernote-lite.css')}}" rel="stylesheet">
    <script src="{{asset('assets/summernote/summernote-lite.js')}}"></script>

    <!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!--Sweet Alert 2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    
    <nav class="navbar fixed-top navbar-expand bg-white border-bottom shadow-sm">
        <div class="container">
            <a class="btn d-md-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <svg viewBox="0 0 448 512" width="20px" height="20px"><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"></svg>
            </a>
    
            <a href="" class="me-auto navbar-brand">
                <img src="{{asset('assets/images/logo-bottom.png')}}" alt="logo" height="35">
            </a>

            <ul class="navbar-nav">         
                <li class="nav-item">
                    <a class="nav-link text-primary2" aria-current="page" href="/pricing"> Pricing</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/my/dashboard">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</a></li>
                    @can('admin-dashboard')
                        <li><a class="dropdown-item" href="/admin/dashboard">Admin Dashboard</a></li>
                    @endcan
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
        
    @if(request()->is('my/*'))
    <div class="offcanvas offcanvas-start show" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body">
            <a href="/my/dashboard" class="nav-link @if(Request::is('my/dashboard')) nav-link-active @endif">
              <i class="fa fa-gauge"></i>
              <span>Dashboard</span>
            </a>
    
            <a href="/my/subscription" class="nav-link @if(Request::is('my/subscription')) nav-link-active @endif">
                <i class="fa fa-plus"></i>
                <span>Subscription</span>
            </a>
    
            <a href="/my/my-activity" class="nav-link @if(Request::is('my/my-activity')) nav-link-active @endif">
                <i class="fa fa-chart-line"></i>
                <span>My Activity</span>
            </a>
    
            <a href="/my/refer-friend" class="nav-link @if(Request::is('my/refer-friend')) nav-link-active @endif">
                <i class="fa fa-share-nodes"></i>
                <span>Refer a Friend</span>
            </a>
            
            @can('user-dashboard')
                <a href="/my/user-management" class="nav-link @if(Request::is('my/user-management')) nav-link-active @endif">
                <i class="fa fa-users"></i>
                <span>Users</span>
                </a>
            @endcan
    
            <a href="/my/profile" class="nav-link @if(Request::is('my/profile')) nav-link-active @endif">
                <i class="fa fa-user"></i>
                <span>Profile</span>
            </a>
        </div>
    </div>
    @endif

    @if(request()->is('admin/*'))
    <div class="offcanvas offcanvas-start show" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body">

            @can('admin-dashboard')            
            <a href="/admin/dashboard" class="nav-link @if(Request::is('admin/dashboard')) nav-link-active @endif">
                <i class="fa fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            @endcan
    
            @can('user-dashboard')
            <a href="/admin/user-management" class="nav-link @if(Request::is('admin/user-management')) nav-link-active @endif">
               <i class="fa fa-users"></i>
               <span>Users</span>
            </a>
            @endcan
    
            @can('subscription-dashboard')
            <a href="/admin/subscription-plans" class="nav-link @if(Request::is('admin/subscription-plans')) nav-link-active @endif">
                <i class="fa fa-list-ol"></i>
                <span>Plans</span>
            </a>
            @endcan
    
            @can('mail-management')
            <a href="/admin/mail-system" class="nav-link @if(Request::is('admin/mail-system')) nav-link-active @endif">
                <i class="fa fa-envelope"></i>
                <span>Mails</span>
            </a>
            @endcan

            @can('articles-dashboard')
            <a href="/admin/articles" class="nav-link @if(Request::is('admin/articles')) nav-link-active @endif">
                <i class="fa fa-plus"></i>
                <span>Articles</span>
            </a>
            @endcan
             
            @can('privacy-security-management')
            <a href="/admin/privacy-security" class="nav-link @if(Request::is('admin/privacy-security')) nav-link-active @endif">
                <i class="fa fa-lock"></i>
                <span>Security</span>
            </a>
            @endcan

            @can('sso-clients-dashboard')
            <a href="/admin/sso-clients" class="nav-link @if(Request::is('admin/sso-clients')) nav-link-active @endif">
                <i class="fa fa-rocket"></i>
                <span>SSO Clients</span>
            </a>
            @endcan

            <a href="/clear-cache" class="nav-link @if(Request::is('admin/clear-cache')) nav-link-active @endif">
                <i class="fa fa-eraser"></i>
                <span>Clear Cache</span>
            </a>
            
        </div>
    </div>
    @endif
    
    <main>
      <div class="container-fluid">
        @yield('content')
      </div>
    </main>

@livewireScripts   
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
