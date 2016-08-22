<!DOCTYPE html>
<html lang="es">
    </script><script async="" src="<?php echo base_url();?>Pagina/js/analytics.js"></script><script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tarapoto Inn</title>
        <link rel="stylesheet" href="<?php echo base_url();?>Pagina/css/base-ui.css">
        <link rel="stylesheet" href="<?php echo base_url();?>Pagina/css/styles.css">        
    </head>                       
    <body class="home">
        <nav id="ec-menu" class="ec-menu">
            <div class="menu-header">
                <ul>
                    <li><a href="index.html"><img src="<?php echo base_url();?>imageneshotel/logomobil.png"></a></li>
                </ul>
            </div>
            <div class="menu-secciones">
                <ul>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobil">Inicio</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilhabitaciones">Habitaciones</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilnosotros">Nosotros</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilservicios">Servicios</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilvideos">Videos</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobiltours">Tours</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilubicacion">Ubicación</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilcontacto">Contacto</a></li>
                </ul>
            </div>
            <style type="text/css">
            .menu-secciones .tit_seccion_menu{font-family: 'Oswald', sans-serif;;background: #b98f3e; color: white; padding: 10px; font-size: 1em; display: block; text-transform: uppercase;}
            .menu-secciones .tit_seccion_menu a{color:white;}
            .menu-secciones .tit_seccion_menu img{margin-top: -5px; margin-right:10px; }
            </style>
            <div class="menu-secciones">
                <h2 class="tit_seccion_menu"><img src="<?php echo base_url();?>imageneshotel/icono_habitacion.png" alt="logo upc" width="20" valign="middle"> HABITACIONES</a></h2>
            </div>    
            <div class="menu-secciones menu-revistas">
                <ul>
                    <li class="m-viu"><a href="<?php echo base_url();?>Paginaweb/mobilsimple">Habitación simple</a></li>
                    <li class="m-dominical"><a href="<?php echo base_url();?>Paginaweb/mobildoble">Habitación doble</a></li>
                    <li class="m-vamos"><a href="<?php echo base_url();?>Paginaweb/mobiltriple">Habitación triple</a></li>
                    <li class="m-ruedas"><a href="<?php echo base_url();?>Paginaweb/mobilcuadruple">Habitación cuadruple</a></li>
                    <li class="m-menuperu"><a href="<?php echo base_url();?>Paginaweb/mobilmatrimonial">Habitación matrimonial</a></li>
                    <li class="m-casaymas"><a href="<?php echo base_url();?>Paginaweb/mobilsuit">Habitación suit</a></li>
                </ul>
            </div>
            <div class="menu-secciones">
                <h2 class="tit_seccion_menu" >Redes Sociales</a></h2>
            </div>    
            <div class="menu-secciones">
                <ul>
                    <li><a href="https://www.facebook.com/hoteltarapotoinnoficial/">Facebook</a></li>
                    <li><a href="https://twitter.com/?lang=es">Twitter</a></li>
                    <li><a href="https://www.youtube.com/watch?v=g6p1mEJaz9A">YouTube</a></li>
                    <li><a href="#">Google</a></li>
                    <li><a href="#">Whatsapp</a></li>
                </ul>
            </div>
            <div class="cn-options"></div>
        </nav>
        <main id="wrapper">
            <header id="ec-header">
                <div class="box-header">
                    <ul>
                        <li class="btn-menu">
                            <a href="#" onclick="gec.ui.menuOver(event, this)" data-params="{&quot;dim&quot;:&quot;#wrapper&quot;,&quot;menuover&quot;:&quot;#ec-menu&quot;}"><img src="<?php echo base_url();?>imageneshotel/menu-icon.png"></a>
                        </li>
                        <li class="site-logo">
                            <h1><a href="<?php echo base_url();?>Paginaweb/mobil"><img src="<?php echo base_url();?>imageneshotel/logomobil.png" alt=""></a></h1>
                        </li>
                        <li class="btn-otros">
                            <ul>
                                <li class="btn-ec"><a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts"><img src="<?php echo base_url();?>imageneshotel/facebook1.png"></a></li>
                                <li class="btn-tvmas"><a href="https://twitter.com/?lang=es"><img src="<?php echo base_url();?>imageneshotel/twitter1.png" alt=""></a></li>
                                <li class="btn-dt"><a href="#"><img src="<?php echo base_url();?>imageneshotel/google1.png" alt=""></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </header>
            <section id="ec-content">                
                <section class="ec-tops">
                    <img src="<?php echo base_url();?>imageneshotel/img.jpg" width="100%">
                    <h4>HISTORIA</h4>
                    <p>
                        <?php foreach ($Informacion as $value):
                            echo $value->historia;
                            
                        endforeach ?>
                    </p>
                    <h4>MISION</h4>
                    <p>
                        <?php foreach ($Informacion as $value):
                            echo $value->mision;
                            
                        endforeach ?>
                    </p> 
                    <h4>VISION</h4>
                    <p>
                        <?php foreach ($Informacion as $value):
                            echo $value->vision;
                            
                        endforeach ?>
                    </p>                               
                </section>       
            </section>
            <footer id="ec-footer">
                <a href="<?php echo base_url();?>Paginaweb/mobil" class="ec-logo"><img src="<?php echo base_url();?>imageneshotel/logomobil.png"></a>
                <p>© Hotel Tarapoto Inn<br>Jr. Jimenez Pimentel 115 - Tarapoto</p>
                <p><a href="#" class="vweb">Ver en versión web</a> </p>
            </footer>   
        </main>
        <script type="text/javascript" async="" src="<?php echo base_url();?>Librerias/plugins/jquery/jquery.js"></script>
        <script type="text/javascript" async="" src="<?php echo base_url();?>Pagina/js/lazy.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>Pagina/js/core.js" id="js-core" data-js="cxense, peruid, lazy" data-ui="orbit, fheader, hidemenu" async=""></script>
    </body>
</html>
