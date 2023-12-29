var miArray = new Array();

function concatenar (){    
    var valor = document.getElementById("texto").value;
    var delimitador = document.getElementById("delimitador").value;
    var resultado = document.getElementById("resultado").value;
    concat_replace_delimitador(valor,delimitador,resultado);
}

function concat_replace_delimitador (valor, delimitador,anterior){
     if (valor.length!="" && delimitador.length !=""){
         valor = valor.concat (delimitador);
         miArray.push(valor);
         document.getElementById("resultado").value = resultado;
     }

     document.getElementById("texto").value="";
     document.getElementById("delimitador").value="";
}

function mostrar (){
    alert (miArray);

}