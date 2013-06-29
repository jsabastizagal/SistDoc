<script type="text/javascript">
    $("#btnSend").click(function(){
        var id_mov=$("#id_movimiento").val();
        var obs=$("#observacion").val();
        if(obs=="")return false;
        var pathBase=pathSistdoc+"observacion/guardar";
        $.ajax({
            type:"post",
            url:pathBase,
            data:"id_movimiento="+id_mov+" & observacion="+obs,
            success:function(resp){
                if(resp!=0){
                    var div=$("#tblC:first").attr("class");
                    if(div!="divTbl"){
                        $("#tblC").html("");
                    }
                    var h="<div class='divTbl'><label>"+obs+"</label></div>";
                    $("#tblC").append(h);
                    $("#observacion").val("");
                }else{
                    alert("No se Agrego la Observacion");
                }
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
            Observaciones del Expediente</label>
        <label style="">&nbsp;</label>
    </div>
</div>
<div style="border-top: 1px solid #a7a9a8;text-align: left">
    <div style="position: relative;top: 10px;">
        <input type="hidden" name="id_movimiento" id="id_movimiento" value="<?php echo $id_movimiento ?>"/>
        <?php if($destino==$this->session->userdata("id_organo_administrativo")){?>
        <input type="text" name="observacion" id="observacion" value="" style="height: 25px"/>        
        <div style="text-align: center;padding-top: 0px;padding-bottom: 5px">
            <button type="button" class="btn" id="btnSend">
                <span style="font-weight: bold">Agregar</span>
            </button>
        </div>
        <?php }?>
    </div>
    <div id="tblC" style="position: relative;top: 10px;left: 15px;width: 95%;">
        <?php if (count($listaDatos) == 0) {
        ?>
        <div style="height: 70px">
        <span class="label important" style="background-color: #663300 ;">Sin Observaci&oacute;n</span>
        </div>
        <?php
        } else {
            foreach ($listaDatos as $vO) {
                if ($vO->id_observacion != 0) {
        ?>
                    <div class="divTbl">
                        <label><?php echo $vO->observacion; ?></label>
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
    <div style="text-align: center;padding-top: 15px">
        <button type="button" class="btn" id="btnClose">
            <span style="font-weight: bold">Salir</span>
        </button>
    </div>
</div>