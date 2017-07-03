<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="row user">
    <?= $this->Flash->render('auth') ?>
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="card card-signup">
            <?= $this->Form->create() ?>
                <div class="header header-warning text-center">
                    <h4 class="card-title">Log in</h4>
                    <div class="social-line">
                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
                <p class="description text-center"><?= __('Por favor digite seu email e senha') ?></p>
                <div class="content">

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <?= $this->Form->control('email', [
                            'class' => 'form-control',
                            'placeholder' => 'Email...',
                            'autofocus' => true,
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <?= $this->Form->control('senha', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Senha...',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
                <div class="footer text-center">
                    <?= $this->Form->button(__('Login'), [
                        'class' => 'btn btn-success btn-wd btn-lg'
                    ]); ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>