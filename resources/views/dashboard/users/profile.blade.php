<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{__('dashboard.profile')}}
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

  <div class="main-content">
    <!-- Navbar -->
    @include('layouts.dashboard.includes.navbar')
    <!-- End Navbar -->

    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url('{{asset('dashboard_files/assets/img/theme/profile-cover.jpg')}}'); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">{{__('dashboard.hello').' '.auth()->user()->first_name}}</h1>
            <p class="text-white mt-0 mb-5">{{__('dashboard.profile_desc')}}</p>
            <a href="{{ route('dashboard.users.edit',$user->id) }}" class="btn btn-info">{{__('dashboard.edit').' '.__('dashboard.profile')}}</a>
            <a href="#card-password" id="btn_password" class="btn btn-primary">{{__('dashboard.password')}}</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
          @endif
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{__('dashboard.account')}}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">{{__('dashboard.first_name')}}</label>
                      <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="First Name" value="{{$user->first_name}}" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-lastname">{{__('dashboard.last_name')}}</label>
                      <input type="text" id="input-lastname" class="form-control form-control-alternative" placeholder="Last Name" value="{{$user->last_name}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">{{__('dashboard.last_name')}}</label>
                      <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="Email" value="{{ $user->email}}" disabled>
                      </div>
                    </div>
                  </div>
                  <img src="{{asset('dashboard_files/assets/upload/user_images/'.$user->image)}}" id="image-preview" style="width:100px;margin-bottom:1.5rem"/>
                </div>

                <div class="pl-lg-4" id="card-password" style="{{ $errors->any()?'display:block':'display:none' }}" >
                  <hr class="my-4" />
                  <form method="POST" action="{{ route('dashboard.users.changePassword')}}">
                    @csrf
                  <input type="hidden" value="{{$user->id}}" name="user_id">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-oldPassword">{{__('dashboard.old_password')}}</label>
                          <input type="password" id="input-oldPassword" name="old_password" class="form-control form-control-alternative @error('old_password') is-invalid @enderror" placeholder="{{__('dashboard.old_password')}}">
                          @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-newPassword">{{__('dashboard.new_password')}}</label>
                          <input type="password" id="input-newPassword" name="new_password" class="form-control form-control-alternative @error('new_password') is-invalid @enderror" placeholder="{{__('dashboard.new_password')}}">
                          @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-confirmPassword">{{__('dashboard.confirm_password')}}</label>
                        <input type="password" id="input-confirmPassword" name="new_password_confirmation" class="form-control form-control-alternative" placeholder="{{__('dashboard.confirm_password')}}">
                        </div>
                      </div>
                      <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary">{{__('dashboard.update')}}</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      @include('layouts.dashboard.includes.footer')
    </div>
  </div>
  <!--   Core   -->
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
        $(document).ready(function () {
          $('body').on('click','#btn_password',function(e){
            $('#card-password').fadeToggle();
            var $anchor = $(this);          
            $('html, body').stop().animate({
              scrollTop: $($anchor.attr('href')).offset().top
            }, 1500);
           e.preventDefault();
         });
          @if($errors->any())
           $('html, body').stop().animate({
              scrollTop:500
            }, 500); 
          @endif
        });
    

    </script>
</body>

</html>