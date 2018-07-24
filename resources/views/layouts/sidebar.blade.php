
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('dist/img/avatarrg.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
            <p>{{Auth::user()->username}}</p>
                {{Auth::user()->cabangs->Kode_Cabang}}
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <?php
            foreach ($sidebars as $key=>$sidebar){
                echo '<li class="treeview">
                    <a href="#">
                        <i class="fa '.$sidebar['icon'].'"></i> <span>'.$sidebar['namakategorimenu'].'</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">';   
                        foreach ($sidebar['page'] as $key => $page){
                            echo '<li><a href="'.route($page['urlindex']).'"><i class="fa fa-circle-o"></i> '.$page['display_name'].'</a></li>';
                        }
                
                echo '</ul></li>';
            }

            
            ?>
            
        </ul>
</aside>
