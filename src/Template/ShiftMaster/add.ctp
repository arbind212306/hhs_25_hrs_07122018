<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h3>Add Shift</h3>
<?php



   
    // Hard code the user for now.
     echo $this->Form->create($shift);
    
	echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->control('shift_name',array('class'=>'form-control'));
	 echo '</div></div></div>';
	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->control('start_time',array('class'=>'form-control'));
	 echo '</div></div></div>';
	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->control('end_time',array('class'=>'form-control'));
	 echo '</div></div></div>';
     echo $this->Form->control('company_id', ['type' => 'hidden', 'value' => $this->request->session()->read('company_id')]);
     echo $this->Form->control('addedon', ['type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
     echo $this->Form->control('addedby', ['type' => 'hidden', 'value' => $this->request->session()->read('empid')]);
     echo $this->Form->control('ip', ['type' => 'hidden', 'value' => $_SERVER['REMOTE_ADDR']]);
     foreach($categorys as $cat){
         
         $arrCategory[$cat['id']]=$cat['name'];
     }
     
     foreach($regularization as $reg){
         
         $arrregularization[$reg['id']]=$reg['name'];
     }
     
    // $arrCategory=array(1=>"Car",2=>"Boat",3=>"Bike");
     //$arrregularization=array(1=>"Car",2=>"Boat",3=>"Bike");
     
	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('shift_category', array('type'=>'select', 'options'=> $arrCategory, 'label'=>'Shift Category', 'empty'=>'Select Category','class'=>'form-control'));
	 echo '</div></div></div>';
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';	 
        echo $this->Form->input('regularization', array('type'=>'select', 'options'=>$arrregularization, 'label'=>'Shift Regularization', 'empty'=>'Select regularization','class'=>'form-control'));   
echo '</div></div></div>';		
     
// echo $this->Form->control('night_shift');
     
     
     /*$options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' => "1"
    );*/

     //echo $this->Form->radio('night_shift', $options, $attributes);
     
     
    $night_shift= [['value'=>'0','text'=>'No'],['value'=>'1','text'=>'Yes']]; 
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
    echo $this->Form->input('night_shift', array(
                      'options' => $night_shift,
                      'type' => 'radio'
                      ));
    echo '</div></div></div>';
     echo '<div class="row"><div class="col-md-4"><div class="form-group">';
    echo $this->Form->button(__('Add'));
	echo '</div></div></div>';	
    echo $this->Form->end();
?>
