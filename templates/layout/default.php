<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'all.min', 'main']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link('Sneakers', ['controller' => 'Sneakers', 'action' => 'index'])//, ['escape' => false, 'class' => ($this->templatePath == 'Brands' && $this->template == 'index') ? 'active']) ?>
           
            <?= $this->Html->link('Marques', ['controller' => 'Brands', 'action' => 'index'])//, ['escape' => false, 'class' => ($this->templatePath == 'Brands' && $this->template == 'index') ? 'active']) ?>

            <?= $this->Html->link('Actualités', ['controller' => 'Articles', 'action' => 'index'])//, ['escape' => false, 'class' => ($this->templatePath == 'Articles' && $this->template == 'index') ? 'active']) ?>

            <?php if($this->request->getAttribute('identity') == null) : ?>

                <?= $this->Html->link('Se connecter', ['controller' => 'Users', 'action' => 'login'])//, ['escape' => false, 'class' => ($this->templatePath == 'Users' && $this->template == 'login') ? 'active']) ?>

                <?= $this->Html->link('S\'inscrire', ['controller' => 'Users', 'action' => 'signup'])//, ['escape' => false, 'class' => ($this->templatePath == 'Users' && $this->template == 'signup') ? 'active']) ?>

            <?php else : ?>

                <?= $this->Html->link('Se déconnecter', ['controller' => 'Users', 'action' => 'logout']) ?>

            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>