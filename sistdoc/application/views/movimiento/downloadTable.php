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
<div id="wb_Text8" style="position:absolute;left:20px;top:5px;width:100%;height:29px;z-index:3;">
    <div style="text-align: center">
        <span style="color:#494848 ;font-family:Georgia;font-size:18px;">
            REPORTE DE LOS MOVIMIENTOS DEL EXPEDIENTE N&deg; <?php echo $datosExp->numero_expediente ?>:</span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
        <input type="hidden" id="NExp" value="<?php echo $datosExp->id_expediente ?>" />
    </div>
</div>
<div style="position:absolute;top:43px;width:100%;height:29px;z-index:3;left:2%;width: 96%">
    <table id="formData" width="100%">
        <col width="15%">
        <col width="15%">
        <col width="11%">
        <col width="11%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="8%">
        <thead style="background-color: #F0F0F0">
            <tr>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha Recepcion</th>
                <th>Usuario Recepcion</th>
                <th>Fecha Derivacion</th>
                <th>Usuario Derivacion</th>
                <th>Fecha Atencion</th>
                <th>Usuario Atencion</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = 1;
            foreach ($listaDatos as $val) {
                $URec = $val->rol_recepcion;
                $UDer = $val->rol_derivacion;
                $UAte = $val->rol_atencion;
                ?>
                <tr>
                    <td><?php echo $val->area_origen ?></td>
                    <td><?php echo $val->area_destino ?></td>
                    <td><?php echo ($URec != "") ? $val->fecha_recepcion : "" ?></td>
                    <td><?php echo $URec ?></td>
                    <td><?php echo ($UDer != "") ? $val->fecha_derivacion : "" ?></td>
                    <td><?php echo $UDer ?></td>
                    <td><?php echo ($UAte != "") ? $val->fecha_atencion : "" ?></td>
                    <td><?php echo $UAte ?></td>                 
                    <td><?php
                        $est = $val->id_estado;
                        switch ($est) {
                            case 1:echo 'Por Derivar';
                                break;
                            case 2:echo 'Por Recibir';
                                break;
                            case 3:echo 'Derivado';
                                break;
                            case 4:echo 'No Tramitado';
                                break;
                            case 5:echo 'Recibido-Concluido';
                                break;
                            default:echo 'En Proceso';
                                break;
                        }
                ?></td>                 
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>