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
            echo $this->Form->control('QueryTitulo', ['title' => 'Busca jQuery', 'label' => 'Titulo (#main-content .secao-comprar)']);
            echo $this->Form->control('QueryDescricaoRapida', ['title' => 'Busca jQuery', 'label' => 'Descricao Rapida (#main-content .secao-comprar)']);
            echo $this->Form->control('QueryDescricaoCompleta', ['title' => 'Busca jQuery', 'label' => 'Descricao Completa (#main-content .secao-comprar)']);
        ?>
        <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
    <?= $this->Form->end() ?>

    <fieldset>
        <?php
            if($isPost)
            {
                echo $this->Form->control('Titulo', ['type' => 'text', 'rows' => '10', 'default' => $titulo]);
                echo $this->Form->control('Descricao rapida', ['type' => 'textarea', 'rows' => '10', 'default' => $descricaoRapida]);
                echo $this->Form->control('Descricao Completa', ['type' => 'textarea', 'rows' => '10', 'default' => $descricaoCompleta]);
        ?>
            <script>
                var textarea = document.getElementById('titulo');
                textarea.focus(); // focus
                textarea.select(); //seleciona o texto
                //tenta copiar para o clipboar porem isso somente funciona para botao
                if(document.execCommand("copy")){
                    document.write('<p>Copiado para o clipboard!</p>');
                }
            </script>
        <?php
            }
        ?>
    </fieldset>
</div>
