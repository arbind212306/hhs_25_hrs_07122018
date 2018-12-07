<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit[]|\Cake\Collection\CollectionInterface $units
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar" style="padding: 2%;">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Unit'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="units index large-9 medium-8 columns content" style="padding: 2%;">
    <h3><?= __('Units') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($units as $unit): ?>
                <tr>
                    <td><?= $this->Number->format($unit->id) ?></td>
                    <td><?= h($unit->title) ?></td>
                    <td><?= $this->Number->format($unit->company_id) ?></td>
                    <td><?= $this->Number->format($unit->status) ?></td>
                    <td><?= h($unit->created) ?></td>
                    <td><?= h($unit->modified) ?></td>
                    <td class="actions">
                        <!--?= $this->Html->link(__('View'), ['action' => 'view', $unit->id]) ?-->
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $unit->id]) ?>
                        <!--?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?-->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
