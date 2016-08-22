
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
        <script type="text/javascript">
            var BASEURL="<?php echo base_url();?>";
            function letras(e){
                tecla = e.keyCode || e.which; 
                base =/[a-zñ ]/; 
                teclado = String.fromCharCode(tecla).toLowerCase(); 
                return base.test(teclado); 
            }
            function numeros(e){
                tecla = e.keyCode || e.which; 
                base =/[0-9]/; 
                teclado = String.fromCharCode(tecla).toLowerCase(); 
                return base.test(teclado); 
            }

            function reservarahora(obj){
                if (obj.dni.value=="" || obj.dni.value.length<8) {
                    alert("ingrese dni correcto"); return 0;
                }
                if (obj.nombre.value=="") {
                    alert("ingrese nombre"); return 0;
                }
                if (obj.apellidop.value=="") {
                    alert("ingrese apellido paterno"); return 0;
                }
                if (obj.apellidom.value=="") {
                    alert("ingrese apellido materno"); return 0;
                }
                if (obj.telefono.value=="") {
                    alert("ingrese telefono correcto"); return 0;
                }

                $.ajax({
                    type:"POST",
                    data:$("#frm-cartelera").serialize(),
                    url:BASEURL+"Reserva/GuardarReservaMobil",
                    success: function(data){
                        alert(data);
                        window.location=BASEURL+"paginaweb/mobil";
                    }
                });
            }
        </script>       
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
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilreservas">Reservas</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilubicacion">Ubicación</a></li>
                    <li><a href="<?php echo base_url();?>Paginaweb/mobilcontacto">Contacto</a></li>
                </ul>
            </div>
            <style type="text/css">
            .menu-secciones .tit_seccion_menu{font-family: 'Oswald', sans-serif;background: #b98f3e; color: white; padding: 10px; font-size: 1em; display: block; text-transform: uppercase;}
            .menu-secciones .tit_seccion_menu a{color:white;}
            .menu-secciones .tit_seccion_menu img{margin-top: -5px; margin-right:10px; }
            </style>
            <div class="menu-secciones">
                <h2 class="tit_seccion_menu"><img src="<?php echo base_url();?>imageneshotel/icono_habitacion.png" alt="logo upc" width="20" valign="middle"> HABITACIONES</a></h2>
            </div>    
            <div class="menu-secciones menu-revistas">
                <ul>
                    <li class="m-viu"><a href="<?php echo base_url();?>paginaweb/mobilsimple">Habitación simple</a></li>
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
                    <h5>Reserva la habitación que necesitas de manera fácil y rapido</h5>
                    <p>Todas las habitaciones tienen baño privado, ventilador, tv 32" o 21", cable, muebles,Telefono, internet, espejos.
                    </p>
                    <li>Habitaciones comodas y equipadas.</li>                          
                    <li>Se entregan 3 toallas, papel higiénico y jabón</li>
                    <li>Tarifas coorporativas para grupor por contrato o exclusividad.</li>
                    <li>Reservas deben ser pagadas con anticipación estricta mínima de 48 horas, de lo contrario no se garantiza ocupabilidad.</li>
                    <li>Disponemos de camioneta turistica. Van marca Mercedes Benz modelo Sprinter 413, para 20 personas.</li>
                    <li>Salón de uso Múltiple para 100 personas.  Equipo multimedia y de sonido.  Servicios de alimentación y traslado.</li>
                    <h6 style="font-size:18px;color:red">Después de realizar su reserva comuníquese con nuestra recepción. Telefono: 042-524213</h6>
                </section>       
            </section>
            <section class="reserva">
                <h3>RESERVAR HABITACION</h3>
                <div class="reservar">
                    <form method="POST" id="frm-cartelera" action="">
                        <div class="frm-control">
                            <label for="Name">Tipo Habitación</label>
                            <input type="hidden" name="tipohabitaciones" value="<?php echo $_POST['tipohabitaciones']; ?>">
                            <input type="text" value="
                            <?php
                            $i=$_POST['tipohabitaciones'];
                            switch ($i) {
                                case 1:
                                    echo "Habitación simple";
                                    break;
                                case 2:
                                    echo "Habitación doble";
                                    break;
                                case 3:
                                    echo "Habitación triple";
                                    break;
                                case 4:
                                    echo "Habitación cuadruple";
                                    break;
                                case 5:
                                    echo "Habitación suit";
                                    break;
                                case 6:
                                    echo "Habitación matrimonial";
                                    break;
                            }
                            ?> 
                            " disabled>
                        </div>
                        <div class="frm-control">
                            <label for="Name">Fecha Ingreso</label>
                            <input type="hidden" name="ingreso" value="<?php echo $_POST['fechaingreso']; ?>">
                            <input type="date" value="<?php echo $_POST['fechaingreso']; ?>" disabled>
                        </div>
                        <div class="frm-control">
                            <label for="Name">Fecha Salida</label>
                            <input type="hidden" name="salida" value="<?php echo $_POST['fechasalida']; ?>">
                            <input type="date" value="<?php echo $_POST['fechasalida']; ?>" disabled>
                        </div>
                        <div class="frm-control">
                            <input type="text" name="dni" placeholder="Ingrese DNI" onKeyPress="return numeros(event)" maxlength="8" required>
                        </div>
                        <div class="frm-control">
                            <input type="text" name="nombre" placeholder="Ingrese nombre" onKeyPress="return letras(event)" required>
                        </div>
                        <div class="frm-control">
                            <input type="text" name="apellidop" placeholder="Ingrese apellido paterno" onKeyPress="return letras(event)" required>
                        </div>
                        <div class="frm-control">
                            <input type="text" name="apellidom" placeholder="Ingrese apellido materno" onKeyPress="return letras(event)" required>
                        </div>
                        <div class="frm-control">
                            <input type="text" name="telefono" placeholder="Ingrese telefono" onKeyPress="return numeros(event)" maxlength="9" required>
                        </div>
                        <div class="frm-boton">
                            <input type="button" id="btn-buscar" class="btn" value="Reservar Ahora" onclick="return reservarahora(this.form);">
                        </div>
                    </form>
                </div>
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
