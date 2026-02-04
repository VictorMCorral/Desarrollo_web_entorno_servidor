import axios from "axios";

console.log();
let datos = [];


function cargarDatos(pagina, callback) {
    axios.get(`https://rickandmortyapi.com/api/character?page=${pagina}`)
        .then(response => {
            guardarDatos(response.data, datos);
            callback();
        })
        .catch(error => {
            console.log(error);
        })
}

function guardarDatos(response, datos) {
    response.results.forEach(personaje => {
        datos.push(personaje.name);
    });
};



cargarDatos(1, () => {
    cargarDatos(2, () => {console.log(datos)})
});



function cargarDatosPromise(pagina) {
    if(pagina==2 ) return;
    axios.get(`https://rickandmortyapi.com/api/character?page=${pagina}`)
        .then(response => {
            guardarDatos(response.data, datos);
            pagina = pagina +1;
            cargarDatosPromise(2);
            console.log(datos);
        })
        .catch(error => {
            console.log(error);
        })
}

cargarDatosPromise(1);
