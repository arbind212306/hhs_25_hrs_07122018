<h3>Holiday List</h3>


 <?php echo $this->Html->link(
                $this->Html->image('add-row.png',array('height' => '25', 'width' => '25','alt'=>'Add New')),
                array(

                    'action' => 'add'
                ), array('escape' => false)
            ); ?>


<table>
    <tr>
        <th>Holiday Date</th>
        <th>Description</th>
        <th>Status</th>
        <!--th>Created on</th>
        <th>Created By</th-->
    </tr>


    <?php 

        
        foreach ($holidays as $holiday): ?>
    <tr>
        <td>
            <?= $this->Html->link(date('d-M-Y',strtotime($holiday->hdate)), ['action' => 'edit', '_full' => true, $holiday->id]); ?>

        </td>
        
        <td>
          <?php echo $holiday->reason;   ?>
        </td>
        
        <td>
          <?php if($holiday->status=='1') {echo 'Active';}else{echo'InActive';} ?>
        </td>
         <?php /*<td>
            <?= date('d-m-Y H:i:s',strtotime($holiday->addedon)); ?>
        </td>
         <td>
            <?= $holiday->addedby; ?>
        </td>*/?>
         <td>

<?php echo $this->Html->link(
                $this->Html->image('edit.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'edit',$holiday->id
                ), array('escape' => false)
            ); ?>

            <?php echo $this->Html->link(
                $this->Html->image('delete-sign.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'delete',$holiday->id
                ), array('escape' => false)
            ); ?>

           <?php /* <?= $this->Html->link('Edit', ['action' => 'edit', $holiday->id]) ?> / 
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $holiday->id],
                ['confirm' => 'Are you sure?'])
            ?>*/ ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>