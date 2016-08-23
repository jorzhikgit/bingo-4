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
                    @if($user->access_level >= 1)
                        <li><a ui-sref="app.play"><i class="fa fa-play"></i> Play</a></li>
                    @endif
                    @if($user->access_level > 2)
                        <li><a ui-sref="app.maker"><i class="fa fa-legal"></i> Card Maker</a></li>
                    @endif
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
