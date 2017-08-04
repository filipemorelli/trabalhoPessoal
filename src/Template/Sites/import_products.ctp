<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create( null, ['url' => ['controller' => 'Sites', 'action' => 'importProducts'], 'type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Sites') ?></legend>
        <?php
            echo $this->Form->control('upload', ['type' => 'file', 'required' => true]);
            echo $this->Form->control('separation', ['title' => 'Separação por ,;\t', 'label' => 'Tipo de separacao','required' => true, 'default' => ';']);
        ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
    <?= $this->Form->end() ?>

</div>
