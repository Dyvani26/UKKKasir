@extends('dashboard.master')
@section('title',"Data Petugas")

@section('content')



<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">



    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>


        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> @yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item active"> @yield('title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">@yield('title')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{route('petugas.index')}}" type="button" class="btn btn-warning mb-2">Kembali</a>
                    <form action="{{ route('petugas.update',$data->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="">NIK</label>
                        <input type="text" class="form-control" name="nik" value="{{$data->detailUser->nik}}">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="{{$data->detailUser->nama_lengkap}}">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" value="{{$data->detailUser->tgl_lahir}}">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$data->email}}">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{$data->detailUser->alamat}}">
                        <label for="">No Telepon</label>
                        <input type="text" class="form-control" name="no_tlfn" value="{{$data->detailUser->no_tlfn}}">
                        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

@endsection
