<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h2>Edit Leave Type</h2>
<?php

   $options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' => $leavetype->status
    );

    
    $options = array(
        '1' => 'Yes',
        '0' => 'No'
    );

    $eattributes = array(
        'legend' => false,
        'value' => $leavetype->encashment,
        'default' => '1'
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
              <h3 class="box-title">Combine with Leave type</h3>
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
            <script>
                $(document).ready(function(){

                    $('#allowed-with-leave-type').selectpicker('val',[<?php echo $leavetype->allowed_with_leave_type; ?>]);
                });
            </script>
         </div>
        </div>
      <?php /* <div class="col-md-6">
         <div class="form-group">
            <label>Leave type can't be combine with :-</label>
           
           <?php 
           
             foreach($leavetypes as $le){
         
                $Leavetyes_list[$le['id']]=$le['name'];
            }
            //$gender = array('male'=>'Male','female'=>'Female','either'=>'Either');
            echo $this->Form->input('allowed_with_leave_type', array('type'=>'select', 'options'=> $Leavetyes_list, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control','multiple'=>'multiple')); 
            ?>
         </div>
        </div> */ ?>

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
            
             foreach($Natureofemployment_cat as $na){
         
                $na_list[$na['id']]=$na['name'];
            }
         
            echo $this->Form->input('nature_of_employement', array('type'=>'select', 'options'=> $na_list, 'label'=>false,'class'=>'form-control','multiple'=>'multiple')); 
            ?>
            <script>
                $(document).ready(function(){

                    $('#nature-of-employement').selectpicker('val',[<?php echo $leavetype->nature_of_employement; ?>]);
                });
            </script>
         </div>
        </div>
         <div class="col-md-4">
         <div class="form-group">
            <label>Marital Status</label>
           
            <?php 
            $toe = array('married'=>'Married','single'=>'Single','either'=>'Either');
            echo $this->Form->input('eligible_marital_status', array('type'=>'select', 'options'=> $toe, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
        <div class="col-md-4">
         <div class="form-group">
            <label>Eliglible on Notice</label>
           
            <?php 
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('eligible_while_notice', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
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

               <div class="col-md-4">
         <div class="form-group">
            <label>Max per month </label>
           
         
            <?php echo $this->Form->control('max_per_month',array('class'=>'form-control','label'=>false)); ?>
         </div>
       </div>
        <div class="col-md-4">
         <div class="form-group">
            <label>Max per year </label>
           
         
            <?php echo $this->Form->control('max_no_of_time_per_year',array('class'=>'form-control','label'=>false)); ?>
         </div>
       </div>
       <div class="col-md-4">
         <div class="form-group">
            <label>Max per tenure</label>
           
            
            <?php echo $this->Form->control('max_no_of_time_per_career',array('class'=>'form-control','label'=>false)); ?>
         </div>
        </div>
              
              <div class="col-md-4">
         <div class="form-group">
            <label>Leave Balance Check</label>
           
            <?php 
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('leave_bal_check', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              <div class="col-md-4">
         <div class="form-group">
            <label>Check Roster </label>
           
            <?php 
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('roaster_check', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              <div class="col-md-4">
         <div class="form-group">
            <label>Check Attendance</label>
           
            <?php 
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('attendance_check', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
         <div class="col-md-4">
         <div class="form-group">
            <label>Auto Approval</label>
           
            <?php 
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('auto_approval', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
         <div class="col-md-4">
         <div class="form-group">
            <label>First Level Approval</label>
           
            <?php 
            
            
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('first_level_approval', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
              
              
        <div class="col-md-4">
         <div class="form-group">
            <label>First level Esclation</label>
           
            <?php 
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('first_level_esclation', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
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
            $gender = array('1'=>'Yes','0'=>'No');
            echo $this->Form->input('second_level_esclation', array('type'=>'select', 'options'=> $gender, 'label'=>false, 'empty'=>'--Select--','class'=>'form-control')); 
            ?>
         </div>
        </div>
  </div>
 </div>
   <div class="row">
       <div class="col-md-4">
       <div class="form-group">
        <?php echo $this->Form->button(__('Save'));
         echo $this->Form->end();?>
     </div> 
	   </div> 
   </div>
       <br /><br /><br /><br /><br /><br />
 




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
