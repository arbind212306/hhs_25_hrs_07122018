<?php
$webroot = $this->Url->build('/');
$user = $this->request->session()->read('Auth.User');



$name = "";
if (!empty($user['first_name'])) {
    $name = $user['first_name'];
}
if (!empty($user['last_name'])) {
    $name = $name . " " . $user['last_name'];
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $webroot; ?>dist/img//user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $name ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <!-- <li class="header">MAIN NAVIGATION</li> -->
            <!-- Dashboard Starts Here -->

           <?php /*<li class="active treeview">
			     <?php
                echo $this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>', ['controller' => 'pages', 'action' => 'dashboard'], ['escape' => false]);
                ?>
                
            </li>*/ ?>

            <!--li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>Control Panel</span>
                </a>
            </li-->
            <!--li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>Recruitment</span>
                </a>
            </li-->

            <?php
            if (!empty($allowed_menu)) {


                foreach ($allowed_menu as $parent) {
				
					if($parent['menu_icon'])
					    $menu_icon = $parent['menu_icon'];
				    else
						$menu_icon = '<i class="fa fa-circle-o"></i>';
                    
                    if ($parent['action']) {
						
						

                        echo '<li>';
                        echo $this->Html->link( $menu_icon. $parent['name'], ['controller' => $parent['controller'], 'action' => $parent['action']], ['escape' => false]);
                    } else {

                        echo '<li class="treeview">';
                        ?>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>
									<?= $parent['name'] ?></span>
                            
							 <?php if (!empty($parent['children'])) { ?>
							 <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
							 <?php } ?>
                        </a>
                    <?php } 
                    if (!empty($parent['children'])) {
                        ?>
                        <ul class="treeview-menu">


					        <?php foreach ($parent['children'] as $child) { ?>
						
						     <li >
                                <?php
                                echo $this->Html->link($menu_icon. $child['name'], ['controller' => $child['controller'], 'action' => $child['action']], ['escape' => false]);
                                ?>
                                </li>
                                    <?php
                                }
                                ?>
                        </ul>
                            <?php
                        }
                        ?>

                    </li>

        <?php
    }
}
?>
            <?php /*
              <!-- Dashboard Ends Here -->
              <!-- Organizational Starts Here -->
              <li class="treeview">
              <a href="#">
              <i class="fa fa-sitemap"></i> <span>Organizational Structure</span>
              </a>
              </li>
              <!-- Organizational Ends Here -->
              <li class="treeview">
              <a href="#">
              <i class="fa fa-briefcase"></i> <span>Hiring Management</span>
              </a>
              </li>

              <!-- Personal Profile Starts Here -->
              <li>
              <a href="pages/widgets.html">
              <i class="fa fa-user"></i> <span>Profile Management</span>
              </a>
              </li>
              <!-- Personal Profile Ends Here -->
              <li class="treeview">
              <a href="#">
              <i class="fa fa-group"></i><span>Employee Management</span>
              </a>
              </li>
              <li class="treeview">
              <a href="attendancemanagement.html">
              <i class="fa fa-list-alt"></i> <span>Attendance Management</span>
              </a>
              </li>
              <li class="treeview">
              <a href="#">
              <i class="fa fa-money"></i> <span>Payroll Management</span>
              </a>
              </li>
              <li class="treeview">
              <a href="#">
              <i class="fa fa-gears"></i> <span>Administration</span>
              </a>
              </li>
              <li class="treeview">
              <a href="#">
              <i class="fa fa-star"></i> <span>Performance Management</span>
              </a>
              </li>
              <li>
              <a href="#">
              <i class="fa fa-wrench"></i> <span>Employee Self Service</span>
              </a>
              </li>
              <li>
              <a href="#">
              <i class="fa fa-gear"></i> <span>Employee Management</span>
              </a>
              </li>
              <li>
              <a href="#">
              <i class="fa fa-sign-out"></i> <span>e-Exit</span>
              </a>
              </li>
              <li>
              <a href="#">
              <i class="fa fa-line-chart"></i> <span>HR-Bi</span>
              </a>
              </li>
             

            <!--li class="treeview">
                <a href="#">
                    <i class="fa fa-sitemap"></i> <span>Organizational Structure</span>
                </a>
            </li-->
            <!-- Organizational Ends Here -->
            <li>
                <a href="#">
                    <i class="fa fa-wrench"></i> <span>Employee Self Service</span>
                </a>
            </li>		
            <!--li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Attendance Management</span>
                </a>
            </li-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-star"></i> <span>Performance Management</span>
                </a>
            </li>	
            <li>
                <a href="#">
                    <i class="fa fa-smile-o"></i> <span>Employee Benefit</span>
                </a>
            </li>		
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Payroll Management</span>
                </a>
            </li>
            <!--li>
                <a href="#">
                    <i class="fa fa-sign-out"></i> <span>Exit Management</span>
                </a>
            </li-->		
            <li>
                <a href="#">
                    <i class="fa fa-line-chart"></i> <span>Analytics & BI</span>
                </a>
            </li>		

            <li>
<?php
// echo $this->Html->link();
?>
                <?php
                echo $this->Html->link('<i class="fa fa-link"></i> <span>Quick Links</span>', ['controller' => 'pages', 'action' => 'quicklink'], ['escape' => false]);
                ?>
            </li> */ ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>