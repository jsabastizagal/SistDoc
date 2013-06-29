<style type="text/css">
    input[type="text"]{
        height: 25px;
    }
    a:visited{
        color: #08C;
    }
</style>
<div id="wb_Text8" style="position:absolute;left:25px;top:10px;width:100%;height:29px;z-index:3;">
    <div>
        <span style="color:#494848 ;font-family:Georgia;font-size:18px;">Bienvenido:
            <span style="font-size: 12px"><?php echo $this->session->userdata("nombre_usuario"); ?></span>
        </span>
    </div>
    <div style="padding-top: 15px">
        <div class="container" style="width: 95%">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="hero-unit">
                            <ul class="nav nav-list">
                                <li <?php echo ($tabActive==1)?"class='active'":"" ?>><a tabindex="1" href="<?php echo base_url() ?>index.php/inicio/perfil"><i class="icon-cog"></i>Mi Cuenta</a></li>
                                <?php if($this->session->userdata("nivel_acceso")<2){?>
                                <li <?php echo ($tabActive==2)?"class='active'":"" ?>><a tabindex="2" href="<?php echo base_url() ?>index.php/usuario"><i class="icon-user"></i>Usuario</a></li>
                                <li <?php echo ($tabActive==3)?"class='active'":"" ?>><a tabindex="3" href="<?php echo base_url() ?>index.php/rol_usuario"><i class="icon-tasks"></i>Rol de Usuario</a></li>
                                <li <?php echo ($tabActive==4)?"class='active'":"" ?>><a tabindex="4" href="<?php echo base_url() ?>index.php/reporte"><i class="icon-download"></i>Reporte</a></li>
                                <li <?php echo ($tabActive==5)?"class='active'":"" ?>><a tabindex="5" href="<?php echo base_url() ?>index.php/area_administrativa"><i class="icon-qrcode"></i>Area Administrativa</a></li>
                                <li <?php echo ($tabActive==6)?"class='active'":"" ?>><a tabindex="6" href="<?php echo base_url() ?>index.php/procedimiento"><i class="icon-random"></i>Procedimiento</a></li>
                                <li <?php echo ($tabActive==7)?"class='active'":"" ?>><a tabindex="7" href="<?php echo base_url() ?>index.php/tipo_documento"><i class="icon-edit"></i>Tipo de Documento</a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>

                    <div class="span10" style="">
                        <div class="well span20">
                            <?php echo $containerData;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>