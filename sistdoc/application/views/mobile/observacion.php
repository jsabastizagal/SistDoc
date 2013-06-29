<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>SistDoc::Movil</title>
        <link rel="stylesheet"  href="<?php echo base_url() ?>recursos/JQM/jquery.mobile-1.1.1.min.css" />
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/JQM/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>recursos/JQM/jquery.mobile-1.1.1.min.js"></script>
    </head>
    <body>
    <section data-role="page" id="exp">
        <div data-role="header"><h1>Municipalidad Leoncio Prado</h1><a href="<?php echo base_url()?>index.php/expedientes/consulta" data-ajax="false">Atras</a><a href="<?php echo base_url() ?>">SistDoc</a></div>
        <div data-role="content">
            <ul data-role="listview" data-divider-theme="b" data-inset="true">
                <li data-role="list-divider" role="heading">&nbsp;Prove&iacute;do: </li>
                <li data-theme="c"><?php echo ($proveido)?$proveido:"No hay Proveido" ?></li>
            </ul>
            <ul data-role="listview" data-divider-theme="b" data-inset="true">
                <li data-role="list-divider" role="heading">&nbsp;Historial </li>
                <li data-theme="c"><?php echo ($historial)?$historial:"No hay Historial" ?></li>
            </ul>
            <ul data-role="listview" data-divider-theme="b" data-inset="true">
                <li data-role="list-divider" role="heading">&nbsp;Observacion: </li>
                <?php if (count($listaDatos) == 0) { ?>
                    <li data-theme="c">Sin Observaci&oacute;n</li>
                <?php
                } else {
                    $num = 1;
                    foreach ($listaDatos as $val) {
                        $obs = $val->observacion;
                ?>
                        <li data-theme="c">
                    <?php
                        echo $obs;
                    ?>
                    </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </section>
</body>
</html>