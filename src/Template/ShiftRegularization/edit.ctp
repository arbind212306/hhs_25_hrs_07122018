<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit Regularization</h1>
<?php
    

    echo $this->Form->create($shiftregularizations);
	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
      echo $this->Form->control('name',array('class'=>'form-control'));
	   echo '</div></div></div>';
    //echo $this->Form->control('status');
     $options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' => $shiftregularizations->status,
        'default' => '1'
    );
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->radio('status', $options, $attributes); 
	   echo '</div></div></div>'; 
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
    echo $this->Form->button(__('Save'));
	   echo '</div></div></div>';
    echo $this->Form->end();
?>
