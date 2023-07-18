<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <center>
            <span class="brand-text font-weight-light" title="Sistem Peminjaman Aset Alat Kantor">SIPAK</span>
            
        </center>
      </a>
  

    <!-- Sidebar -->
    <div class="sidebar">
      <div class=" mt-3 pb-3 mb-3 d-flex" style=" border-bottom: 2px solid silver;">
            <img src="/auth/images/bg-01.jpg" alt="SIPAK" class="img-fluid rounded" style="opacity: .8" width="250"><br>
      </div>

      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">MAIN</li>
            <li class="nav-item ">
                <a href="/admin/dashboard" class="nav-link">
                    <i class="nav-icon fas fa-rocket"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="/admin/chat" class="nav-link">
                    <i class="nav-icon far fa-comments"></i>
                    <p>Chat</p>
                </a>
            </li>            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Asset
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin/list-asset" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Semua Asset</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/jenis_barang" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Aset</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Kategori Asset
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @foreach($category as $ctg)
                    <li class="nav-item">
                        <a href="/admin/{{ strtolower($ctg->jenis_barang) }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ $ctg->jenis_barang }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a href="/admin/peminjaman" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Data Peminjam
                        <span class="badge badge-primary right">{{ $hitung_peminjaman }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/pengembalian" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Data Pengembalian
                        <span class="badge badge-success right">{{ $hitung_pengembalian }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="/admin/pembatalan" class="nav-link">
                    <i class="nav-icon fas fa-times"></i>
                    <p>Pembatalan Transaksi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/check-kondisi" class="nav-link">
                    <i class="nav-icon fas fa-check"></i>
                    <p>
                        Check Kondisi Aset
                        <span class="badge badge-warning right">{{ $hitung_check_kondisi }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/history" class="nav-link">
                    <i class="nav-icon fas fa-history"></i>
                    <p>History</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/laporan" class="nav-link">
                    &nbsp;<i class="fas fa-print" style="color: #f0f2f4;"></i>
                    <p>&ensp;Cetak Laporan</p>
                </a>
            </li>
            <li class="nav-header">ACCOUNT</li>
            <li class="nav-item">
                <a href="/admin/profil" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profile</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/ganti-password" class="nav-link">
                    <i class="nav-icon fas fa-lock"></i>
                    <p>Ganti Password</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/user-access" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>User Access</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>