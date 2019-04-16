<nav class="navbar navbar-inverse nav-users">
    <div class="container">
        <div class='row'>
            <div class="col-md-1 col-sm-1 col-xs-1">
                <a href='#' type="button" class="dropdown-toggle menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-right menu-btn "></span></a>
            </div>
            <div class="navbar-header col-md-8 col-sm-8 col-xs-9">
                <h1 class='navbar-title'>DASHBOARD</h1>
            </div>
            <div id='div-etickets' class="col-md-1 col-sm-1 col-xs-0">
                <a href='#' type="button" class="dropdown-toggle menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <?= $this->Html->image('./svg/E-tickets.svg', ['class' => 'e-tickets', 'alt' => 'E-ticket']);?><!--<span class='not-num' id='not-eticket'>10</span>-->
                    <span id='badge-menu' class="badge">0</span>
                </a>
                <ul class="dropdown-menu">
                    <li class='divider'></li>
                </ul>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
                <a href='#' type="button" class="dropdown-toggle menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->Html->image('./svg/Notificaciones.svg', ['class' => 'notification', 'alt' => 'Notification']);?><!--<span class='not-num' id='not-gral'>10</span>--></a>
                <ul class="dropdown-menu">
                    <li class='divider'></li>
                </ul>
            </div>
            <div class='nav navbar-nav toggle-menu col-md-1 col-sm-1 col-xs-1'>
                    <?php if (isset($current_user)) : ?>
                    <ul>
                        <li>
                            <a id='cerrarSesion' title='Cerrar Sesión' href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>"><span class='glyphicon glyphicon-log-out log-out'></span></a>
                        </li>
                    </ul>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div id='fill-event'><?php if(isset($title)){echo $title;} if(isset($actions)){echo $actions;}?>
</div>
