  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header"></li>
        <li>
          <a href="<?php echo url('/admin');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php if (strstr($_SERVER['REQUEST_URI'], '/admin/categories')){echo 'active';} ?>">
          <a href="<?php echo url('/admin/categories') ?>">
            <i class="fa fa-user"></i>
            <span>Categories</span>
          </a>
        </li>
        <li class="<?php if (strstr($_SERVER['REQUEST_URI'], '/admin/users-g')){echo 'active';} ?>">
          <a href="<?php echo url('/admin/users-groups') ?>">
            <i class="fa fa-user"></i>
            <span>Users-Groups</span>
          </a>
        </li>
        <li class="<?php if (strstr($_SERVER['REQUEST_URI'], '/admin/users ')){echo 'active';} ?>">
          <a href="<?php echo url('/admin/users') ?>">
            <i class="fa fa-user"></i>
            <span>Users</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>