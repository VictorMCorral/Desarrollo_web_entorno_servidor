function f2(){
    console.log("Ultimo");
}


function f1(){
    return new Promise((resolve, reject) => {
        setTimeout(function () {
            console.log("Primero");
            resolve("Promesa resuelta");
            //reject("Error");
        }, 200);
    })
}

async function promesa() {
    await f1();
    f2();
}

promesa()