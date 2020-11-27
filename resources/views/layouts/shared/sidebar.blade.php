<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/sisbro.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CV.Kaos SisBro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/ivan.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->nama }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Data Akun
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pelanggan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pelanggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vendor.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Vendor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('barang') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="pesanan" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Data Pesanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pelunasan" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Data Pelunasan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="aruskas" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Data Arus Kas
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Data Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/larangkuman/lapel" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lap Penjualan Per Pelanggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/larangkuman/laprang" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lap Penjualan Rangkuman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lap Hutang dan Piutang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lap Arus Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lap Jurnal Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->role_id == 1)
                <li class="nav-item">
                  <a href="user" class="nav-link">
                      <i class="nav-icon fas fa-address-card"></i>
                      <p>
                          Data User
                      </p>
                  </a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="{{ route('logout')}}" class="nav-link">
                      <i class="nav-icon fas fa-power-off"></i>
                      <p>
                          Logout
                      </p>
                  </a>
              </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
