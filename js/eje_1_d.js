//captador,instanciador y llamada al metodo
function alert_user() {
    var email = document.getElementById("email").value;
    var contraseña = document.getElementById("password").value;
    //se crea instancia de usuario 
    var usuario = new Usuario(email, contraseña);
    // se llama al metodo que muestra la alerta
    usuario.alerta();
}
// Constructor clase usuario
function Usuario(email, contraseña) {
    this.email = email;
    this.contraseña = contraseña;
}
//metodo
Usuario.prototype.alerta = function () {
    alert("Email: " + this.email + "\nContraseña: " + this.contraseña);
};