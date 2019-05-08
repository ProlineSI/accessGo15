<?= $this->Html->css(['stats.css']) ?>
<?php if(($event->startTime <= new \DateTime()) and ($event->endTime >= new \DateTime())){ ?>
    <div id="stats_container-event">
        <div id="down-container-event">
            <div class="row" id='row-1'>
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS A CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/ingresados.svg', ['id' => 'ingresados-1-svg', 'alt' => 'ingresados', 'class' =>'svg-ingresos-event']);?>	
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_esc_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS D/ CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                        <?= $this->Html->image('svg/stats/ingresados.svg', ['id' => 'ingresados-2-svg', 'alt' => 'ingresados', 'class' =>'svg-ingresos-event']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_esc_desp_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id='row-2'>
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 center">
                            <h4 class='title-big'>ASISTENCIA</h4>
                                <ul id='chart-legend'>
                                    <li><span id='presentes'><?= $porcentaje_presentes ?>%</span> - Presentes</li>
                                    <li><span id='ausentes'><?= $porcentaje_ausentes ?>%</span> - Ausentes</li>
                                </ul>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 center">
                            <div class="row">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 padding-0">
                    <div class="row card-esp">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL INGRESADOS</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row">
                                <div class="numero"><?= $total_ingresados ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row card-esp">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL PENDIENTES</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row">
                                <div class="numero"><?= $total_pendientes ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="down-container" class='down-container-none'>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INVITADOS A CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/cena.svg', ['id' => 'cena-svg', 'alt' => 'cena', 'class' =>'svg-princip']);?>	
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_inv_cena_tot ?></div>
                            </div>
                            <div class="row">
                                <div class="sub">CONFIRMADOS: <span><?= $etickets_inv_cena_confirm_tot ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INVITADOS D/ CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/dcena.svg', ['id' => 'dcenasvg', 'alt' => 'dcena', 'class' =>'svg-princip']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_desp_cena_tot ?></div>
                            </div>
                            <div class="row">
                                <div class="sub">CONFIRMADOS: <span><?= $etickets_inv_desp_cena_confirm_tot ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS PENDIENTES A CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/pendientes.svg', ['id' => 'pendientes-1-svg', 'alt' => 'pendientes', 'class' =>'svg']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_falt_esc_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS PENDIENTES D/ CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/pendientes.svg', ['id' => 'pendientes-2-svg', 'alt' => 'pendientes', 'class' =>'svg']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_falt_esc_desp_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL DE INVITADOS</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row center">
                                <div class="numero"><?= $total_invitados ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL CONFIRMADOS</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row">
                                <div class="numero"><?= $total_confirmados ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else { ?>
    <div id="stats_container">
        <div id="up-container">
            <div class="row" id='row-1'>
                <div class="col-md-4 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INVITADOS A CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/cena.svg', ['id' => 'cena-svg', 'alt' => 'cena', 'class' =>'svg-princip']);?>	
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_inv_cena_tot ?></div>
                            </div>
                            <div class="row">
                                <div class="sub">CONFIRMADOS: <span><?= $etickets_inv_cena_confirm_tot ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS A CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/ingresados.svg', ['id' => 'ingresados-1-svg', 'alt' => 'ingresados', 'class' =>'svg-ingresos']);?>	
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_esc_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS PENDIENTES A CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/pendientes.svg', ['id' => 'pendientes-1-svg', 'alt' => 'pendientes', 'class' =>'svg']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_falt_esc_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id='row-2'>
                <div class="col-md-4 col-sm-12 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INVITADOS D/ CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/dcena.svg', ['id' => 'dcenasvg', 'alt' => 'dcena', 'class' =>'svg-princip']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_desp_cena_tot ?></div>
                            </div>
                            <div class="row">
                                <div class="sub">CONFIRMADOS: <span><?= $etickets_inv_desp_cena_confirm_tot ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS D/ CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                        <?= $this->Html->image('svg/stats/ingresados.svg', ['id' => 'ingresados-2-svg', 'alt' => 'ingresados', 'class' =>'svg-ingresos']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_esc_desp_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <h4 class='title'>INGRESOS PENDIENTES D/ CENA</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 svg-container">
                            <?= $this->Html->image('svg/stats/pendientes.svg', ['id' => 'pendientes-2-svg', 'alt' => 'pendientes', 'class' =>'svg']);?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row center">
                                <div class="numero"><?= $etickets_falt_esc_desp_cena_tot ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="down-container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL DE INVITADOS</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row center">
                                <div class="numero"><?= $total_invitados ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 center">
                            <h4 class='title-big'>ASISTENCIA</h4>
                                <ul id='chart-legend'>
                                    <li><span id='presentes'><?= $porcentaje_presentes ?>%</span> - Presentes</li>
                                    <li><span id='ausentes'><?= $porcentaje_ausentes ?>%</span> - Ausentes</li>
                                </ul>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 center">
                            <div class="row">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 card">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL CONFIRMADOS</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row">
                                <div class="numero"><?= $total_confirmados ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 padding-0">
                    <div class="row card-esp">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL INGRESADOS</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row">
                                <div class="numero"><?= $total_ingresados ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row card-esp">
                        <div class="col-md-8 col-sm-8 col-xs-8 center">
                            <h4 class='title-big'>TOTAL PENDIENTES</h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 center">
                            <div class="row">
                                <div class="numero"><?= $total_pendientes ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var porcentaje = <?= $total_ingresados ?>;
    var porcentaje_left = <?= $total_pendientes ?>;
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Asistencia', 'Inivitados Ingresados'],
            ['Presentes', porcentaje],
            ['Ausentes', porcentaje_left]
        ]);

        var options = {
            legend: 'none',
            colors: ['#00EABB', '#A8A8BC'],
            fontSize: 14
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      var statsOpen = false;
      var showStats = function(){
        if(statsOpen == false){
            if($(window).width() <= 767 && $(window).width() > 460){
                $('.down-container-none').slideDown(100);
                $('#stats_container-event').css({'margin-top' : '-100px'})
                statsOpen = true;
            }else if ($(window).width() <= 460 && $(window).width() > 360){
                $('.down-container-none').slideDown(100);
                $('#stats_container-event').css({'margin-top' : '-200px'})
                statsOpen = true;
            }else if ($(window).width() <= 360){
                $('#stats_container-event').css({'margin-top' : '-300px'})
                $('.down-container-none').slideDown(100);
                statsOpen = true;
            }else{
                $('.down-container-none').slideDown(100);
                statsOpen = true;
            }
        }else{
            if($(window).width() <= 767 && $(window).width() > 460){
                $('.down-container-none').slideUp(100);
                $('#stats_container-event').css({'margin-top' : '10%'})
                statsOpen = false;
            }else if ($(window).width() <= 460 && $(window).width() > 360){
                $('.down-container-none').slideUp(100);
                $('#stats_container-event').css({'margin-top' : '-50px'})
                statsOpen = false;
            }else if ($(window).width() <= 360){
                $('#stats_container-event').css({'margin-top' : '-80px'})
                $('.down-container-none').slideUp(100);
                statsOpen = false;
            }else{
                $('.down-container-none').slideUp(100);
                statsOpen = false;
            }
        }
      }
</script>
