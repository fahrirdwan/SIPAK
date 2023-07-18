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
        <!-- Sidebar user panel (optional) -->
        

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN</li>
                <li class="nav-item ">
                    <a href="/user/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-rocket"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user/chat" class="nav-link">
                        <i class="nav-icon far fa-comments"></i>
                        <p>Chat</p>
                    </a>
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
                            <a href="/user/{{ strtolower($ctg->jenis_barang) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ $ctg->jenis_barang }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/user/peminjaman" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Peminjaman <span class="badge badge-primary right">{{ $hitung_peminjaman }}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user/pengembalian" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Pengembalian <span class="badge badge-success right">{{ $hitung_pengembalian }}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user/history" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>History <span class="badge badge-warning right">{{ $hitung_history }}</span></p>
                    </a>
                </li>
                <li class="nav-header">ACCOUNT</li>
                <li class="nav-item">
                    <a href="/user/profil" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user/ganti-password" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Ganti Password</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>