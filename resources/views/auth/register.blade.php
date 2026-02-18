@extends('layouts.app-master')

@section('content')
<div class="container">
                <div class="brand-logo">
                    <img src="{{asset("/assets/img/tds.png")}}" alt="logo" />
                </div>
                <h4>New here?</h4>
                <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" action="{{ route('register.action') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="username" class="form-label text-primary">Username <span class="text-danger">*must be filled</span></label>
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" name="username" value="{{ old('username') }}" placeholder="Username">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="email" class="form-label text-primary">Email <span class="text-danger">*must be filled</span></label>
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" value="{{ old('email') }}"placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password" class="form-label text-primary">Password <span class="text-danger">*must be filled</span></label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password">
                    <input type="checkbox" onclick="showPwd()"> Show Password
                    @if ($errors->has('password'))
                        <br><span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation" class="form-label text-primary">Password Confirmation <span class="text-danger">*must be filled</span></label>
                    <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation">
                    <input type="checkbox" onclick="showPwd2()"> Show Password
                    @if ($errors->has('password_confirmation'))
                        <br><span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                  </div>
                  {{-- <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div> --}}
                  <div class="mt-3 d-grid gap-2">
                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 fw-light"> Already have an account? <a href="{{url('/login')}}" class="text-primary">Login</a>
                  </div>
                </form>
</div>
@endsection
