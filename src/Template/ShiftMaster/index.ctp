<h3>Shift Master</h3>
<p><?= $this->Html->link("Add Shift", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Shift</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Night Shift</th>
    </tr>


    <?php 

        
        foreach ($shifts as $shift): ?>
    <tr>
        <td>
            <?= $this->Html->link($shift->shift_name, ['action' => 'edit', '_full' => true, $shift->id]); ?>

        </td>
        <td>
            <?= date('H:i',strtotime($shift->start_time)); ?>
        </td>
         <td>
            <?= date('H:i',strtotime($shift->end_time)); ?>
        </td>
         <td>
            <?php if($shift->night_shift=='1') {echo 'Yes';}else{echo'No';} ?>
        </td>
        
        <td>
            
               <?php echo $this->Html->link(
                $this->Html->image('edit.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'edit',$shift->id
                ), array('escape' => false)
            ); ?>

            <?php echo $this->Html->link(
                $this->Html->image('delete-sign.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'delete',$shift->id
                ), array('escape' => false)
            ); ?>
            
            
           <?php /* <?= $this->Html->link('Edit', ['action' => 'edit', $shift->id]) ?>  /
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $shift->id],
                ['confirm' => 'Are you sure?'])
            ?>*/ ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>