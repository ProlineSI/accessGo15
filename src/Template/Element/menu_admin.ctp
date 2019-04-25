<nav class="navbar navbar-inverse nav-users">
    <div class="container">
        <div class='row'>
            <div class="col-md-1 col-sm-1 col-xs-1">
                <a href='#' type="button" class="dropdown-toggle menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-right menu-btn "></span></a>
            </div>
            <div class="navbar-header col-md-10 col-sm-10 col-xs-10">
                <h1 class='navbar-title'></h1>
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
