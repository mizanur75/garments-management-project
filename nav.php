<aside class="app-sidebar">
  <div class="app-sidebar__user"><img height="50" class="app-sidebar__user-avatar" src="img/mr.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">Mizanur Rahman</p>
      <!--p class="app-sidebar__user-designation">Frontend Developer</p-->
      
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="home.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">HR Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <?php if ($_SESSION["s_role_id"] == 1) { ?>
        <li><a class="treeview-item" href="home.php?page=3"><i class="icon fa fa-circle-o"></i> User Mangement</a></li>
        <?php } ?>
        <li><a class="treeview-item" href="home.php?page=6"><i class="icon fa fa-circle-o"></i> HRM</a></li>
      </ul>
    </li>
    <li><a class="app-menu__item" href="home.php?page=16"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Purchase Management</span></a></li>
    <li><a class="app-menu__item" href="home.php?page=29"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Production Management</span></a></li>
    <li><a class="app-menu__item" href="home.php?page=11"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Order Management</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Store Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="home.php?page=33"><i class="icon fa fa-circle-o"></i> Stock Transition</a></li>
        <li><a class="treeview-item" href="home.php?page=28"><i class="icon fa fa-circle-o"></i> Row Materials</a></li>
        <li><a class="treeview-item" href="home.php?page=34"><i class="icon fa fa-circle-o"></i> Inventory</a></li>
        <li><a class="treeview-item" href="home.php?page=19"><i class="icon fa fa-circle-o"></i> Item Management</a></li>
        <li><a class="treeview-item" href="home.php?page=35"><i class="icon fa fa-circle-o"></i> Wearhouse Reports</a></li>
      </ul>
    </li>
  </ul>
</aside>