<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $produtosMercado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $produtosMercado->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Produtos Mercado'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="produtosMercado form large-9 medium-8 columns content">
    <?= $this->Form->create($produtosMercado) ?>
    <fieldset>
        <legend><?= __('Edit Produtos Mercado') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('pubDate');
            echo $this->Form->control('link');
            echo $this->Form->control('content');
            echo $this->Form->control('excerpt');
            echo $this->Form->control('price');
            echo $this->Form->control('ml_category');
            echo $this->Form->control('link_produto');
            echo $this->Form->control('link_download_produto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
