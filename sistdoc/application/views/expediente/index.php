<link rel="stylesheet" href="<?php echo base_url() ?>recursos/jquery/css/mint-choc/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url() ?>recursos/jquery/css/mint-choc/base/jquery.ui.datepicker.css">
<script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>recursos/jquery/js/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>recursos/jquery/css/demos.css">
<style type="text/css">
    input[type="text"]{
        height: 25px;
    }
    .lblSearch{
        font-size: 13px;
        text-align: right;
        font-weight: bold;
        padding-right: 5px
    }
    #dataTable{
        padding-top: 5px;
    }
    body{
        font-size: 62.5%;
        font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        loadTable("-1");
        autoReload();
        $("#btnDwn").click(function(){
            descargar();
        });
        $("#btnDwnPDF").click(function(){
            descargarPDF();
        });
        $("#btnS").click(function(){
            loadTable("1");
        });
        $("#btnSAll").click(function(){
            location.reload();
        });
        $( "#From" ).datepicker({maxDate:0,"dateFormat":"yy-mm-dd"});
        $( "#To" ).datepicker({maxDate:0,"dateFormat":"yy-mm-dd"});
    });
    function descargar(){
        var pathBase=pathSistdoc+"expediente/descargarExpediente/";
        location.href=pathBase;
    }
    function descargarPDF(){
//        var _data=$("#searchF").serialize();
        var p=pathSistdoc+"expediente/";
        location.href=p;
//        $.ajax({
//            type:"post",
//            data:_data,
//            url:p,
//            success:function(resp){
////                console.info(resp)
//            }
//        });
    }
    function autoReload(){
        loadTable("1");
        setTimeout("autoReload()",1000*30);
    }
    function loadTable(v){
        var _data=$("#searchF").serialize();
        var p=pathSistdoc+"movimiento/Tabla/"+v+"/";
        if($("#isFirst").val()!=-1){
            var np=$("#CurPage").val();
            var st=$("#stepPage").val();
            p=pathSistdoc+"movimiento/Tabla/"+v+"/"+(Number(np)+Number(st));
        }
        $.ajax({
            type:"post",
            data:_data,
            url:p,
            success:function(resp){
                $("#dataTable").html(resp);
                $("#isFirst").val(1);
            }
        });
    }
</script>
<div id="wb_Text8" style="position:absolute;left:25px;top:10px;width:100%;height:29px;z-index:3;">
    <div>
        <span style="color:#494848 ;font-family:Georgia;font-size:18px;">Expedientes: </span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="position: absolute;left: 75%;color:#494848 ;font-family:Georgia;font-size:18px;text-align: right;bottom: 5px;">
            <button type="button" class="btn btn-success" id="btnDwnPDF">
                <i class="icon-circle-arrow-down"></i>&nbsp;PDF
            </button>
        </span>
        <span style="position: absolute;left: 83%;color:#494848 ;font-family:Georgia;font-size:18px;text-align: right;bottom: 5px;">
            <button type="button" class="btn btn-success" id="btnDwn">
                <i class="icon-circle-arrow-down"></i>&nbsp;Word
            </button>
        </span>
    </div>
</div>
<div style="position:absolute;top:43px;width:100%;height:29px;z-index:3;left:2%;width: 96%">
    <div style="background-color: #f5f6f5;font-size: 10px">
        <form action="" method="post" id="searchF">
            <table width="96%" style="position: relative;left:2%;">
                <col width="6%">
                <col width="20%">
                <col width="15%">
                <col width="20%">
                <col width="15%">
                <col width="20%">
                <tbody>
                    <tr>
                        <td class="lblSearch">Cliente:</td>
                        <td><input type="text" id="cli" name="cli" value="" /></td>
                        <td class="lblSearch">Tipo Documento:</td>
                        <td>
                            <select name="cbo_td" id="cbo_td" style="height: 26px;width: 100%;">
                                <option value="">&nbsp;Todos</option>
                                <?php
                                foreach ($tipo_documento as $vTD) {
                                    if ($vTD->id_tipo_documento != 0) {
                                ?>
                                        <option value="<?php echo $vTD->id_tipo_documento; ?>">&nbsp;<?php echo $vTD->nombre_tipo_documento; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </td>
                        <td class="lblSearch">N&uacute;mero Documento:</td>
                        <td><input type="text" name="ND"  id="ND" value="" /></td>
                    </tr>
                    <tr>
                        <td class="lblSearch">Estado:</td>
                        <td><select name="cbo_est" id="cbo_est" style="height: 26px;width: 100%;">
                                <option value="">&nbsp;Todos</option>
                                <option value="1">&nbsp;En Proceso</option>
                                <option value="2">&nbsp;Concluido</option>
                            </select>
                        </td>
                        <td class="lblSearch">Desde:</td>
                        <td ><input type="text" name="From" id="From" value="" /></td>
                        <td class="lblSearch">Hasta:</td>
                        <td ><input type="text" name="To" id="To" value="" /></td>
                    </tr>
                    <tr>
                        <td></td><td></td>
                        <td>
                            <button type="button" class="btn" id="btnS">
                                <i class="icon-eye-open"></i>&nbsp;&nbsp;&nbsp;Buscar
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn" id="btnSAll">
                                <i class="icon-refresh"></i>&nbsp;&nbsp;&nbsp;Todo
                            </button>
                        </td>
                        <td></td><td></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <input type="hidden" id="isFirst" value="-1" />
    <div id="dataTable">
    </div>
</div>