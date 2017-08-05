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
    <?= $this->Form->create(null, ['url' => ['controller' => 'Sites', 'action' => 'mercadoLivre']]) ?>
    <fieldset>
        <legend><?= __('Sites') ?></legend>
        <?php
        echo $this->Form->control('Url', ['type' => 'url', 'required' => true]);
        echo $this->Form->control('QueryTitulo', ['title' => 'Busca jQuery', 'label' => 'Titulo (#main-content .secao-comprar)', 'required' => true]);
        echo $this->Form->control('QueryDescricaoCompleta', ['title' => 'Busca jQuery', 'label' => 'Descricao Completa (#main-content .secao-comprar)', 'required' => true]);
        echo $this->Form->control('QueryImagem', ['title' => 'Busca jQuery', 'label' => 'Query Imagem', 'required' => true]);
        echo $this->Form->control('price', ['type' => 'number', 'label' => 'Preço produto para vender', 'default' => '5.00', 'required' => true, 'step' => '0.01']);
        echo $this->Form->control('ml_category', ['type' => 'text', 'label' => 'ID Categoria produto* (mercadolivre)', 'default' => 'MLB9595', 'required' => true]);
        echo $this->Form->control('link_produto', ['type' => 'url', 'label' => 'Link url produto']);
        echo $this->Form->control('link_download_produto', ['type' => 'url', 'label' => 'Link do download do produto', 'required' => true]);
        echo $this->Form->control('lang', ['type' => 'select', 'label' => 'Idioma', 'title' => 'selecione o idioma', 'required' => true, 'empty' => 'Escolha o idioma', 'options' => ['eng', 'pt']]);
        ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
    <?= $this->Form->end() ?>

</div>
