<script type="text/javascript">
    $("#btnSend").click(function(){
        derivar(_TMP,_TMPOA);
    });
    $("#btnClose").click(function(){
        _TMP="";
        _TMPOA="";
        cerrarPopUp();
    });
</script>
<div style="padding: 1px;background-color: #515352">
    <div id="">
        <label style="float: left;font-weight: bold;text-align: center;color: #f1f0f0 ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Seleccione el &Aacute;rea Administrativa</label>
        <label style="">&nbsp;</label>
    </div>
</div>
<div style="border-top: 1px solid #a7a9a8;text-align: left">
    <div style="position: relative;top: 10px;left: 15px">
        <?php
        foreach ($datosOA as $vOA) {
            if ($vOA->id_organo_administrativo != 0) {
        ?>
                <div style="padding: 4px">
                    <input type="radio" name="listOrg" value="<?php echo $vOA->id_organo_administrativo; ?>" />
                    <span style="position: relative;top: 2px;font-weight: bold">&nbsp;&nbsp;&nbsp;<?php echo $vOA->nombre_area; ?></span>
                </div>
        <?php }
        } ?>
        <div style="text-align: center;padding-top: 10px">
            <button type="button" class="btn" id="btnSend">
                <span style="font-weight: bold">Enviar</span>
            </button>
            <button type="button" class="btn" id="btnClose">
                <span style="font-weight: bold">Cancelar</span>
            </button>
        </div>
    </div>
</div>