
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Homy</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('style/dist/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('style/dist/assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{asset('style/dist/assets/images/logo.svg')}}">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form method="POST" action="{{ route('login') }}" class="pt-3">
                  @csrf
                  <div class="form-group">
                      <label for="email" class="form-label">{{ __('Email') }}</label>
                      <input type="email" class="form-control form-control-lg" id="email" name="email" :value="old('email')" required autofocus placeholder="Email">
                      @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                      @endif
                  </div>
              
                  <div class="form-group mt-4">
                      <label for="password" class="form-label">{{ __('Password') }}</label>
                      <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="Password">
                      @if ($errors->has('password'))
                          <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                  </div>
              
                  <div class="mt-3 d-grid gap-2">
                      <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
              
                  <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                          <label class="form-check-label text-muted">
                              <input type="checkbox" class="form-check-input" name="remember"> Keep me signed in
                          </label>
                      </div>
                      @if (Route::has('password.request'))
                          <a class="auth-link text-primary" href="{{ route('password.request') }}">Forgot password?</a>
                      @endif
                  </div>
              </form>
              
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('style/dist/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('style/dist/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/misc.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/settings.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/todolist.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
  </body>
</html>