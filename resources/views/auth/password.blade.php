@extends('layouts.app-master')

@section('content')
<div class="container">
                <div class="brand-logo">
                    <img src="{{asset("/assets/img/tds.png")}}" alt="logo" />
                </div>
                <h4>Forgot your password?</h4>
                <h6 class="fw-light">Reset is easy. It only takes a few steps</h6>
                @if(session('message'))
                    <p class="alert alert-success">{{ session('message') }}</p>
                @endif
                <form class="pt-3" action="{{ route('password.action') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="email" class="form-label text-primary">Email <span class="text-danger">*must be filled</span></label>
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" value="{{ old('email') }}"placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">SEND PASSWORD RESET LINK</button>
                  </div>
                </form>
</div>
@endsection
