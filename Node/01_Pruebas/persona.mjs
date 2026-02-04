export class Persona {
    constructor(nombre, apellidos, edad){
        this.nombre = nombre,
        this.apellidos = apellidos,
        this.edad = edad
    }

    mostrar(){
        return `Me llamo ${this.nombre} ${this.apellidos} y tengo ${this.edad} años`
    }
}