import axios from "axios";

console.log();
let datos = [];


function cargarDatos(pagina, callback) {
    axios.get(`https://rickandmortyapi.com/api/character?page=${pagina}`)
        .then(response => {
            guardarDatos(response.data, datos);
            // callback();
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

function cargarDatosPromise(pagina) {
    if (pagina == 2) return;
    axios.get(`https://rickandmortyapi.com/api/character?page=${pagina}`)
        .then(response => {
            guardarDatos(response.data, datos);
            pagina = pagina + 1;
            cargarDatosPromise(2);
            console.log(datos);
        })
        .catch(error => {
            console.log(error);
        })
}

// cargarDatos(1, () => {
//     cargarDatos(2, () => {console.log(datos)})
// });



// cargarDatosPromise(1);


async function cargarDatos2(pagina) {
    const datos = await axios.get(`https://rickandmortyapi.com/api/character?page=${pagina}`)
    return datos.data;
}

function guardarDatos2(response) {
    datos.push(...response.results.map(p => p.name));
};

async function nombres(pagina, limite) {
    if(pagina > limite) return;
    const datosPagina = await cargarDatos2(pagina);
    guardarDatos2(datosPagina);

    nombres(pagina + 1, limite);

    if(pagina === limite) console.log(datos);
}

nombres(1,4);