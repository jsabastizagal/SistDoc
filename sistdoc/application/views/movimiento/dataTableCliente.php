<script type="text/javascript">
    $(document).ready(function(){
        $("#btnDwn").click(function(){
            descargar();
        });
        $(".lnkO").click(function(){
            observar($(this).attr("attr_id"));
        });
        $(".lnkH").click(function(){
            Historial($(this).attr("attr_id"));
        });
        $(".lnkP").click(function(){
            Proveido($(this).attr("attr_id"));
        });
    });
    function observar(v){
        mostrarPopUp("observacion/Tabla/","id="+v);
    }
    function Historial(v){
        mostrarPopUp("movimiento/historial/","id="+v);
    }
    function Proveido(v){
        mostrarPopUp("movimiento/proveido/","id="+v);
    }
    function descargar(){
        var pathBase=pathSistdoc+"expedientes/descargarPDF/";
        var nexp=$("#NExp").val();
        location.href=pathBase+nexp;
    }
</script>
<div id="wb_Text8" style="position:absolute;left:25px;top:10px;width:100%;height:29px;z-index:3;">
    <div>
        <span style="color:#494848 ;font-family:Georgia;font-size:18px;">Expediente N&deg; <?php echo $datosExp->numero_expediente ?>:</span>
        <span style="position: absolute;right: 5%;color:#494848 ;font-family:Georgia;font-size:18px;text-align: right;bottom: 5px">
            <button type="button" class="btn btn-success" id="btnDwn">
                    Descargar Reporte
            </button>
        </span>
        <input type="hidden" id="NExp" value="<?php echo $datosExp->id_expediente ?>" />
    </div>
</div>
<div style="position:absolute;top:43px;width:100%;height:29px;z-index:3;left:2%;width: 96%">
    <table id="formData" width="100%">
        <col width="8%">
        <col width="8%">
        <col width="10%">
        <col width="10%">
        <col width="15%">
        <col width="10%">
        <col width="10%">
        <col width="10%">
        <col width="11%">
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
                <th>Prov / Hist / Obs</th>
                <th> Estado</th>
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
                    <td>
                        <a class='lnkP' style='cursor:pointer' attr_id='<?php echo $val->id_movimiento?>'><i class="icon-th-large" title="Proveido"></i>&nbsp;&nbsp;/&nbsp;&nbsp;</a>
                        <a class='lnkH' style='cursor:pointer' attr_id='<?php echo $val->id_movimiento?>'><i class="icon-th" title="Historial"></i>&nbsp;&nbsp;/&nbsp;&nbsp;</a>
                        <a class='lnkO' style='cursor:pointer' attr_id='<?php echo $val->id_movimiento?>'><i class="icon-th-list" title="Observacion"></i></a>
                    </td>
                    <td><?php
                          echo $val->nombre;
                      ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>