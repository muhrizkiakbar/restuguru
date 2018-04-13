
<header class="main-header">
    <!-- Logo -->
    <a href="/home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>EA</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>e-Absen</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">
                    4
                </span>
                </a>
                <ul class="dropdown-menu">
                <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                    
                    <li>
                        <a href="/alat/instansi">
                        <i class="fa fa-users text-aqua"></i> Pegawai belum ditambahkan
                        </a>
                    </li>
                   
                    <li>
                        <a href="/alat/instansi/sidikjari">
                        <i class="fa fa-users text-yellow"></i>  Pegawai sidik jari belum berubah
                        </a>
                    </li>
                    </ul>
                </li>
                <!-- <li class="footer"><a href="#">View all</a></li> -->
                </ul>
            </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('dist/img/avatarumum.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">Tes</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('dist/img/avatarumum.png')}}" class="img-circle" alt="User Image">

                            <p>
                                Tes
                                <small>Tes</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/changepassword" class="btn btn-default btn-flat">Edit Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
