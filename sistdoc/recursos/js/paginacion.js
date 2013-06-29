$(document).ready(function(){
    var NP="";
    var TP="";
    if($("#NumPage").val()==1){
        $("#btnFirst").removeClass("btn").addClass("btnDis");
        $("#btnBefore").removeClass("btn").addClass("btnDis");
        $("#btnNext").removeClass("btn").addClass("btnDis");
        $("#btnLast").removeClass("btn").addClass("btnDis");
    }else{
        if($("#CurPage").val()==1){
            $("#btnFirst").removeClass("btn").addClass("btnDis");
            $("#btnBefore").removeClass("btn").addClass("btnDis");
        }else if($("#CurPage").val()==$("#NumPage").val()){
            $("#btnNext").removeClass("btn").addClass("btnDis");
            $("#btnLast").removeClass("btn").addClass("btnDis");
        }
    }
    $("#pageBox").focus(function(){
        var d=$("#pageBox").val().split(" de ");
        NP=d[0];
        TP=d[1];
        $("#pageBox").val(NP)
    });
    $("#pageBox").blur(function(){
        var r=/^[1-9]{1,5}$/;
        var tmp=$("#pageBox").val();
        if(!r.test(tmp)){
            $("#pageBox").val(NP+" de "+TP)
        }else{
            if(tmp==NP){
                $("#pageBox").val(NP+" de "+TP)
            }else if(Number(tmp)>Number(TP)){
                $("#pageBox").val(NP+" de "+TP)
            }else if(Number(tmp)<1){
                $("#pageBox").val(NP+" de "+TP)
            }else{
                var P=(((Number($("#CurPage").val()))-Number(tmp))*(-1));
                $("#stepPage").val(P);
                loadTable(-1);
            }
        }
    });
});
function btnPagination(id){
    if($("#"+id).attr("class")=="btn"){
        if(id=="btnFirst"){
            $("#stepPage").val(-(Number($("#CurPage").val()))+1);
        }else if(id=="btnBefore"){
            $("#stepPage").val(-1);
        }else if(id=="btnNext"){
            $("#stepPage").val(1);
        }else{
            $("#stepPage").val(+Number($("#NumPage").val())-Number($("#CurPage").val()));
        }
        loadTable(-1);
    }
}