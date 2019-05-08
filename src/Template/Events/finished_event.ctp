<?= $this->Html->css(['finished_event.css']) ?>
<div id="error" class='col-md-12 col-sm-12 col-xs-12'>
    <h1>Evento de <?= $event->name?> terminado, no puede ingresar a esta URL.</h1>
    <a  href="https://accessgo.com.ar/" target="_blank" rel="noopener noreferrer" title='accessGo'><?= $this->Html->image('logo.png', ['id' => 'logo-1', 'alt' => 'AccessGo','height' => 45, 'width' => 180]);?></a>
</div>