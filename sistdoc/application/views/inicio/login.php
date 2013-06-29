<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SISTDOC:::Login</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>recursos/bootstrap/styles/bootstrap.min.css">
        <style type="text/css">
            body {
                padding-top: 60px;
            }
        </style>
    </head>
    <body>
        <div class="topbar">
            <div class="fill">
                <div class="container">
                    <a class="brand" href="<?php echo base_url() ?>">SISTDOC</a>
                    <ul class="nav">
                        <li><a href="index.html">Cliente</a></li>
                    </ul>
                    <form class="pull-left" method="post" action="<?php echo base_url() ?>index.php/expedientes/consulta/">
                        <input type="text" name="txtNExp" placeholder="Numero de Expediente...">
                        <input type="text" name="txtNI" placeholder="Numero de Identificacion...">
                        <button class="btn" type="submit">Buscar</button>
                    </form>
                    <ul class="nav secondary-nav">
                        <li><a href="#">Pagina Principal</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if($this->session->userdata('consultWrong')){?>
        <div style="text-align: center;top: -15px;position: relative;">
            <span class="label important" style="padding: 5px;font-family: Arial">No hay Registro Encontrado - Verifique</span>
        </div>
        <?php }?>
        <div class="container">
            <div class="hero-unit span8 pull-left" style='height:150px;'>
                <img src="<?php echo base_url() ?>recursos/imagenes/logo.png">
                <h1>Bienvenido</h1>
                <p>Sistema de Tramite Documentario de la Municipalidad Distrital de Leoncio Prado.</p>
            </div>
            <div class="well span5 pull-right" style='height:230px;'>
                <form class='form-stacked' action="<?php echo base_url() ?>index.php/inicio/iniciarSesion" method="post">
                    <h2>Iniciar Session</h2>
                    <div class='cleaner_h20'></div>
                    <div class="clearfix">
                        <label for="username">Usuario</label>
                        <div class="input">
                            <input id="txtUsu" name="txtUsu" size="30" type="text"/>
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="pwd">Contrase&ntilde;a</label>
                        <div class="input">
                            <input id="txtPass" name="txtPass" size="30" type="password"/>
                        </div>
                    </div>
                    <div>
                        <?php
                        if(isset ($mess))
                        if($mess==1){
                            ?><span class="label notice">Ingrese Usuario y Contrase&ntilde;a</span><?php
                        }else if($mess==2){
                            ?><span class="label important">Contrase&ntilde;a Incorrecta</span><?php
                        }else if($mess==3){
                            ?><span class="label important">Usuario y Contrase&ntilde;a requerido</span><?php
                        }else{
                            ?><span class="label success">Enviando...</span><?php
                        }
                        ?>                        
                    </div>
                    <div class='cleaner_h20'></div>
                    <input type='submit' value='Ingresar' id='signup' name='signup' class="btn primary"/>
                </form>
            </div>
        </div>
    </body>
</html>