<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ProdutosMercado $produtosMercado
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Produtos Mercado'), ['action' => 'edit', $produtosMercado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Produtos Mercado'), ['action' => 'delete', $produtosMercado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $produtosMercado->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Produtos Mercado'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Produtos Mercado'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="produtosMercado view large-9 medium-8 columns content">
    <h3><?= h($produtosMercado->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($produtosMercado->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Excerpt') ?></th>
            <td><?= h($produtosMercado->excerpt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ml Category') ?></th>
            <td><?= h($produtosMercado->ml_category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($produtosMercado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($produtosMercado->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PubDate') ?></th>
            <td><?= h($produtosMercado->pubDate) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Link') ?></h4>
        <?= $this->Text->autoParagraph(h($produtosMercado->link)); ?>
    </div>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($produtosMercado->content)); ?>
    </div>
    <div class="row">
        <h4><?= __('Link Produto') ?></h4>
        <?= $this->Text->autoParagraph(h($produtosMercado->link_produto)); ?>
    </div>
    <div class="row">
        <h4><?= __('Link Download Produto') ?></h4>
        <?= $this->Text->autoParagraph(h($produtosMercado->link_download_produto)); ?>
    </div>
</div>
