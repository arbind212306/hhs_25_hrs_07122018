<?php
$user = $this->request->session()->read('Auth.User');
$name = "";
if (!empty($user['first_name'])) {
    $name = $user['first_name'];
}
if (!empty($user['last_name'])) {
    $name = $name . " " . $user['last_name'];
}


$webroot = $this->Url->build('/');

?>

<?php /*<div class="row TopBox nomargin" style="width:100%;">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
        <h4>Human Resource Information System</h4>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6 UserProfile">
        <ul class="user_detail_list">
            <li>
                <?php
                echo $this->Html->image('LoginProfile.jpg', ['height' => '30px', 'width' => '30px', 'class' => 'img-circle']);
                ?>
            </li>
        </ul>
        <ul class="user_detail_list" style="padding: 0px; margin: 0px; margin-top: 4%;">
            <li>Welcome <?= $name; ?>&nbsp;&nbsp;&nbsp;|</li>
            <li><a class="dropdown-toggle" type="button" data-toggle="dropdown" title="Log In" data-placement="left">
                    <i class="glyphicon glyphicon-triangle-bottom" style="color:white;"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="menu1" style="width:150px;">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Change Password</a></li>
                    <!--<li role="presentation" class="divider"></li>-->
                    <li role="presentation">
                        <?php
                        echo $this->Html->link('Log Out', ['controller' => 'users', 'action' => 'logout'], ['role' => 'menuitem']);
                        ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<p style="background-color:#f2f2f2;"></p> */ ?>


<header class="main-header">

    <!-- Logo -->
    <a id="companyLogo1" href="<?php echo $webroot; ?>pages/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
	  <?php
                echo $this->Html->image('SideBarIcons/shortcutlogo1.png', [ 'id' => 'img-ShortcutLogo']);
                ?>
	  <!--img id="ShortcutLogo" src="images/SideBarIcons/shortcutlogo1.png" alt=""></span-->
      <!-- logo for regular state and mobile devices -->
	  </span>
      <span class="logo-lg">
	   <?php
                echo $this->Html->image('India_Carbon_logo.png', [ 'class' => 'logoimage','width' => '192px' , 'style' => 'padding:3px 51px']);
                ?>
				
	  <!--img class="logoimage" src="Images/India_Carbon_logo.png" width="192px" style="padding:3px 51px"--></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= $webroot; ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not design a new theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= $webroot; ?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Stratemis Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not design a new theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= $webroot; ?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not design a new theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= $webroot; ?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not design a new theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= $webroot; ?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not design a new theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $webroot; ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $webroot; ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $name; ?>
                  <!--small>Member since Nov. 2010</small-->
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Admin</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">HR</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Users</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <!--a href="#" class="btn btn-default btn-flat">Sign out</a-->
				  
				  <?php
                        echo $this->Html->link('Sign Out', ['controller' => 'users', 'action' => 'logout'], ['role' => 'menuitem','class' => 'btn btn-default btn-flat']);
                        ?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>

