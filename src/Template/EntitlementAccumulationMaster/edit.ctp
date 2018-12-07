<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit shift Category</h1>
<?php
    echo $this->Form->create($shiftcategory);
      echo $this->Form->control('name',array('class'=>'form-control'));
    $options = array(
        '1' => 'Active',
        '0' => 'Inactive'
    );

    $attributes = array(
        'legend' => false,
        'value' => $shiftcategory->status,
        'default' => '1'
    );

     echo $this->Form->radio('status', $options, $attributes);  
    echo $this->Form->button(__('Save'));
    echo $this->Form->end();
?>
