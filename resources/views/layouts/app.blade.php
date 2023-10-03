<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         
        <meta name="viewport" content="width=device-width, initial-scale=1">
          
        <title>Ample Admin Lite Template by WrapPixel</title>
        <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />

        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">

        <!-- Custom CSS -->
        <link href="{{ asset('assets/plugins/bower_components/chartist/dist/chartist.min.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" href="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}">
        
        <!-- Custom CSS -->
        <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
        
    </head>
    <body>
        
        @include('layouts.partials.preloader')

        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
            data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            
            @include('layouts.partials.topbar')

            @include('layouts.partials.leftsidebar')
 
            <div class="page-wrapper">

                @include('layouts.partials.breadcrumb')
 
                <div class="container-fluid"> 

                    @yield('content')

                </div>                                
                
                @include('layouts.partials.footer')

            </div>
            
            
        </div>

        



        <script src="{{ asset('assets/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
        
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/app-style-switcher.js') }}"></script>
        <script src="{{ asset('assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        
        <!--Wave Effects -->
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        
        <!--Menu sidebar -->
        <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
        
        <!--Custom JavaScript -->
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        
        <!--This page JavaScript -->
        <!--chartis chart-->
        <script src="{{ asset('assets/plugins/bower_components/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboards/dashboard1.js') }}"></script>
    </body>
    
</html>