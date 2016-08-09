<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="images/logo.png" class="img-rounded" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, {{ $user->display_name }}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a ui-sref="app">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Bingo</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a ui-sref="app.play"><i class="fa fa-play"></i> Play</a></li>

                    <li><a ui-sref="app.maker"><i class="fa fa-legal"></i> Card Maker</a></li>
                </ul>
            </li>
            @if($user->access_level > 1)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Configurations</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a ui-sref="app.user"><i class="fa fa-group"></i> Users</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
