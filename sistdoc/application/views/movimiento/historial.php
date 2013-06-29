<script type="text/javascript">
    $("#btnSend").click(function(){
        var id_=$("#id_movimiento").val();
        var hist=$("#historial").val();
        if(hist=="")return false;
        var pathBase=pathSistdoc+"movimiento/actualizar";
        $.ajax({
            type:"post",
            url:pathBase,
            data:"id="+id_+"&historial="+hist,
            success:function(resp){
                    alert("Historial Agregado");
            }
        });
    });
    $("#btnClose").click(function(){
        cerrarPopUp();
    });
</script>
<style type="text/css">
    .divTbl{
        padding: 2px;background-color: #ededed ;right: 15px;border-top: 1px solid #999999
    }
    .divTbl label{
        font-size: 13px
    }
</style>
<div style="padding: 1px;background-color: #515352">
    <div id="">
        <label style="float: left;font-weight: bold;text-align: center;color: #f1f0f0 ">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Historial del Expediente <?php ?></label>
        <label style="">&nbsp;</label>
    </div>
</div>
<div style="border-top: 1px solid #a7a9a8;text-align: left">
    <div style="position: relative;top: 10px;">
        <input type="hidden" name="id_movimiento" id="id_movimiento" value="<?php echo $listaDatos->id_movimiento ?>"/>
        <div id="tblC" style="position: relative;top: 10px;left: 15px;width: 95%;">
        <?php if($this->session->userdata("id_organo_administrativo")==$listaDatos->id_area_destino){?>
        <textarea name="historial" id="historial" rows="4" cols="20"><?php echo $listaDatos->historial;?></textarea>
        <div style="padding-top: 0px;padding-bottom: 5px">
            <button type="button" class="btn" id="btnSend">
                <span style="font-weight: bold">Agregar</span>
            </button>
        </div>
        <?php }else{?>
        <textarea name="historial" disabled rows="4" cols="20"><?php echo $listaDatos->historial;?></textarea>
        <?php }?>
        </div>
    </div>
    <div style="text-align: center;padding-top: 15px">
        <button type="button" class="btn" id="btnClose">
            <span style="font-weight: bold">Salir</span>
        </button>
    </div>
</div>