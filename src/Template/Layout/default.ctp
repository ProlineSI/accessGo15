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
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        'style.css',
        'alertify/alertify.bootstrap.css',
        'alertify/alertify.core.css',
        'alertify/alertify.default.css',
        'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css'
        //'datatables/dataTables.bootstrap4.min.css',
        //'datatables/responsive.bootstrap4.min.css',
    ]) ?>
    
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script(['jquery/jquery.js', 
                             'bootstrap/bootstrap.min.js',
                             'alertify/alertify.js',
                             'alertify/alertify.min.js',
                             'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                             'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js'
                             //'datatable/dataTables.bootstrap4.min.js',
                             //'datatable/dataTables.responsive.min.js',
                             //'datatable/responsive.bootstrap4.min.js'
                             ]) ?>
    <script type="text/javascript">var baseUrl = '<?php echo $this->url->build('/', true); ?>';</script>
</head>
<body>
    
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    
</body>
</html>
