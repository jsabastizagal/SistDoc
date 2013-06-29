<script type="text/javascript">
    $(document).ready(function(){
        $(".a-lnk-v").click(function(){
            location.href=pathSistdoc+"movimiento/verMovimientoDocumento/"+$(this).attr("attr_id");
        });
        $(".a-lnk-o").click(function(){
            var id=$(this).attr("attr_id");
            var Path="expediente/observacion/"+id;
            var data="";
            mostrarPopUp(Path,data);
        });
    });
</script>
<div style="height: 300px">
    <table id="formData" width="100%">
        <col width="3%">
        <col width="9%">
        <col width="10%">
        <col width="7%">
        <col width="15%">
        <col width="22%">
        <col width="7%">
        <col width="7%">
        <col width="7%">
        <col width="7%">
        <col width="6%">
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
                <th style="text-align: center">Estado</th>
                <th style="text-align: center">Observaci&oacute;n</th>
                <th style="text-align: center">Tramite</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = 1;
            foreach ($listaDatos as $val) {
                $f = explode(" ", $val->fecha);
                $fecha = $f[0];
                $hora = $f[1];
                $estado = $val->estado_expediente;
            ?>
                <tr style="<?php echo ($estado == 1) ? "color: #000" : "color:#339900" ?>">
                    <td align="center"><?php echo $num++ ?></td>
                    <td><?php echo $val->numero_expediente ?></td>
                    <td><?php echo $val->nombre_tipo_documento ?></td>
                    <td><?php echo $val->numero_documento ?></td>
                    <td><?php echo $val->nombre ?></td>
                    <td><?php echo $val->asunto ?></td>
                    <td><?php echo $fecha ?></td>
                    <td><?php echo $hora ?></td>
                    <td align="center"><?php
                switch ($estado) {
                    case 1:echo "En Proceso";
                        break;
                    case 2:echo "Concluido";
                        break;
                    default:
                        break;
                }
            ?>
                </td>
                <td align="center">
                    <a class="a-lnk-o" style="cursor: pointer" attr_id="<?php echo $val->id_expediente ?>">
                        <i class="icon-inbox" title="Ver"></i>
                    </a>
                </td>
                <td align="center">
                    <a class="a-lnk-v" attr_id="<?php echo $val->id_expediente ?>">
                        <i class="icon-folder-open" title="Ver"></i>
                    </a>
                    <a><span class="label" style="background-color: #339900">
                            <?php echo (isset ($dataExp)&&in_array($val->id_expediente, $dataExp)) ? "Nuevo" : ""; ?>
                        </span>
                    </a>
                </td>
            </tr>
            <?php
                        }
            ?>
        </tbody>
    </table>
</div>