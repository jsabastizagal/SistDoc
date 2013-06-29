<?php
$this->session->set_userdata('isMobile',1);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SistDoc</title>
        <link rel="stylesheet"  href="<?php echo base_url() ?>recursos/JQM/jquery.mobile-1.1.1.min.css" />
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/JQM/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/JQM/jquery.mobile-1.1.1.min.js"></script>
    </head>
    <body>    
    <section id="formularios" data-role="page">
        <header data-role="header">
            <h1>Municipalidad Distrital de Leoncio Prado</h1>
        </header>
        <div class="content" data-role="content">
            <form id="formS" action="<?php echo base_url() ?>index.php/expedientes/consulta" method="post" data-ajax="false">
                <label for="txtNExp">N&deg; Expediente:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" id="txtNExp" name="txtNExp"  placeholder=""/>
                <label for="txtNI">N&deg; Identificacion:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" id="txtNI" name="txtNI"  placeholder=""/>
                <input type="submit" data-theme="b" value="Buscar" name="send"/>
            </form>
        </div>
        <?php if($this->session->userdata('consultWrong')){?>
        <div style="text-align: center">
            <span style="color: #ff0000;font-weight: bold;padding: 5px;font-family: Arial">No hay Registro Encontrado - Verifique</span>
        </div>
        <?php }?>
        <footer data-role="footer" data-position="fixed">
            <h2>Sistema de Tramite Documentario</h2>
        </footer>
    </section>
</body>
</html>