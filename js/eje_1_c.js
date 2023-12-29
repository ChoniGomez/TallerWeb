function captador () {
    var usuario = document.getElementById("usuario").value;
    valid_user (usuario);
}

function valid_user(str_nom){
     var valido =/^\w{6}\d{2}$/;
    // \w incluye todas las letras mayusculas y minusculas y \d digitos del 1 al 9
    if(valido.test(str_nom)){
        document.getElementById("valido").innerHTML= "es valido";
        document.getElementById("noValido").innerHTML= "";
    }
    else {
        document.getElementById("noValido").innerHTML= "no es valido";
        document.getElementById("valido").innerHTML= "";
    }

}

