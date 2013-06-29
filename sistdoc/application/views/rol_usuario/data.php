<script type="text/javascript" src="<?php echo base_url() ?>recursos/js/data.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#reset").click(function(){
            $("#nombre").val("");
            $("#isFirst").val("-1")
            loadTable(1);
        });
    });
</script>
<div class='cleaner_h20'></div>
<div>
    <form id="FormSearch" method="post">
        Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id="nombre" name="nombre" placeholder="Buscar" class='span4'  style="margin-top: 8px;" value=''/>
        <button type="button" id="submit" class='btn primary'>Buscar</button>
        <button type="button" id="reset" class='btn'>Ver Todo</button>
    </form>
</div>
<button type="button" id="btnAdd" class='btn'><i class="icon-plus-sign"></i>&nbsp;Agregar</button>
<div class='cleaner_h20'></div>
<div style="border-bottom: 1px solid #dcdede ;padding: 3px"></div>
<input type="hidden" id="isFirst" value="-1" />
<input type="hidden" id="page" value="<?php echo $this->page ?>" />
<div id="contenData">
</div>