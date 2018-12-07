<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Add Leave Type</h1>

<?php

   $options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' => 1
    );

    
    $options = array(
        '1' => 'Yes',
        '0' => 'No'
    );

    $eattributes = array(
        'legend' => false,
        'value' => 1
        
    );
    echo $this->Form->create($leavetype); ?>
   
 <div class="row box">
     <div class="col-md-6">
              <div class="form-group">
              <?php echo $this->Form->control('name',array('class'=>'form-control')); ?>
                  
              </div>
  
  
	

         <div class="form-group">
            <label>Leave Category</label>
           
            <?php 
            $leave_category = array('EL'=>'Earned Leave','PL'=>'Personal Leave','SL'=>'Sick Leave','CL'=>'Causal Leave','ML'=>'Maternity leave','PAL'=>'Paternity leave','PRL'=>'Privileged leave','WOH'=>'Work from Home','BT'=>'Business Travel','BL'=>'Birthday Leave','COMPOFF'=>'Compensatory  OFF');
            echo $this->Form->input('leave_category', array('type'=>'select', 'options'=> $leave_category, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
   
		
		  <div class="input text"><label>Status</label>
    <?php echo $this->Form->radio('status', $options, $attributes);?>
    </div>
    <?php /*<div class="input text"><label>Special Leave</label>
    <?php echo $this->Form->radio('special_leave', $options, $attributes);?>
    </div>*/ ?>
     </div>
    <div class="col-md-6">
        <div class="form-group">
    <?php echo $this->Form->control('description',array('class'=>'form-control')); ?>
         </div>
    </div>
    </div>
 <div class="row ">
     <div class="col-md-12">
         
         <div class="form-group">
            <label>Encashment</label>
       <?php echo $this->Form->radio('encashment', $options, $eattributes);?>
    
      </div>
     </div>
     </div>
 <div class="row">
     <div class="box-header">
              <h3 class="box-title">Combine Leave type</h3>
              <hr />
         </div>
     <div class="col-md-6">
         <div class="form-group">
            <label>Leave type can be combine with :-</label>
           
            <?php 
           
             foreach($leavetypes as $le){
         
                $Leavetyes_list[$le['id']]=$le['name'];
            }
            //$gender = array('male'=>'Male','female'=>'Female','either'=>'Either');
            echo $this->Form->input('allowed_with_leave_type', array('type'=>'select', 'options'=> $Leavetyes_list, 'label'=>false, 'empty'=>'','class'=>'form-control','multiple'=>'multiple')); 
            
            ?>
            
         </div>
        </div>

     </div>
 <div class="row">
     <div class="box-header">
              <h3 class="box-title">Eligiblity</h3>
              <hr />
        
        <div class="col-md-4">
         <div class="form-group">
            <label>Gender</label>
           
            <?php 
              $gender = array('male'=>'Male','female'=>'Female','other'=>'Other','all'=>'All');
            echo $this->Form->input('gender', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
        <div class="col-md-4">
         <div class="form-group">
            <label>Type of employment</label>
           
            <?php 
            
            
            if($leavetype->nature_of_employement){
            $toe = explode(',',$leavetype->nature_of_employement);
            //pr( $toe);
            }
            else 
            $toe = array('confirm'=>'Confirm','onprobation'=>'On probation');
            
            echo $this->Form->input('nature_of_employement', array('type'=>'select', 'options'=> $toe, 'label'=>false,'class'=>'form-control','multiple'=>'multiple')); 
            ?>
         </div>
        </div>
         <div class="col-md-4">
         <div class="form-group">
            <label>Marital Status</label>
           
            <?php 
            
			$eligible_marital_status = array('married'=>'Married','single'=>'Single','either'=>'Either');
            echo $this->Form->input('eligible_marital_status', array('type'=>'select', 'options'=> $eligible_marital_status, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
        <div class="col-md-4">
         <div class="form-group">
            <label>Eliglible on Notice</label>
           
            <?php 
            $eligible_while_notice = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('eligible_while_notice', array('type'=>'select', 'options'=> $eligible_while_notice, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
        <div class="col-md-4">
         <div class="form-group">
            <label>Min. service  days to avail</label>
           
         
            <?php echo $this->Form->control('service_completion_days',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>
       <div class="col-md-4">
         <div class="form-group">
            <label>Min. service  months to avail</label>
           
            
            <?php echo $this->Form->control('service_completion_months',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>
              
              
              
               
     </div>

 </div>  

 <div class="row">
     <div class="box-header">
              <h3 class="box-title">Leave Validation</h3>
              <hr />
        <div class="col-md-6">
         <div class="form-group">
            <label>Min days</label>
           
         
            <?php echo $this->Form->control('min_Days',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>
       <div class="col-md-6">
         <div class="form-group">
            <label>Max days</label>
           
            
            <?php echo $this->Form->control('max_days',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>

        <div class="col-md-6">
         <div class="form-group">
            <label>Max per year </label>
           
         
            <?php echo $this->Form->control('max_no_of_time_per_year',array('class'=>'form-control','label'=>false)); ?>
         </div>
       </div>
       <div class="col-md-6">
         <div class="form-group">
            <label>Max per tenure</label>
           
            
            <?php echo $this->Form->control('max_no_of_time_per_career',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>
              
              <div class="col-md-4">
         <div class="form-group">
            <label>Leave Balance Check</label>
           
            <?php 
            $leave_bal_check = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('leave_bal_check', array('type'=>'select', 'options'=> $leave_bal_check, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              <div class="col-md-4">
         <div class="form-group">
            <label>Check Roster </label>
           
            <?php 
            $roaster_check = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('roaster_check', array('type'=>'select', 'options'=> $roaster_check, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              <div class="col-md-4">
         <div class="form-group">
            <label>Check Attendance</label>
           
            <?php 
            $attendance_check = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('attendance_check', array('type'=>'select', 'options'=> $attendance_check, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
         <div class="col-md-4">
         <div class="form-group">
            <label>Auto Approval</label>
           
            <?php 
            $auto_approval = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('auto_approval', array('type'=>'select', 'options'=> $auto_approval, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
         <div class="col-md-4">
         <div class="form-group">
            <label>First Level Approval</label>
           
            <?php 
            $first_level_approval = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('first_level_approval', array('type'=>'select', 'options'=> $first_level_approval, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
              
        <div class="col-md-4">
         <div class="form-group">
            <label>First level Esclation</label>
           
            <?php 
            $first_level_esclation = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('first_level_esclation', array('type'=>'select', 'options'=> $first_level_esclation, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
             <div class="col-md-4">
         <div class="form-group">
            <label>First level Role</label>
           
            <?php 
           
            foreach($roles as $role){
         
                $role_list[$role['id']]=$role['title'];
            }
            //pr($role_list);
           // $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('first_level_role', array('type'=>'select', 'options'=> $role_list, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
           
         </div>
        </div>
              <div class="col-md-4">
         <div class="form-group">
            <label>No. of days for first level Esclation</label>
           
            
            <?php echo $this->Form->control('no_of_days_fisrt_lev_esc',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>
              
                 <div class="col-md-4">
         <div class="form-group">
            <label>Second level Esclation</label>
           
            <?php 
            $second_level_esclation = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('second_level_esclation', array('type'=>'select', 'options'=> $second_level_esclation, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
  </div>
  <br /><br />

<?php
   
 /*   // Hard code the user for now.
     echo $this->Form->create($leavetype);

     echo $this->Form->control('name',array('class'=>'form-control'));
     // echo $this->Form->control('status');
     
     $options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' =>1
    );
    
  
     echo $this->Form->radio('status', $options, $attributes);
     
     
     
     
   */  
     
     
     
    echo $this->Form->control('addedon', ['type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
    echo $this->Form->control('addedby', ['type' => 'hidden', 'value' => $this->request->session()->read('empid')]);
    echo $this->Form->control('ip', ['type' => 'hidden', 'value' => $_SERVER['REMOTE_ADDR']]);
    echo $this->Form->control('company_id', ['type' => 'hidden', 'value' => $this->request->session()->read('company_id')]);
    //echo $this->Form->button(__('Add'));
    //echo $this->Form->end();
?>
<div class="row">
<div class="col-md-4">
       <div class="form-group">
   <?php echo $this->Form->button(__('Save'));
    echo $this->Form->end();?>
 </div>
 </div> </div>
  </div>

<br /><br /><br /><br />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        
        $('select').selectpicker();
    });
</script>

<style>

.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active {
    color: #FFF;
}

</style>