<script type="text/javascript">
    $(document).ready(function(){
        cargarCliente();
        $("#txtNI").keyup(function(){
            mostrarCliente();
        });
        $("#txtNI").change(function(){
            mostrarCliente();
        });
        $("#BtnSend").click(function(){
            if(DatosIncorrectos()){
                enviarDatos();
            }
        });
    });
    function mostrarCliente(){
        var num=$("#txtNI").val();
        var v=$("#LC").val().split(",");
        for (var i = 0; i < v.length-1; i++) {
            var ni=v[i].split("-");
            if(ni[1]==num){
                $("#txtCliente").val(ni[2]);
                $("#txtHNI").val(ni[0]);
                break
            }else{
                $("#txtHNI").val("");
            }
        }
    }
    function DatosIncorrectos(){        
        var r=true;
        var NI=$("#txtNI").val();
        if(NI==""){
            r=false;
            $("#txtNI").css("border","1px solid #ff6666");
        }else{
            $("#txtNI").css("border","1px solid #999");
        }
        var A=$("#txtAsunto").val();
        if(A==""){
            r=false;
            $("#txtAsunto").css("border","1px solid #ff6666");
        }else{
            $("#txtAsunto").css("border","1px solid #999");
        }
        var C=$("#txtCliente").val();
        if(C==""){
            r=false;
            $("#txtCliente").css("border","1px solid #ff6666");
        }else{
            $("#txtCliente").css("border","1px solid #999");
        }
        return r;
    }
    function enviarDatos(){
        var pathBase=pathSistdoc+"expediente/guardar";
        var _data=$("#frmAdd").serialize();                
                $.ajax({
                    type:"post",
                    url:pathBase,
                    data:_data,
                    success:function(resp){
                        mostrarPopUp("expediente/mostrarExpediente/"+resp,"");
                        cleanForm();
                    }
                });
    }
    function cargarCliente(){
        var pathBase=pathSistdoc+"cliente/listCliente";
        var listC="";
        $.ajax({
            type:"post",
            url:pathBase,
            success:function(resp){
                listC=resp;
                $("#LC").val(listC);
            }
        });
    }
    function cleanForm(){
        $("#txtNI").val("");
        $("#txtAsunto").val("");
        $("#txtCliente").val("");
        $("#txtFolio").val("");
        $("#txtNDoc").val("");
    }
</script>
<div id="wb_Text8" style="position:absolute;left:20px;top:10px;width:100%;height:29px;z-index:3;">
    <div>
        <span style="color:#494848 ;font-family:Georgia;font-size:24px;">Nuevo Expediente</span>
    </div>
</div>
<div style="position:absolute;left:20px;top:50px;width:100%;height:29px;z-index:3;">
    <input type="hidden" id="LC" value="" />
    <form id="frmAdd" method="post" action="<?php echo base_url() ?>index.php/expediente/guardar">
        <table id="formTB" width="100%">
            <col width="25%">
            <col width="15%">
            <col width="10%">
            <col width="35%">
            <col width="15%">
            <tr>
                <td class="lbl">Procedimiento: </td>
                <td colspan="3">
                    <select name="cbo_Pr" id="cbo_Pr" style="height: 26px;width: 100%;">
                        <option value="0">--Ninguno--</option>
                        <?php
                        foreach ($procedimiento as $val) {
                            if ($val->id_procedimiento != 0) {
                        ?>
                                <option value="<?php echo $val->id_procedimiento; ?>">&nbsp;<?php echo $val->nombre_procedimiento; ?></option>
                        <?php }
                        } ?>
                    </select>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Unidad Organica: </td>
                <td colspan="3">
                    <select name="cbo_UOO" style="width: 100%">
                        <option value="1">Unidad de Tramite</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="lbl">Siguiente Unidad Organica: </td>
                <td colspan="3">
                    <select name="cbo_UOD" id="cbo_UOD" style="height: 26px;width: 100%;">
                        <?php
                        foreach ($organo_administrativo as $val) {
                            if ($val->id_organo_administrativo > 1) {
                        ?>
                                <option value="<?php echo $val->id_organo_administrativo; ?>">&nbsp;<?php echo $val->nombre_area; ?></option>
                        <?php }
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="lbl">Tipo de Documento: </td>
                <td colspan="3">
                    <select name="cbo_TD" id="cbo_TD" style="height: 26px;width: 100%;">
                        <?php
                        foreach ($tipo_documento as $vTD) {
                            if ($vTD->id_tipo_documento != 0) {
                        ?>
                                <option value="<?php echo $vTD->id_tipo_documento; ?>">&nbsp;<?php echo $vTD->nombre_tipo_documento; ?></option>
                        <?php }
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="lbl">N&deg Documento: </td>
                <td colspan="3"><input type="text" id="txtNDoc" name="txtNDoc" value="" /></td>
            </tr>
            <tr>
                <td class="lbl">Asunto: </td>
                <td colspan="3">
                    <input type="text" class="" id="txtAsunto" name="txtAsunto" value="" />
                </td>
            </tr>
            <tr>
                <td class="lbl">N&uacute;mero de Identificacion/DNI: </td>
                <td><input type="hidden" id="txtHNI" name="txtHNI" value="" />
                    <input type="text" class="" id="txtNI" name="txtNI" value="" /></td>
                <td><label class="lbl">Remitente: </label></td>
                <td><input type="text" class="" id="txtCliente" name="txtCliente" value="" /></td>
            </tr>
            <tr>
                <td class="lbl">Folio: </td>
                <td colspan="3"><input type="text" id="txtFolio" name="txtFolio" value="" /></td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <button type="button" id="BtnSend" class="btn btn-success">
                        <i class="icon-folder-open icon-white"> </i> Enviar
                    </button>
                </td>
        </table>
    </form>
</div>