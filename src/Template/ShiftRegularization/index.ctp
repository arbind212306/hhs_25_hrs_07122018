<h3>Regularization Master</h3>
<p><?= $this->Html->link("Add Category", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Created on</th>
        <th>Created By</th>
    </tr>


    <?php 

        
        foreach ($shiftRegularizations as $regularization): ?>
    <tr>
        <td>
            <?= $this->Html->link($regularization->name, ['action' => 'edit', '_full' => true, $regularization->id]); ?>

        </td>
        <td>
      <?php if($regularization->status=='1') {echo 'Active';}else{echo'InActive';} ?>
        </td>
         <td>
            <?= date('d-m-Y H:i:s',strtotime($regularization->addedon)); ?>
        </td>
         <td>
            <?= $regularization->addedby; ?>
        </td>
         <td>
                <?php echo $this->Html->link(
                $this->Html->image('edit.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'edit',$regularization->id
                ), array('escape' => false)
            ); ?>

            <?php echo $this->Html->link(
                $this->Html->image('delete-sign.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'delete',$regularization->id
                ), array('escape' => false)
            ); ?>
            
            <?php /*<?= $this->Html->link('Edit', ['action' => 'edit', $regularization->id]) ?>  /
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $regularization->id],
                ['confirm' => 'Are you sure?'])
            ?> */ ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>