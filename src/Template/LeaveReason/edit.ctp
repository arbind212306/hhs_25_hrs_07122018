<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h3>Edit Reason</h3>
<?php
    echo $this->Form->create($leavereason);
	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
      echo $this->Form->control('name',array('class'=>'form-control'));
	   echo '</div></div></div>';
    $options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' => $leavereason->status,
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
