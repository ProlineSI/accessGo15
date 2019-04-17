$(function(){
    var sideMenuFunctions = {};
    (function(app){
        app.init = function(){
            //Muestra el sidebar solo cuando es responsive
            if($(window).width() <= 991.6){
                if($(window).width() <= 740){
                    $('.menu-btn').on('click', function(){
                        $('nav.sidebar.navbar').animate({left: '2%'}, 250);
                    });
                }else {
                    $('.menu-btn').on('click', function(){
                        $('nav.sidebar.navbar').animate({left: '1.5%'}, 250);
                    });
                }
                $('#close-sidebar').on('click', function(){
                    $('nav.sidebar.navbar').animate({left: '-65%'}, 250);
                });
            };
            //Animacion de los links del sidebar
            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(400);
                if ($(this).parent().hasClass("active")){
                  $(".sidebar-dropdown").removeClass("active");
                  $(this).parent().removeClass("active");
                  height = $(this).next().children('ul.forAnimate').height();
                  $(this).parent().next().css({'margin-top':'0'});
                  $(this).children().next().css({'transform':'rotateZ(0deg)',  
                                                        WebkitTransition : 'all 0.550s',
                                                        MozTransition    : 'all 0.550s',
                                                        MsTransition     : 'all 0.550s',
                                                        OTransition      : 'all 0.550s', 
                                                        'transition': 'all 0.550s'})
                    if($(window).height() <= 750){
                        $('nav.sidebar.navbar').css({'height':'97vh',  
                                                            WebkitTransition : 'all 0.550s',
                                                            MozTransition    : 'all 0.550s',
                                                            MsTransition     : 'all 0.550s',
                                                            OTransition      : 'all 0.550s', 
                                                            'transition': 'all 0.550s'
                        });
                    }
                }else {
                    var height = 0;
                    if($('#sidebar-dropdown-invitados').hasClass('active')){
                        $("#sidebar-dropdown-invitados").removeClass("active");
                        height = $('#sidebar-dropdown-invitados').children().next().children().height();
                        $('#sidebar-dropdown-invitados').next().css({'margin-top':'0'});
                        console.log(height);
                        $('#sidebar-dropdown-invitados').children().children().next().css({'transform':'rotateZ(0deg)',  
                                                                                    WebkitTransition : 'all 0.550s',
                                                                                    MozTransition    : 'all 0.550s',
                                                                                    MsTransition     : 'all 0.550s',
                                                                                    OTransition      : 'all 0.550s', 
                                                                                    'transition': 'all 0.550s'})
                        if($(window).height() <= 750){
                            $('nav.sidebar.navbar').css({'height':'97vh',  
                                                                WebkitTransition : 'all 0.550s',
                                                                MozTransition    : 'all 0.550s',
                                                                MsTransition     : 'all 0.550s',
                                                                OTransition      : 'all 0.550s', 
                                                                'transition': 'all 0.550s'
                            });
                        }
                    }else if($('#sidebar-dropdown-ingresados').hasClass('active')){
                        $("#sidebar-dropdown-ingresados").removeClass("active");
                        height = $('#sidebar-dropdown-ingresados').children().next().children().height();
                        $('#sidebar-dropdown-ingresados').next().css({'margin-top':'0'});
                        $('#sidebar-dropdown-ingresados').children().children().next().css({'transform':'rotateZ(0deg)',  
                                                                                    WebkitTransition : 'all 0.550s',
                                                                                    MozTransition    : 'all 0.550s',
                                                                                    MsTransition     : 'all 0.550s',
                                                                                    OTransition      : 'all 0.550s', 
                                                                                    'transition': 'all 0.550s'})
                        if($(window).height() <= 750){
                            $('nav.sidebar.navbar').css({'height':'97vh',  
                                                                WebkitTransition : 'all 0.550s',
                                                                MozTransition    : 'all 0.550s',
                                                                MsTransition     : 'all 0.550s',
                                                                OTransition      : 'all 0.550s', 
                                                                'transition': 'all 0.550s'
                            });
                        }
                    }
                    $(".sidebar-dropdown").removeClass("active");
                    $(this).next(".sidebar-submenu").slideDown(400);
                    $(this).parent().addClass("active");
                    $(this).children().next().css({'transform':'rotateZ(-180deg)',  
                                                            WebkitTransition : 'all 0.550s',
                                                            MozTransition    : 'all 0.550s',
                                                            MsTransition     : 'all 0.550s',
                                                            OTransition      : 'all 0.550s', 
                                                            'transition': 'all 0.550s'})
                    if(height == 0){
                        $(this).parent().next().css({'margin-top':''+ $(this).next().children('ul.forAnimate').height() +'px', 
                                                                                        WebkitTransition : 'all 0.450s',
                                                                                        MozTransition    : 'all 0.550s',
                                                                                        MsTransition     : 'all 0.550s',
                                                                                        OTransition      : 'all 0.550s', 
                                                                                        'transition': 'all 0.550s'});   
                    }else{
                        $(this).parent().next().css({'margin-top':''+ height +'px', 
                                                    WebkitTransition : 'all 0.450s',
                                                    MozTransition    : 'all 0.550s',
                                                    MsTransition     : 'all 0.550s',
                                                    OTransition      : 'all 0.550s', 
                                                    'transition': 'all 0.550s'}); 
                    }
                    if($(window).height() <= 750){
                        $('nav.sidebar.navbar').css({'height':'110vh',  
                                                    WebkitTransition : 'all 0.550s',
                                                    MozTransition    : 'all 0.550s',
                                                    MsTransition     : 'all 0.550s',
                                                    OTransition      : 'all 0.550s', 
                                                    'transition': 'all 0.550s'
                        });
                    }    
                }
            });
        }
        app.init();
    })(sideMenuFunctions)
});