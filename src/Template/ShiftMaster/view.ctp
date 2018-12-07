<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<h1><?= h($shift->shift_name) ?></h1>
<p><?= date('H:i',strtotime($shift->start_time)); ?></p>
<p><?= date('H:i',strtotime($shift->end_time)); ?></p>

<p><?= $this->Html->link('Edit', ['action' => 'edit', $shift->id]) ?></p>