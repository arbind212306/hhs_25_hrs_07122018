<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar"  style="padding: 2%;">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="units form large-9 medium-8 columns content"  style="padding: 2%;">
    <?= $this->Form->create($unit) ?>
    <fieldset>
        <legend><?= __('Edit Unit') ?></legend>
        <?php
            echo $this->Form->control('title',['class'=>'form-control']);
            echo $this->Form->control('company_id',['class'=>'form-control']);
            echo $this->Form->control('status',['class'=>'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit',['class'=>'form-control'])) ?>
    <?= $this->Form->end() ?>
</div>
