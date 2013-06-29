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
        <div data-role="header"><h1>Municipalidad Leoncio Prado</h1><a href="<?php echo base_url() ?>">SistDoc</a></div>
        <div data-role="content">
            <ul data-role="listview" data-divider-theme="b" data-inset="true">
                <li data-role="list-divider" role="heading">Expediente N&deg; <?php echo $datosExp->numero_expediente ?>:</li>
                <li data-theme="c">                    
                    <table width="100%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="5%">
                            <thead>
                                <tr>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Fecha R.</th>
                                    <th>Usuario R.</th>
                                    <th>Fecha D.</th>
                                    <th>Usuario D.</th>
                                    <th>Fecha A.</th>
                                    <th>Usuario A.</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                        </table>
                    
                </li>
               <?php
            $num = 1;
            foreach ($listaDatos as $val) {
                $URec = $val->rol_recepcion;
                $UDer = $val->rol_derivacion;
                $UAte = $val->rol_atencion;
                ?>
                <li data-theme="c">
                    <a href="<?php echo base_url()."index.php/observacion/tabla/".$val->id_movimiento?>" data-ajax="false" data-transition="fade">
                        <table width="100%" style="font-size: 13px;">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="5%">
                            <tbody>
                                    <tr>
                                        <td><?php echo $val->area_origen ?></td>
                                        <td><?php echo $val->area_destino ?></td>
                                        <td><?php echo ($URec != "") ? $val->fecha_recepcion : "" ?></td>
                                        <td><?php echo $URec ?></td>
                                        <td><?php echo ($UDer != "") ? $val->fecha_derivacion : "" ?></td>
                                        <td><?php echo $UDer ?></td>
                                        <td><?php echo ($UAte != "") ? $val->fecha_atencion : "" ?></td>
                                        <td><?php echo $UAte ?></td>
                                        <td><?php echo $val->nombre; ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </a>
                </li>
                <?php
            }
            ?>
            </ul>
        </div>
    </section>
</body>
</html>