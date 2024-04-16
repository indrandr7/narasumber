<div class="wrapper"> 
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto"></ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div style="text-align: center;">
            <a href="#" class="d-inline-block mt-2 mb-1">
                <img src="{{ asset('lte/dist/img/logo_den.png') }}" class="rounded-circle img-fluid" width="70" height="70" alt="">
            </a>
        </div>
        <div class="brand-link" style="font-size: 15px;text-align:center; color: #ffffff;font-weight:bold;padding-top:0px;">
            Monitoring Evaluasi<br>Pembayaran Narasumber (Monisa)
        </div>
       
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">

                    @if (Session::get('sesLevel') == 'administrator' || Session::get('sesLevel') == 'operator')
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('kegiatan') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i> Kegiatan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('narasumber') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i> Narasumber
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (Session::get('sesLevel') == 'verifikator')
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('kegiatan') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i> Kegiatan
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (Session::get('sesLevel') == 'administrator')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('eselon') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>Eselon
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('golongan') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>Golongan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('mataanggaran') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>Mata Anggaran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('bagian') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>Bagian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('biro') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>Biro
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('ppk') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>PPK/Bendahara
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('pengguna') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>Pengguna
                                </a>
                            </li>
                            
                        </ul>
                    </li>    
                    @endif
                    
                    <li class="nav-item  ">
                        <a href="{{ url('pengguna/gantipassword') }}" class="nav-link ">
                            <i class="nav-icon fas fa-copy"></i>Ganti Password
                        </a>
                    </li>

                    <li class="nav-item  ">
                        <a href="{{ url('pengguna/gantipassword') }}" class="nav-link ">
                            <i class="nav-icon fas fa-copy"></i>Ganti Password2
                        </a>
                    </li>

                    <li class="nav-item  ">
                        <a href="{{ url('logout') }}" class="nav-link ">
                            <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </aside>
{{-- </div> --}}