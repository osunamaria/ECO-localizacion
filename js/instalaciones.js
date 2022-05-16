let contador=0;
function crearInstalacion(){
    if(contador%2==0){
        contador++;
        document.getElementById("nombreInstalacion").style.visibility="visible";
    }else{
        contador++;
        document.getElementById("nombreInstalacion").style.visibility="hidden";
    }
}