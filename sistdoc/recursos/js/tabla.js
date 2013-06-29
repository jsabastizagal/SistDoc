$(document).ready(function(){
    $(".btnMod").click(function(){
        var id=$(this).attr("attr-aux");
        mostrarPopUp(page+"/NuevoEditar/"+id,"");
    });
    $(".btnEli").click(function(){
        var c=confirm("Esta a punto de eliminar esta fila ¿Desea Continuar?");
        if(c){
            var id=$(this).attr("attr-aux");
            var pathBase=pathSistdoc+page+"/eliminar/"+id;
            $.ajax({
                type:"post",
                url:pathBase,
                success:function(resp){
                    if(resp==1){
                        $("#isFirst").val("-1")
                        loadTable(1);
                    }else{
                        alert("No se pudo Eliminar")
                    }
                }
            });
        }
    });
});