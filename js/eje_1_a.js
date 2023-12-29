function concat_replace(srt_ini, str_fin, str_needle, str_to){
    var str_replace = "";
    str_concat=srt_ini+str_fin;
    if(str_needle!="" && str_to!=""){
        str_replace= str_replace.replace(str_needle,str_to);
    }
    document.getElementById("resultado").value = str_concat +" " + str_replace;
}
