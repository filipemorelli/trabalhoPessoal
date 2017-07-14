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
    <?= $this->Form->create( null, ['url' => ['controller' => 'Sites', 'action' => 'index']]) ?>
    <fieldset>
        <legend><?= __('Sites') ?></legend>
        <?php
            echo $this->Form->control('Url', ['type' => 'url', 'required' => true]);
            echo $this->Form->control('Query');
        ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
    <?= $this->Form->end() ?>

    <fieldset>
        <?php
            if(isset($descricaoHtml))
            {
                echo $this->Form->control('Descricao Site', ['type' => 'textarea', 'default' => $descricaoHtml]);
                //echo '<textarea>' . $descricaoHtml . '</textarea>';
            }
        ?>
    </fieldset>
</div>
