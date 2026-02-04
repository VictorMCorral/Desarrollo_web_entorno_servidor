function sumar (a,b){
    return a+ b;
}
function restar (a,b){
    return a - b;
}
function multiplicar (a,b){
    return a * b;
}
function dividir (a,b){
    if(b === 0) {
        // return new Error("No se puede dividir por 0");
        return "No se puede dividir por 0";
    }    
    return a/ b;
}

module.exports = {
    sumar: sumar,
    restar: restar,
    multiplicar: multiplicar,
    dividir: dividir
}
