<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="produtosMercado form large-12 columns content">
    <?= $this->Form->create(null, ['url' => ['controller' => 'ProdutosMercado', 'action' => 'pesquisar']]) ?>
    <fieldset>
        <legend><?= __('Pesquisar Produto') ?></legend>
        <?php
        echo $this->Form->control('titulo', ['label' => 'Pesquisar Produto', 'placeholder' => 'Pesquisar Produto', 'autofocus' => true, 'required' => true, 'minLength' => 3]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php
if ($hasSearch)
{
    ?>
    <div class="produtosMercado index large-12 columns content">
        <h3><?= __('Produtos Mercado') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtosMercado as $produtosMercado): ?>
                    <tr style="padding: 0;">
                        <td><?= $this->Html->link($this->Number->format($produtosMercado->id), ['action' => 'view', $produtosMercado->id], ['targe' => '_blank', 'style' => 'padding: 12px;display:block;']); ?></td>
                        <td><?= $this->Html->link(h($produtosMercado->title), ['action' => 'view', $produtosMercado->id], ['targe' => '_blank', 'style' => 'padding: 12px;display:block;']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>