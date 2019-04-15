
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eticket $eticket
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $eticket->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $eticket->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Etickets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="etickets form large-9 medium-8 columns content">
    <?= $this->Form->create($eticket) ?>
    <fieldset>
        <legend><?= __('Edit Eticket') ?></legend>
        <?php
            echo $this->Form->control('qr');
            echo $this->Form->control('name');
            echo $this->Form->control('surname');
            echo $this->Form->control('cellphone');
            echo $this->Form->control('confirmation');
            echo $this->Form->control('scanned');
            echo $this->Form->control('type');
            echo $this->Form->control('mesa');
            echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
