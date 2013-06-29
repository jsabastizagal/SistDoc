var page="";
$(document).ready(function(){
    page=$("#page").val();
    loadTable("-1");
    $("#btnAdd").click(function(){
        agregarDatos();
    });
    $("#submit").click(function(){
        loadTable(1);
    });
    $("#nombre").keyup(function(){
        $("#isFirst").val("-1")
        loadTable(1);
    });    
});

function agregarDatos(){
    mostrarPopUp(page+"/NuevoEditar","");
}

function loadTable(v){
    var _data=$("#FormSearch").serialize();
    var p=pathSistdoc+page+"/Tabla/"+v+"/";
    console.info(pathSistdoc)
    if($("#isFirst").val()!=-1){
        var np=$("#CurPage").val();
        var st=$("#stepPage").val();
        p=pathSistdoc+page+"/Tabla/"+v+"/"+(Number(np)+Number(st));
    }
    $.ajax({
        type:"post",
        data:_data,
        url:p,
        success:function(resp){
            $("#contenData").html(resp);
            $("#isFirst").val(1);
        }
    });
}