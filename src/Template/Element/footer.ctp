<footer class="main-footer">
    <div class="pull-right hidden-xs">
   <!--img class="logoimage" src="<?php echo $webroot; ?>img/STRATEMIS LOGO Final-041.png" width="130px"-->
   
   <?php
                echo $this->Html->image('STRATEMIS LOGO Final-041.png', ['class' => 'logoimage','width' => '130px']);
                ?>
    </div>
    <strong>Copyright © 2018 <a href="">Stratemis</a>.</strong> All rights
    reserved.
  </footer>
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
   <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
	 <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
	 <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
           <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Anuj's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Sachin Updated His Profile</h4>

                <p>New phone +91 9999999999</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Anil Joined Mailing List</h4>

                <p>anil.k@stratemis.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
       
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">Information Details</h3>

          <div class="form-group">
           <label class="control-sidebar-subheading" id="telephone-number"><span class="fa fa-headphones">&nbsp;</span>0124-12345678 Ext: 6086</label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading" id="phone-number"><span class="fa fa-phone">&nbsp;</span>+91 987456123</label>
			<p id="social-icons">
			                    <a href=""><img id="facebook" width="24px" height="26px" src="<?php echo $webroot; ?>img/SideBarIcons/facebook.png" alt="facebook"/></img></a>
								<a href=""><img id="twitter" width="24px" height="26px" src="<?php echo $webroot; ?>img/SideBarIcons/twitter.png" alt="twitter"/></img></a>
								<a href=""><img id="linked" width="24px" height="26px" src="<?php echo $webroot; ?>img/SideBarIcons/linkedin.png" alt="linkedin"/></img></a>
								<a href=""><img id="mail" width="24px" height="26px" src="<?php echo $webroot; ?>img/SideBarIcons/mail.png" alt="mail"/></img></a>
								
							</p>
          </div>
          <!-- /.form-group -->
		  
           <h3 class="control-sidebar-heading">Hire Date</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading" id="date">DD/MM/YYYY</label>
			 <p>10/01/2018</p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
                <label id="emp-time-details" class="control-sidebar-subheading"><span class="fa fa-check-square">&nbsp;</span>Full Time</label>
                <label id="emp-time-development" class="control-sidebar-subheading"><span class="fa fa-users">&nbsp;</span>Development</label>
                <label id="emp-location" class="control-sidebar-subheading"><span class="fa fa-map-marker">&nbsp;</span>Gurgaon, India</label>
       
          </div>
         
          <!-- /.form-group -->
		  <h3 class="control-sidebar-heading">Manager</h3>
		  <div class="form-group">
            <label class="control-sidebar-subheading" id="managerName"><a href=""><img class="manager01" id="ManagerImage1" src="<?php echo $webroot; ?>img/SideBarIcons/manager1.png" alt="manager1"></img></a>
			Abhishek Verma</label>
			<label class="control-sidebar-subheading" id="managerRole">Program Manager</label>
          </div>
         
          <!-- /.form-group -->
		   <h3 class="control-sidebar-heading">Gender Diversity Reports</h3>
		  <div class="form-group">
			 <p id="fulltime-icon">
                 <label id="empWomen" class="control-sidebar-subheading"><span class="fa fa-users">&nbsp;</span>Men</label>
			</p>
			<p id="team-icon">
                <label id="empWomen" class="control-sidebar-subheading"><span class="fa fa-users">&nbsp;</span>Women</label>
            </p>
		    <p id="location-icon"> 
                <label id="more" class="control-sidebar-subheading"><span class="fa fa-map-marker">&nbsp;</span>More</label>
            </p>
			
          </div>
         
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <div class="control-sidebar-bg"></div>
  
  <!-- Bootstrap 3.3.7 -->
<script src="<?= $webroot; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
<script src="<?= $webroot; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= $webroot; ?>dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?= $webroot; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?= $webroot; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= $webroot; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?= $webroot; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?= $webroot; ?>bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $webroot; ?>dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $webroot; ?>dist/js/demo.js"></script>


<script>


$(document).ready(function(){
  // Get current path and find target link
  var path = window.location.pathname;
  
  //console.log( path);
  
  // Account for home page with empty path
  
   $('li').removeClass('active');   
  var target = $('li a[href="'+path+'"]');
  
    //console.log(target);
  // Add active class to target link
  
  target.parent('li').addClass('active');
  target.parent('li').parent('ul').parent('li').addClass('menu-open"');
   target.parent('li').parent('ul').show();
});

</script>
