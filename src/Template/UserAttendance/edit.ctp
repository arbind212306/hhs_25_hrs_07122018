<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit shift</h1>
<?php
     echo $this->Form->create($shift);
     echo $this->Form->control('id', ['type' => 'hidden']);
     echo '<div class="form-group">'.$this->Form->control('shift_name');
     echo '<div class="form-group">'.$this->Form->control('start_time');
     echo '<div class="form-group">'.$this->Form->control('end_time');
    // echo $this->Form->control('night_shift');
       
    
    $night_shift= [['value'=>'0','text'=>'No'],['value'=>'1','text'=>'Yes']]; 

    echo $this->Form->input('night_shift', array(
                      'options' => $night_shift,
                      'type' => 'radio'
                      ));
 
    
    echo $this->Form->button(__('Save'));
    echo $this->Form->end();
?>
