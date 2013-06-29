<html>
    <head>
        <title>SISTDOC</title>        
        <link type="text/css" href="<?php echo base_url() ?>recursos/css/style-main.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>recursos/jquery/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">        
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery-1.8.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>recursos/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>recursos/bootstrap/css/bootstrap-responsive.min.css">        
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/js/sistdoc.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="wb_Text2" style="position:absolute;left:147px;top:17px;height:56px;z-index:1;">
                <span style="color:#EEEEEE;font-family:Georgia;font-size:30px;">SISTEMA DE TRAMITE DOCUMENTARIO - SISTDOC</span></div>
            <div id="wb_Text3" style="position:absolute;left:164px;top:93px;height:23px;z-index:2;">
                <span style="color:#EEEEEE;font-family:Georgia;font-size:18px;">Municipalidad Distrital de Leoncio Prado</span></div>
            <div id="wb_Image2" style="position:absolute;left:0px;top:-14px;width:100%;height:118px;z-index:4;padding:0;">
                <img src="<?php echo base_url() ?>recursos/imagenes/banner.png" id="Image2" alt="" border="0" style="width:100%;height:181px;"></div>
            <div style="position:absolute;left:1px;top:144px;width:100%;height:18px;text-align:right;z-index:6;padding:0;">
                <!--                <div class="navbar navbar-inverse">-->
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container-fluid" style="font-size: 14px;font-family: Helvetica,Arial,sans-serif">
                            <a href="<?php echo base_url() ?>index.php/inicio/perfil" class="brand">Inicio</a>
                            <ul class="nav">
                                <li class="<?php echo ($opcion == 1) ? "active" : "" ?>"><a href="<?php echo base_url() ?>">Documento</a></li>
                                <li class="<?php echo ($opcion == 2) ? "active" : "" ?>"><a href="<?php echo base_url() ?>index.php/movimiento">Tramite</a></li>                                
                            </ul>
                            <div class="nav secondary-nav pull-right">
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->session->userdata("nombre_usuario");?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu pull-left" style="text-align: left">
                                        <li><a href="<?php echo base_url() ?>index.php/inicio/perfil">Perfil</a></li>
                                        <li><a href="<?php echo base_url() ?>index.php/inicio/ayuda">Ayuda</a></li>
                                        <li><a href="<?php echo base_url() ?>index.php/inicio/cerrarSesion">Cerrar Session</a></li>
                                    </ul>
                                </div>
                            </div>
<!--                            <ul class="nav secondary-nav pull-right">
                                <li><a href="#">Pagina Principal</a></li>
                            </ul>-->
                        </div>
                    </div>
                </div>
            </div>
            <hr id="Line1" style="margin:0;padding:0;position:absolute;left:2%;width:96%;top:224px;height:1px;z-index:5;">
            <div id="wb_Shape1" style="position:relative;left:1px;top:185px;width:100%;z-index:0;padding:0;">
                <img src="<?php echo base_url() ?>recursos/imagenes/bg_white.gif" id="Shape1" alt="" title="" style="border-width:0;width:100%;height:73%;">
<?php echo $estructura ?>
            </div>            
        </div>
        <div id="popup" style="display: none;position: fixed;height: 100%;width: 100%;left: 0px;top: 0px;background-color: #999999 ;z-index: 10;opacity:0.4">
            <div style="position: relative;left: 45%;top: 30%;width:150px;height:150px">
                <img src="<?php echo base_url() ?>recursos/imagenes/loading.gif" style=";">
            </div>
        </div>
        <div id="cont-popup" style="display: none;position: absolute;height: 50%;width: 50%;left: 25%;top: 25%;z-index: 11">
        </div>
    </body>
</html>