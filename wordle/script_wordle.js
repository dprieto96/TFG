import { WORDS as palabras } from './words.js';


const indiceAleatorio = Math.floor(Math.random() * palabras.length);
let palabra_aleatoria=palabras[indiceAleatorio];

//---------GENERAL CONTROL PANEL---------

const FILAS=6;//Corresponde también al número de intentos
const COLUMNAS=palabra_aleatoria.length;

//---------------------------------------
let intentos_restantes=FILAS;
let letras_usadas=[]//Lista que contendrá las letras ya usadas
let letra_actual=0;

function inicializar(){
    let tablero=document.getElementById("game-board");

    //Creación de la matriz/tablero
    for(let i=0; i<FILAS; i++) {//Creacion de los <di> para las filas
        let fila = document.createElement("div");
        fila.className = "letter-row";

        for (let j=0; j < COLUMNAS; j++) {
            let caja=document.createElement("div");
            caja.className="letter-box";
            fila.appendChild(caja);
        }
        tablero.appendChild(fila);
    }

}

function colorFondo(letra,color){
    console.log("ENTRA");
    for (const elem of document.getElementsByClassName("keyboard-button")) {
        if (elem.textContent === letra) {
            let anteriorColor = elem.style.backgroundColor;
            //Si antes era verde -> Sigue siendo verde
            if (anteriorColor === "green") {
                return;
            }
            //Si antes era amarillo y ahora no es verde -> Sigue siendo amarillo
            if (anteriorColor === "yellow" && color !== "green") {
                return;
            }
            //Si era gris  y ahora verde, amarillo, o gris, conserva este último color -> cambia
            elem.style.backgroundColor = color;
            break;
        }
    }
}

function borrar() {
    let row = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let box = row.children[letra_actual - 1];
    box.textContent = "";
    box.classList.remove("filled-box");
    letras_usadas.pop();
    letra_actual -= 1;
}

function comprueba(){
    let fila_actual = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let palabra_introducida="";
    let palabra_correcta=Array.from(palabra_aleatoria);

    for (const val of letras_usadas) {
        palabra_introducida += val;
    }

    if(palabra_introducida.length != COLUMNAS){
        toastr.error("Te faltan letras");
        return;
    }
    
    
    let color_letra=[];
    for (let i = 0; i < COLUMNAS; i++) {
        color_letra.push("gray");
    }

    for (let i = 0; i < COLUMNAS; i++) {
        color_letra.push("gray");
    }

    //Comprueba las verdes
    for (let i = 0; i < 5; i++) {
        if (palabra_correcta[i] == letras_usadas[i]) {
            color_letra[i] = "green";
            palabra_correcta[i] = "#";
        }
    }
    
    //Comprueba el resto
    for (let i = 0; i < COLUMNAS; i++) {
        if (color_letra[i] == "green") continue;

        //Comprueba la letra es correcta
        for (let j = 0; j < COLUMNAS; j++) {
            if (palabra_correcta[j] == letras_usadas[i]) {
                color_letra[i] = "yellow";
                palabra_correcta[j] = "#";
            }
        }
    }

    for (let i = 0; i < COLUMNAS; i++) {
        let caja = fila_actual.children[i];
        caja.style.backgroundColor = color_letra[i];
        colorFondo(palabra_introducida.charAt(i) + "",color_letra[i]);
    }
    
    if(palabra_introducida===palabra_correcta){//=== formato y contenido
        toastr.success("HAS GANADO");
        intentos_restantes = 0;
        return;
    }

    else {
        intentos_restantes -= 1;
        letras_usadas = [];
        letra_actual = 0;

        if (intentos_restantes === 0) {
            toastr.error("No te quedan intentos");
            toastr.info(`The right word was: "${palabra_aleatoria}"`);
        }
    }

}

function añade_letra(tecla){
    if (letra_actual === COLUMNAS) {
        return;
    }
    tecla = tecla.toLowerCase();
    let fila = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let caja = fila.children[letra_actual];
    caja.textContent=tecla;
    caja.classList.add("filled-box");
    letras_usadas.push(tecla);
    letra_actual += 1;
}

document.addEventListener("keyup", (e) => {
    if (intentos_restantes === 0) {
        return;
    }

    let pressedKey = String(e.key);
    if (pressedKey === "Backspace" && letra_actual !== 0) {
        borrar();
        return;
    }

    if (pressedKey === "Enter") {
        comprueba();
        return;
    }

    let found = pressedKey.match(/[a-z]/gi);
    if (!found || found.length > 1) {
        return;
    } else {
        añade_letra(pressedKey);
    }
});

document.getElementById("keyboard-cont").addEventListener("click", (e) => {
    const target = e.target;

    if (!target.classList.contains("keyboard-button")) {
        return;
    }
    let key = target.textContent;

    if (key === "Del") {
        key = "Backspace";
    }
    document.dispatchEvent(new KeyboardEvent("keyup", { key: key }));
});

inicializar();