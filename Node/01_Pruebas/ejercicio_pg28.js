function f2(){
    console.log("Ultimo");
}

console.log();

function f1(){
    return new Promise((resolve, reject) => {
        setTimeout(function () {
            console.log("Primero");
            resolve("Promesa resuelta");
            //reject("Error");
        }, 200);
    })
}


f1().then((message)=>{
    f2();
})

f1().then(f2)