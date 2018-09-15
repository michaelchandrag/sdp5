 <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo site_url('cgudang/index') ?>" class="site_title"><i class="fa fa-shopping-cart"></i> <span>adaSTORE</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php echo base_url('Images/sc.jpg'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Steven Christian</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li ><a><i class="fa fa-archive"></i> Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li ><a href="<?php echo site_url('cgudang/insertBarang');?>">Barang</a></li>
                      <li><a href="<?php echo site_url('cgudang/insertKategori');?>">Kategori</a></li>
                      <li><a href="<?php echo site_url('cgudang/insertGudang');?>">Gudang</a></li>
                      <li><a href="<?php echo site_url('cgudang/insertBrand');?>">Brand</a></li>
                      <li><a href="<?php echo site_url('cpenjualan/insertMember');?>">Member</a></li>
                      <li><a href="<?php echo site_url('cpenjualan/insertPromo');?>">Promo</a></li>
                      <li><a href="<?php echo site_url('Cont/supplier');?>">Supplier</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i> Pembelian <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Cont/master');?>">Pembelian</a></li>
                      <li><a href="<?php echo site_url('Cont/hbeli');?>">Koreksi/Hapus</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-tag"></i> Penjualan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('cpenjualan/infoDpenjualan'); ?>">Info penjualan</a></li>
					  <li><a href="<?php echo site_url('cpenjualan/historypenjualan'); ?>">History penjualan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-database"></i> Gudang <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('cgudang/infoDgudang'); ?>">Stok</a></li>
                      <li><a href="<?php echo site_url("cgudang/transferGudang") ?>">Transfer Gudang</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-area-chart"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="<?php echo site_url('cpenjualan/reportpenjualan'); ?>">Penjualan</a></li>
                      <li><a href="<?php echo site_url('Cont/dataPembelian');?>">Pembelian</a></li>
                      <li><a href="<?php echo site_url('cgudang/reporttransfergudang'); ?>">Transfer Gudang</a></li>
                    </ul>
                  </li>
                  
                  <!-- <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li> -->

                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>

            -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <!--
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="Images/sc.jpg" alt="">Steven Christian
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/sc.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>Steven Christian</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/sc.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>Steven Christian</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/sc.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>Steven Christian</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/sc.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>Steven Christian</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
              -->
            </nav>
          </div>
        </div>
        <!-- /top navigation -->