
@extends('dashboard.master')

@section('title', 'Data Transaksi')

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
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
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
                  <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">Total Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $total = 0;
                        @endphp

                        @foreach ($list as $i)
                        @php
                            $total += $i->total;
                        @endphp

                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $i->barang->nama_barang}}</td>
                            <td class="text-center">{{ $i->jml_barang }}</td>
                            <td class="text-center">{{ formatRupiah($i->total) }}</td>
                        </tr>
                        @endforeach
                        <form action="{{ route('transaksi.bayar',$id) }}" method="post" >
                            @csrf
                            @method('PUT')
                        <tr>
                            <td class="text-right" colspan="3">Total</td>
                            <td class="text-center" id="total_harga">{{ formatRupiah($total) }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3">Diskon</td>
                            <td class="text-center"><input class="form-control text-center" type="number" name="diskon" id="diskon"></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3">Total Tagihan</td>
                            <td class="text-center"><input class="form-control text-center" type="number" name="total" id="total"></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3">Bayar</td>
                            <td class="text-center"><input class="form-control text-center" type="number" name="bayar" id="bayar"></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3">Kembalian</td>
                            <td class="text-center"><input class="form-control text-center" type="number" name="kembalian" id="kembalian"></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3"></td>
                            <td class="text-center"><button type="simpan" id="simpan" class="btn btn-warning">Simpan</button></td>
                        </tr>
                    </form>
                                    </td>
                                </tr>

                  </table>
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


