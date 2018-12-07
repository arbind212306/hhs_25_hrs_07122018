<h3>Entitlement Master</h3>
<p><?= $this->Html->link("Add Entitlement", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Created on</th>
        <th>Created By</th>
    </tr>



<?php   

  foreach ($Entitlements as $entitlement): ?>
    <tr>
        <td>
            <?= $this->Html->link($entitlement->name, ['action' => 'edit', '_full' => true, $entitlement->id]); ?>

        </td>
        <td>
          <?php if($entitlement->status=='1') {echo 'Active';}else{echo'InActive';} ?>
        </td>
         <td>
            <?= date('d-m-Y H:i:s',strtotime($entitlement->addedon)); ?>
        </td>
         <td>
            <?= $entitlement->addedby; ?>
        </td>
         <td>

             <?php echo $this->Html->link(
                $this->Html->image('edit.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'edit',$entitlement->id
                ), array('escape' => false)
            ); ?>

            <?php echo $this->Html->link(
                $this->Html->image('delete-sign.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'delete',$entitlement->id
                ), array('escape' => false)
            ); ?>

           <?php /* <?= $this->Html->link('Edit', ['action' => 'edit', $entitlement->id]) ?> / 
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $entitlement->id],
                ['confirm' => 'Are you sure?'])
            ?>*/ ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>