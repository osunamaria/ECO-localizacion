let contador=0;
function crearPublicacion(){
    if(contador%2==0){
        contador++;
        document.getElementById("eventoNoticia").style.visibility="visible";
    }else{
        contador++;
        document.getElementById("eventoNoticia").style.visibility="hidden";
    }
}
