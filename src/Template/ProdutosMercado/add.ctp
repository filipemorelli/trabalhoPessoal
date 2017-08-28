<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Produtos Mercado'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="produtosMercado form large-9 medium-8 columns content">
    <?= $this->Form->create($produtosMercado) ?>
    <fieldset>
        <legend><?= __('Add Produtos Mercado') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('pubDate');
            echo $this->Form->control('link');
            echo $this->Form->control('content');
            echo $this->Form->control('excerpt');
            echo $this->Form->control('price');
            echo $this->Form->control('ml_category');
            echo $this->Form->control('urlImagem');
            echo $this->Form->control('link_download_produto');
            echo $this->Form->control('tag');
            echo $this->Form->control('name_product');
            echo $this->Form->control('ext');
            echo $this->Form->control('url_download');
            echo $this->Form->control('ativo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
