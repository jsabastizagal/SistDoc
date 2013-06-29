//var pathSistdoc="http://localhost/sistdoc/index.php/";
var pathSistdoc="http://lstr.huahcoding.com/sistdoc/index.php/";
var _TMP="";
var _TMPOA="";
function mostrarPopUp(p,_data){
    $("#popup").fadeIn();
    var pathBase=pathSistdoc+p;
    $.ajax({
        type:"post",
        url:pathBase,
        data:_data,
        success:function(resp){
            $("#cont-popup").html(resp);
        }
    });
    $("#cont-popup").fadeIn();
}
function cerrarPopUp(){
    $("#popup").fadeOut();
    $("#cont-popup").fadeOut();
    $("#cont-popup").html("");
}