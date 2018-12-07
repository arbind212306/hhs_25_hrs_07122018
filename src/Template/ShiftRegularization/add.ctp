<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Add Regularization</h1>
<?php
   
    // Hard code the user for now.
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
        'value' => "1"
    );
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->radio('status', $options, $attributes);
 echo '</div></div></div>';
 
     echo $this->Form->control('addedon', ['type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
     echo $this->Form->control('addedby', ['type' => 'hidden', 'value' => $this->request->session()->read('empid')]);
     echo $this->Form->control('ip', ['type' => 'hidden', 'value' => $_SERVER['REMOTE_ADDR']]);
          echo $this->Form->control('company_id', ['type' => 'hidden', 'value' => $this->request->session()->read('company_id')]);
echo '<div class="row"><div class="col-md-4"><div class="form-group">';
    echo $this->Form->button(__('Add'));
 echo '</div></div></div>';
	
    echo $this->Form->end();
?>
