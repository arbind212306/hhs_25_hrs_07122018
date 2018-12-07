<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h3>Edit shift</h3>
<?php
     echo $this->Form->create($shift);
     echo $this->Form->control('id', ['type' => 'hidden']);
	 
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->control('shift_name',array('class'=>'form-control'));
	 echo '</div></div></div>';	
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->control('start_time',array('class'=>'form-control'));
	 echo '</div></div></div>';	
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->control('end_time',array('class'=>'form-control'));
	 echo '</div></div></div>';	
    // echo $this->Form->control('night_shift');
       
       foreach($categorys as $cat){
         
         $arrCategory[$cat['id']]=$cat['name'];
     }
     
     foreach($regularization as $reg){
         
         $arrregularization[$reg['id']]=$reg['name'];
     }
     
    // $arrCategory=array(1=>"Car",2=>"Boat",3=>"Bike");
     //$arrregularization=array(1=>"Car",2=>"Boat",3=>"Bike");
     
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('shift_category', array('type'=>'select', 'options'=> $arrCategory, 'label'=>'shift category', 'empty'=>'Select Category','class'=>'form-control')); 
	 echo '</div></div></div>';	
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('regularization', array('type'=>'select', 'options'=>$arrregularization, 'label'=>'Regularization', 'empty'=>'Select regularization','class'=>'form-control'));  
echo '</div></div></div>';		 
     
     
     
    $night_shift= [['value'=>'0','text'=>'No'],['value'=>'1','text'=>'Yes']]; 

	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
    echo $this->Form->input('night_shift', array(
                      'options' => $night_shift,
                      'type' => 'radio'
                      ));
    echo '</div></div></div>';	
     echo '<div class="row"><div class="col-md-4"><div class="form-group">';
    echo $this->Form->button(__('Save'));
	echo '</div></div></div>';	
    echo $this->Form->end();
?>
