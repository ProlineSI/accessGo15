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
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('img/go.ico','img/go.ico',['type' => 'icon']);?>
    <?= $this->Html->css([
        'bootstrap/bootstrap.min.css',
        'style.css',
        'alertify/alertify.bootstrap.css',
        'alertify/alertify.core.css',
        'alertify/alertify.default.css'
    ]) ?>
    <?= $this->Html->script(['jquery/jquery.js', 
                             'bootstrap/bootstrap.min.js']) ?>
    <script type="text/javascript">var baseUrl = '<?php echo $this->url->build('/', true); ?>';</script>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class='row'>
        <div class='col-md-2'>
            <?php if (isset($current_user) and  $current_user['role'] == 'admin') : ?>
            <?= $this->element('sidebar_admin') ?>
            <?php endif; ?>
        </div>
        <div class='col-md-10'>
            <?php if (isset($current_user) and $current_user['role'] == 'admin') : ?>
                <?= $this->element('menu_admin') ?>
            <?php endif; ?>
            <div class="main">
                <?= $this->Flash->render() ?>
                <div class="container clearfix">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <?= $this->Html->script([
        'alertify/alertify.js',
        'alertify/alertify.min.js'
    ]); ?>
</body>
</html>
