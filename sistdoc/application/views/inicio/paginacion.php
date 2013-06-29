<script src="<?php echo base_url(); ?>recursos/js/paginacion.js" type="text/javascript"></script>
<style type="text/css">
    .btnDis{
        display: inline-block;
        padding: 4px 14px;
        margin-bottom: 0;
        font-size: 14px;
        line-height: 20px;
        color: #333;
        text-align: center;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
        vertical-align: middle;
        cursor: default;
        background-repeat: repeat-x;
        border: 1px solid #BBB;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        border-color: #E6E6E6 #E6E6E6 #BFBFBF;
        border-bottom-color: #A2A2A2;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        filter: progid:dximagetransform.microsoft.gradient(startColorstr='whiteff',endColorstr='#FFE6E6e6',GradientType=0);
        filter: progid:dximagetransform.microsoft.gradient(enabled=false);
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2),0 1px 2px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2),0 1px 2px rgba(0, 0, 0, 0.05);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2),0 1px 2px rgba(0, 0, 0, 0.05);
        background-color: #E6E6E6;
        background-image: none;
        opacity: .65;
        filter: alpha(opacity=65);
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }
</style>
<div style="padding-top: 5px">
    <input type="hidden" id="CurPage" value="<?php echo $CurPage; ?>" />
    <input type="hidden" id="NumPage" value="<?php echo $NumPage; ?>" />
    <input type="hidden" id="stepPage" value="0" />
    <button type="button" class="btn" onclick="btnPagination(this.id)" id="btnFirst"><i class="icon-fast-backward"></i></button>
    <button type="button" class="btn" onclick="btnPagination(this.id)" id="btnBefore"><i class="icon-step-backward"></i></button>
    <input style="position: relative;text-align: center;width: 75px;margin-top: 10px" type="text" name="pageBox" id="pageBox" value="<?php echo $CurPage . " de " . $NumPage; ?>" />
    <button type="button" class="btn" onclick="btnPagination(this.id)" id="btnNext"><i class="icon-step-forward"></i></button>
    <button type="button" class="btn" onclick="btnPagination(this.id)" id="btnLast"><i class="icon-fast-forward"></i></button>
</div>