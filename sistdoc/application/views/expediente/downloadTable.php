<?php
header('Content-type: application/msword');
header('Content-Disposition: inline;filename=reporte_expediente.doc');
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
    <head>
        <xml><w:WordDocument><w:View>Print</w:View><w:Zoom>100</w:Zoom></w:WordDocument></xml>
        <meta http-equiv="Content-Language" content="es" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style type="text/css">
    @CHARSET "ISO-8859-1";
    body{
            font-size:10px;
            font-family:Arial;
    }
</style>
    </head>
<body>
<div id="wb_Text8" style="position:absolute;left:20px;top:10px;width:100%;height:29px;z-index:3;">
    <div style="text-align: center">
        <span style="color:#494848 ;font-family:Georgia;font-size:24px;">Movimiento del Expediente</span>
    </div>
</div>
<div style="position:absolute;top:43px;width:100%;height:29px;z-index:3;left:2%;width: 96%">
        <table id="formData" width="100%">
            <col width="3%">
            <col width="8%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
            <col width="30%">
            <col width="12%">
            <col width="12%">
            <thead style="background-color: #F0F0F0 ">
                <tr>
                    <th style="text-align: center">N&deg;</th>
                    <th>N&deg; Expediente</th>
                    <th>Documento</th>
                    <th>N&deg; Documento</th>
                    <th>Remitente</th>
                    <th>Asunto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>                
                <?php
                $num=1;
                foreach ($listaDatos as $val) {
                    $f=explode(" ",$val->fecha);
                    $fecha=$f[0];
                    $hora=$f[1];
                ?>
                    <tr>
                        <td align="center"><?php echo $num++?></td>
                        <td><?php echo $val->numero_expediente?></td>
                        <td><?php echo $val->id_tipo_documento?></td>
                        <td><?php echo $val->numero_documento?></td>
                        <td><?php echo $val->id_cliente?></td>
                        <td><?php echo $val->asunto?></td>
                        <td><?php echo $fecha?></td>
                        <td><?php echo $hora?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
</div>
</body>
</html>