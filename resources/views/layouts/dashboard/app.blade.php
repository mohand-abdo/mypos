<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    <!-- Favicon -->
    <link href="{{asset('dashboard_files/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Icons -->
    <link href="{{asset('dashboard_files/assets/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard_files/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    @if (app()->getlocale() == 'ar')
        <link href="{{asset('dashboard_files/assets/css/argon-dashboard-rtl.css')}}" rel="stylesheet" />

    @elseif (app()->getlocale() == 'en')
        <link href="{{asset('dashboard_files/assets/css/argon-dashboard.css')}}" rel="stylesheet" />       
    @endif
    <style>
        .disabled {cursor: not-allowed !important;}
    </style>
    @yield('css')

</head>

<body class="">
    <!-- Slidebar -->
    @include('layouts.dashboard.includes.slidbar')

    <!-- Main-Content -->
    <div class="main-content">

        <!-- Navbar -->
        @include('layouts.dashboard.includes.navbar')
        
        <!-- Breadcrunb -->
        @include('layouts.dashboard.includes.breadcrumb')
        
        

        <!-- Content -->
        <div class="container-fluid mt--7">


            @yield('content')

            <!-- Footer -->
            @include('layouts.dashboard.includes.footer')

        </div>

    </div>

    <script src="{{asset('dashboard_files/assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!--   Optional JS   -->
    <script src="{{asset('dashboard_files/assets/js/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/chart.js/dist/Chart.extension.js')}}"></script> 

    <!--   Argon JS   -->
    <script src="{{asset('dashboard_files/assets/js/argon-dashboard.js')}}"></script>
    @yield('js')
    <script>
        window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });


        //change the image preview

        $(".image").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
            readURL(this);
        });
    </script>

</body>
</html>