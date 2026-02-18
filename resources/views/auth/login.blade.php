@extends('layouts.app-master')

@section('content')
<div class="container">
                <div class="brand-logo">
                    <img src="{{asset("/assets/img/tds.png")}}" alt="logo" />
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="fw-light">Sign in to continue.</h6>
                @if(session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <form class="pt-3" action="{{ route('login.action') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="username" class="form-label text-primary">Username <span class="text-danger">*must be filled</span></label>
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" name="username" value="{{ old('username') }}" placeholder="Username">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password" class="form-label text-primary">Password <span class="text-danger">*must be filled</span></label>
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"  name="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">&nbsp;</div>
                    <a href="{{url('forgot-password')}}" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">SIGN IN</button>
                  </div>
                  <div class="text-center mt-4 fw-light"> Don't have an account? <a href="{{url('/register')}}" class="text-primary">Register</a>
                  </div>
                </form>
</div>
@endsection
