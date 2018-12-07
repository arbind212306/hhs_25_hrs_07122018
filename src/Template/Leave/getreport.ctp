<h3> Report</h3>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!--script src="//code.jquery.com/jquery-1.10.2.js"></script-->
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#todate,#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <?php 
    
echo $this->Form->create(null, ['url' => ['controller' => 'leave', 'action' => 'getreport']]);
echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
echo $this->Form->input('fromdate',array('name'=>'fromdate','id'=>'fromdate','placeholder'=>'From Date','autocomplete'=>'off','required'=>'required','class'=>'form-control'));
	 echo '</div></div>';
 echo '<div class="col-md-4"><div class="form-group">';
echo $this->Form->input('todate',array('name'=>'todate','id'=>'todate','placeholder'=>'To Date' ,'autocomplete'=>'off','required'=>'required','class'=>'form-control'));
	 echo '</div></div></div>';


 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
echo $this->Form->button(__('Add'));
 echo '</div></div></div>';
echo $this->Form->end();


?>
<div class="table-responsive">
  <table class="table" width="100%" >
    <thead><tr>
        <th nowrap="">EmpID</th>
        <th nowrap="">Name</th>
        <th nowrap="">Appraiser </th>
        <th nowrap="">BU </th>
        <th nowrap="">Designation</th>
        <th nowrap="">Subdepartment</th>
		<th nowrap="">Grade</th>
		<th nowrap="">Location</th>
		<th nowrap="">Emp Cat</th>
		<th nowrap="">DOJ</th>
		<!--th>present</th>
		<th>shift_id</th-->
		
		<?php 
		
		if(count($reportdata) > 0){
			
			
		 foreach( explode(',',$reportdata[0]['shift_date']) as $day) { ?>
		
		<th nowrap=""><?php echo $day; ?></th>
		<?php } 
		}
		?>
       </tr>
    </thead>
	   <tbody>
	   <?php if($reportdata){
					foreach( $reportdata as $report){

		?>
        <tr>
		
		
         <td nowrap=""><?php echo  $report['empid']; ?> </td>
		 <td nowrap=""><?php echo  $report['uname']; ?> </td>
		 <td nowrap=""><?php echo  $report['appraiser_id']; ?> </td>
		 <td nowrap=""><?php echo  $report['unit_id']; ?> </td>
		 <td nowrap=""><?php echo  $report['designation_id']; ?> </td>
		 <td nowrap=""><?php echo  $report['sub_department_id']; ?> </td>
		 <td nowrap=""><?php echo  $report['grade_id']; ?> </td>
		 <td nowrap=""><?php echo  $report['c_location_id']; ?> </td>
		 <td nowrap=""><?php echo  $report['empcat']; ?> </td>
		  <td nowrap=""><?php echo  $report['doj']; ?> </td>
		<?php /* <td nowrap=""><?php echo  $report['present']; ?> </td>
		 <td nowrap=""><?php echo  $report['shift_id']; ?> </td> */ ?>
		 
		 <?php foreach( explode(',', $report['shift_name']) as $day_present) { ?>
		
		 <td nowrap=""><?php 
		 
		 
		  
		 if($day_present=='Present')
		     echo  "P" ;
	     else  if($day_present=='Absent')
			 echo  "A" ;
		 
		 else  if($day_present=='Week Off')
			 echo  "WO" ;
		 else  
			 echo  "NA" ;
		 
		 
		 ?></td>
		<?php } ?>
		 
		<?php 
					}
					?>
	   </tr>
				   <?php
				   
				   /*echo $this->Html->link('export', array(
											'controller' => 'leave', 
											'action' => 'getreport',
											'ext' => 'csv'
										));*/
		} 
		      else 
			  { 
		  ?>
		 <td colspan="12" align="center">  No Row Found !</td>
		 <?php } ?>
		
     
        </tbody>
	
	</table>
</div>
     