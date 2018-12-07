<div class="row RowColor-1" id="rightColumn">
  	<div class="TopButton nomargin col-sm-12 col-md-12 col-lg-12 col-xs-12">  
	<?php

$role = $this->request->session()->read('role_id');
	if($role == '1') {
	?>

        <div class="ThirdToolRow">
            <a href="OrganizationalStructureTransactions.html">
                <?php
                echo $this->Html->image('SideBarIcons/transaction.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
                ?>
                <p class="square_btn_text">Transactions</p></a>
        </div>
        <div class="ThirdToolRow ThirdToolRowSelected">
            <a href="OrganizationalStructureControls.html" >
                <?php
                echo $this->Html->image('SideBarIcons/controls.png', ['class' => 'ThirdToolImageAlign']);
                ?>
                <p class="square_btn_text">Controls</p></a>
        </div>
        <div class="ThirdToolRow">
            <a href="OrganizationalStructureReports.html" >
                <?php
                echo $this->Html->image('SideBarIcons/reports.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
                ?>
                <p class="square_btn_text">Reports</p></a>
        </div>
    
	
	<?php
	}
	?>
	
                       <?php if( $role == '3' ) { ?>
						<div class="ThirdToolRow">
							<!--img src="images/SideBarIcons/holidaylist.png" href="http://10.100.8.61/hris/holiday-master" class="ThirdToolImageAlign hvr-grow"-->
							<?php
							echo $this->Html->image('SideBarIcons/holidaylist.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?>
							<p class="square_btn_text">Public Holiday List</p>	
						</div>
						<?php } ?>
						<?php if( $role == '2' || $role == '3' || $role == '4') { ?>
						<div class="ThirdToolRow">
							<a href="http://10.100.8.61/hris/user-roster"><!--img src="images/SideBarIcons/setroster.png" class="ThirdToolImageAlign hvr-grow"-->
							<?php
							echo $this->Html->image('SideBarIcons/setroster.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?></a>
							<p class="square_btn_text">Set Roster</p>	
						</div>
						<div class="ThirdToolRow">
									<a href="http://10.100.8.61/hris/user-attendance/add"><!--img src="images/SideBarIcons/attendance.png" class="ThirdToolImageAlign hvr-grow"-->
									<?php
							echo $this->Html->image('SideBarIcons/attendance.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?>
									</a>
									<p class="square_btn_text">Mark Attendance</p>		
						
						</div>
						<div class="ThirdToolRow">
									<a href="http://10.100.8.61/hris/user-attendance/index"><!--img src="images/SideBarIcons/pendingattendance.png" class="ThirdToolImageAlign hvr-grow"-->
									<?php
							echo $this->Html->image('SideBarIcons/pendingattendance.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?>
									</a>
									<p class="square_btn_text">Pending Attendance</p>		
						
						</div>
						<div class="ThirdToolRow">
								<a href="http://10.100.8.61/hris/leave"><!--img src="images/SideBarIcons/leaveapplication.png" class="ThirdToolImageAlign hvr-grow"-->
									<?php
							echo $this->Html->image('SideBarIcons/leaveapplication.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?>
								</a>
								<p class="square_btn_text">Leave Application</p>		
						</div>
						
						<?php } ?>
						<?php if(  $role == '3' || $role == '4') { ?>
						
						<div class="ThirdToolRow">
									<a href="#"><!--img src="images/SideBarIcons/leavecancellation.png" class="ThirdToolImageAlign hvr-grow"-->
									<?php
							echo $this->Html->image('SideBarIcons/leavecancellation.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?></a>
									<p class="square_btn_text">Leave Cancellation</p>		
						
						</div>
						<div class="ThirdToolRow">
									<a href="#"><!--img src="images/SideBarIcons/leaveTATReport.png" class="ThirdToolImageAlign hvr-grow"-->
									
											<?php
							echo $this->Html->image('SideBarIcons/leaveTATReport.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?>
							</a>
									<p class="square_btn_text">Leave TAT Report</p>		
						
						</div>
						<div class="ThirdToolRow">
									<a href="#"><!--img src="images/SideBarIcons/listview.png" class="ThirdToolImageAlign hvr-grow"-->
									
													<?php
							echo $this->Html->image('SideBarIcons/listview.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?></a>
									<p class="square_btn_text">Switch to List View</p>		
						
						</div>
						<div class="ThirdToolRow">
									<a href="#"><!--img src="images/SideBarIcons/excelexport.png" class="ThirdToolImageAlign hvr-grow"-->
									
														<?php
							echo $this->Html->image('SideBarIcons/excelexport.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?></a>
									<p class="square_btn_text">Export to Excel</p>		
						
						</div>
						<?php } ?>
						<?php if(  $role == '1') { ?>
						<div class="ThirdToolRow">
									<a href="#"><!--img src="images/SideBarIcons/proxyrights.png" class="ThirdToolImageAlign hvr-grow"-->
									<?php
							echo $this->Html->image('SideBarIcons/proxyrights.png', ['class' => 'ThirdToolImageAlign hvr-grow']);
							?></a>
									<p class="square_btn_text">Proxy Rights</p>		
						
						</div>
						<?php } ?>
					</div>
</div>