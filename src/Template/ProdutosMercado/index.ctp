<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ProdutosMercado[]|\Cake\Collection\CollectionInterface $produtosMercado
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Produtos Mercado'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="produtosMercado index large-9 medium-8 columns content">
    <h3><?= __('Produtos Mercado') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pubDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('excerpt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ml_category') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtosMercado as $produtosMercado): ?>
            <tr>
                <td><?= $this->Number->format($produtosMercado->id) ?></td>
                <td><?= h($produtosMercado->title) ?></td>
                <td><?= h($produtosMercado->pubDate) ?></td>
                <td><?= h($produtosMercado->excerpt) ?></td>
                <td><?= $this->Number->format($produtosMercado->price) ?></td>
                <td><?= h($produtosMercado->ml_category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $produtosMercado->id]) ?>&nbsp;|
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $produtosMercado->id]) ?>&nbsp;|
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $produtosMercado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $produtosMercado->id)]) ?>
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
