@extends('login.master')
@section('title',"LOGIN")


@section('content')

{{--start content--}}
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>{{env( 'APP_NAME' ) }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      @if (session('success'))
                      <div class="alert alert-success" role="alert">
                         {{session('success')}}
                      </div>
     @endif


      <form action="{{route('login.login')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- .col -->
        <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block mt-2">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
      </form>
      </p>
      <p class="mb-1">
      <a href="{{ route('forget') }}">I forgot my password</a>
    </p>
      <p class="mb-0">
        <a href="{{route('register')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
{{--end content--}}

@endsection
