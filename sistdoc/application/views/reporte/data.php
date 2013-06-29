<link rel="stylesheet" href="<?php echo base_url() ?>recursos/jquery/css/mint-choc/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url() ?>recursos/jquery/css/mint-choc/base/jquery.ui.datepicker.css">
<script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>recursos/jquery/css/demos.css">
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnAll").click(function(){
            var p=pathSistdoc+"reporte/descargaArea/1/"+$("#cbo_UO").val();
            location.href=p;
        });
        $("#btnConc").click(function(){
            var p=pathSistdoc+"reporte/descargaArea/2/"+$("#cbo_UO").val();
            location.href=p;
        });
        $("#btnProc").click(function(){
            var p=pathSistdoc+"reporte/descargaArea/3/"+$("#cbo_UO").val();
            location.href=p;
        });
        $("#btnBus").click(function(){
            var p=pathSistdoc+"reporte/descargaFecha/"+$("#From").val()+"/"+$("#To").val();
            location.href=p;
        });
        $("#btnTD").click(function(){
            var p=pathSistdoc+"reporte/descargaTipoDoc/"+$("#cboTD").val();
            location.href=p;
        });
        $( "#From" ).datepicker({maxDate:0,"dateFormat":"yy-mm-dd"});
        $( "#To" ).datepicker({maxDate:0,"dateFormat":"yy-mm-dd"});
    });
    function descargarDatos(){
        
    }

</script>
<style type="text/css">
    #ui-datepicker-div{
        font-size: 11px;
    }
</style>
<div class="Rep">
    <div class='cleaner_h20'></div>
    <div>
        <h5>DESCARGA DE REPORTES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
    </div>
    <input type="hidden" id="page" value="<?php echo $this->page ?>" />
    &nbsp;&nbsp;AREA: <select name="cbo_UO" id="cbo_UO" style="height: 26px;width: 35%;">
        <option value="0">&nbsp;Todos</option>
        <?php
        foreach ($OA as $val) {
            if ($val->id_organo_administrativo > 1) {
        ?>
                <option value="<?php echo $val->id_organo_administrativo; ?>">&nbsp;<?php echo $val->nombre_area; ?></option>
        <?php }
        } ?>
    </select>
    <div></div>
    <button type="button" id="btnAll" class='btn'><i class="icon-plus-sign"></i>&nbsp;Todos</button>
    <button type="button" id="btnConc" class='btn'><i class="icon-plus-sign"></i>&nbsp;Concluidos</button>
    <button type="button" id="btnProc" class='btn'><i class="icon-plus-sign"></i>&nbsp;En Proceso</button>
    <div class='cleaner_h20'></div>
    <div style="border-bottom: 1px solid #dcdede ;padding: 8px"></div>
    <div class="" style="padding-top: 5px">
        Desde:
        <input type="text" name="From" id="From" value="" style="width: 25%"/>
        <div></div>
        &nbsp;Hasta:
        <input type="text" name="To" id="To" value="" style="width: 25%"/>
    </div>
    <button type="button" id="btnBus" class='btn'><i class="icon-plus-sign"></i>&nbsp;Descargar</button>
    <div style="border-bottom: 1px solid #dcdede ;padding: 8px"></div>
    <div class="" style="padding-top: 5px">
        Tipo de Documento:<select name="cboTD" id="cboTD" style="height: 26px;width: 35%;">
        <?php
        foreach ($TD as $val) {
        ?>
                <option value="<?php echo $val->id_tipo_documento; ?>">&nbsp;<?php echo $val->nombre_tipo_documento; ?></option>
        <?php
        } ?>
    </select>

    </div>
    <button type="button" id="btnTD" class='btn'><i class="icon-plus-sign"></i>&nbsp;Descargar</button>
    <div id="contenData">
    </div>
</div>