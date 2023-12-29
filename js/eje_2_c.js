//Tp2-Ejercicio 2.c
$(document).ready(function(){

    $("#logo").click(function(event){
        $("#logo").fadeOut(50);
        event.preventDefault();
        $("#logo").fadeIn(600).attr("src", "https://media.istockphoto.com/vectors/video-call-icon-logo-vector-illustration-video-call-icon-design-vector-id1219541164?k=20&m=1219541164&s=170667a&w=0&h=CMNai_rH5sWNcN9mTovBbuhWEFYy6X0Fc2aZDunFlqE=");  
       
    });
});