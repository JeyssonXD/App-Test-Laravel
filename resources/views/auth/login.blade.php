@extends('../../share/LayoutResource')

@section('content')
  <div class="container">
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
      <div class="card ">
          <div class="card-header text-center"><a href="#"><aside><b><i style="font-size: 1.5em;" class="fas fa-file-code"></i> APP-TEST-Laravel 5.8</b></aside></a><span class="splash-description">Please enter your user information.</span></div>
          <div class="card-body">
              <form action="{{ URL::ROUTE('loginIn') }}" method="POST">
                  @csrf
                  <div class="form-group">
                      <input class="form-control form-control-lg" id="name" name="email" type="email" placeholder="Email" value="{{$email??''}}" >
                      @if($errors->first('email'))<div class="alert red-text">{{ $errors->first('email') }}</div>@endif
                  </div>
                  <div class="form-group">
                      <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password" {{$password??''}} autocomplete="off">
                      @if($errors->first('password'))<div class="alert red-text">{{ $errors->first('password') }}</div>@endif
                  </div>
                  <div class="form-group">
                      <label class="custom-control custom-checkbox">
                          <input name="remember" id="remember" class="custom-control-input" type="checkbox" @if(isset($remember)) checked @endif><span class="custom-control-label">Remember Me</span>
                      </label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
              </form>
          </div>
      </div>
  </div>
  </div>
@endsection
