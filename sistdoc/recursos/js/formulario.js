$(document).ready(function(){
    $("#btnCancel").click(function(){
        var c=confirm("Desea Salir del Forumlario");
        if(c){
            cerrarPopUp();
        }
    });
    $("#btnSend").click(function(){
        $(".info1").fadeIn(600).fadeOut(600).fadeIn(600).fadeOut(800);
        var pathBase=pathSistdoc+page+"/guardar";
        $.ajax({
            type:"post",
            url:pathBase,
            data:$("#frmAdd").serialize(),
            success:function(resp){
                console.info("Rta :"+resp)
                if(resp>0){
                    $(".info2").fadeIn();
                    setTimeout("recargarPagina()",1000);
                }else{
                    $(".badge-warning").fadeIn();
                }
            }
        });
    });
});
function recargarPagina(){
    cerrarPopUp();
    loadTable(1);
}