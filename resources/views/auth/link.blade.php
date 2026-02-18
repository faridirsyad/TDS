@extends('layouts.app-master')

@section('content')
<h3>TDS International Indonesia</h3>
   
You can reset password from bellow link:
<a href="{{ route('reset.password', $token) }}">Reset Password</a>
@endsection
