document.addEventListener('DOMContentLoaded', function() {

    //Elementos recogidos por id

    var formInicio = document.getElementById("formInicio");
    var formRegistro = document.getElementById("formRegistro");
    var registro = document.getElementById("registro");
    var inicio = document.getElementById("inicio");

    //Lista de eventos

    inicio.addEventListener("click", mostrarForm2);
    registro.addEventListener("click", mostrarForm1);

    //Funciones

    //Cambiar formulario

    function mostrarForm1() {
        formInicio.setAttribute("class", "oculto");
        formRegistro.removeAttribute("class");
        inicio.removeAttribute("class");
        registro.setAttribute("class", "subrayado");
    }

    function mostrarForm2() {
        formRegistro.setAttribute("class", "oculto");
        formInicio.setAttribute("class", "formIni");
        registro.removeAttribute("class");
        inicio.setAttribute("class", "subrayado");
    }

});