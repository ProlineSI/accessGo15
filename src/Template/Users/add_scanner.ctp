<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Añadir')) ?>
    <?= $this->Form->end() ?>
</div>
