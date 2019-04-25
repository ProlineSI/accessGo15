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

if (isset($current_user) || $this->getRequest()->getSession()->read('Config.invitado') == 'invitado') { ?>
    <?php if(isset($eyelash_title)){$cakeDescription = $eyelash_title; }else{$cakeDescription = 'AccessGo';}?>
    <?php }else{ 
        $cakeDescription = 'Inicio de Sesión';
    } ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('img/go.ico','img/go.ico',['type' => 'icon']);?>
    <?= $this->Html->css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        'style.css',
        'alertify/alertify.bootstrap.css',
        'alertify/alertify.core.css',
        'alertify/alertify.default.css',
        'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css',
        'https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css',
        'https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css'
        //'datatables/dataTables.bootstrap4.min.css',
        //'datatables/responsive.bootstrap4.min.css',
    ]) ?>
    <?php $font_url = WWW_ROOT . DS . 'font' . DS . 'poppins' . DS ?>
    <link href="<?= $font_url ?>Poppins-Regular.otf" rel="stylesheet">
    <link href="<?= $font_url ?>Poppins-ExtraBold.otf" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script(['jquery/jquery.js', 
                             'bootstrap/bootstrap.min.js',
                             'alertify/alertify.js',
                             'alertify/alertify.min.js',
                             'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                             'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js',
                             'https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js',
                             'https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js',
                             'https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js',
                             //'datatable/dataTables.bootstrap4.min.js',
                             //'datatable/dataTables.responsive.min.js',
                             //'datatable/responsive.bootstrap4.min.js'
                             ]) ?>
    <script type="text/javascript">var baseUrl = '<?php echo $this->url->build('/', true); ?>';</script>
</head>
<body>
    <div class='row'>
        <div class='col-md-2'>
            <?php if (isset($current_user) and  $current_user['role'] == 'admin'){
                        echo $this->element('sidebar_admin');
                    } ?>
        </div>
        <div class='col-md-10'>
            <?php if (isset($current_user) and  $current_user['role'] == 'admin'){
                        echo $this->element('menu_admin');
                    } ?>
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
    
</body>
</html>
