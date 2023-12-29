//Tp2-Ejercicio2.a
$(document).ready(function(){
    $("#boton").click(function(){
        var email = $("#email").val();
        var contrasenia =$("#password").val();
        $.ajax({
            data:{email,contrasenia},
            //url
            type:"post",
            beforeSend:function(){
                alert("Se ha enviado los datos");
            },
            success:function(response){
                $("email").html(response);
            }
        });
    });
}
);

