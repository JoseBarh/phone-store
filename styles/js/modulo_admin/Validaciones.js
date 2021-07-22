// permitir solo numeros
function soloNumeros(e){
    var key = e.keycode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    numeros = " 0123456789";
    especiales = [44,45,46];
    tecla_especial = false;

    for(var i in especiales){
        if(key == especiales){
            tecla_especial = true;
            break;
        }
    }

    if(numeros.indexOf(tecla) == -1 && !tecla_especial){
        return false;
    }
}

// permitir solo letras
function soloLetras(e){
    var key = e.keycode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [44,45,46];
    tecla_especial = false;

    for(var i in especiales){
        if(key == especiales){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial){
        return false;
    }

}