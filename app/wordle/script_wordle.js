import { PALABRAS as palabras } from './lista_palabras.js';

let inicio=undefined;
let final=undefined;
let tiempoObjetivo_minutos=3; //minutos
let tiempoObjetivo= tiempoObjetivo_minutos*60;
let puntuacion=0;


const indiceAleatorio = Math.floor(Math.random() * palabras.length);
const palabra_aleatoria=palabras[indiceAleatorio];
const modal = true;
//---------GENERAL CONTROL PANEL---------

const FILAS=6;//Corresponde también al número de intentos
const COLUMNAS=palabra_aleatoria.length;

//---------------------------------------
let intentos_restantes=FILAS;
let letras_usadas=[]//Lista que contendrá las letras ya usadas
let letra_actual=0;
let GANAR=false;


main();

function inicializar(){
    let tablero=document.getElementById("game-board");

    //Creación de la matriz/tablero
    for(let i=0; i<FILAS; i++) {//Creacion de los <di> para las filas
        const fila = document.createElement("div");
        fila.className = "letter-row";

        for (let j=0; j < COLUMNAS; j++) {
            const caja=document.createElement("div");
            caja.className="letter-box";
            fila.appendChild(caja);
        }

        tablero.appendChild(fila);
    }

}

function colorFondo(letra,color){
    //console.log("ENTRA");
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


function partida_ganada(palabra_correcta){
    for(let i=0;i<COLUMNAS;i++){
        if(palabra_correcta[i]!="&"){
            letra_actual = 0;
            intentos_restantes -= 1;
            letras_usadas = [];
            return false;
        }
    }
    return true;
}

function puntuacion_calculo(tiempo_tarrdado){
    if(tiempo_tarrdado>tiempoObjetivo){
        return 0;
    }
    puntuacion=1-(tiempo_tarrdado/tiempoObjetivo)
    puntuacion*=100;
    return puntuacion.toFixed(0) ;
}

function popup_incompleto(){
    const popup_incompleto = new Popup({
        id: "incompleto",
        title: "Aviso",
        content: `Aún no has terminado,te faltan ${COLUMNAS-letra_actual} letras a colocar.`,
    });
    while (popup_incompleto.show());
}

function popup_ganador(tiempo_tardado){
    const popup_incompleto = new Popup({
        id: "ganador",
        title: "ENHORABUENA",
        content: `Lo has resuelto en ${tiempo_tardado.toFixed(1)} segundos, con lo que obtienes una puntuacion de ${puntuacion_calculo(tiempo_tardado)} puntos`,
    });
    while (popup_incompleto.show());
}

function popup_perdedor(){
    const popup_incompleto = new Popup({
        id: "perdedor",
        title: "HAS PERDIDO",
        content: `La palabra era ${palabra_aleatoria} `,
    });
    while (popup_incompleto.show());
}


function comprueba(){
    let fila_actual = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let palabra_introducida="";
    let palabra_correcta=Array.from(palabra_aleatoria);


    for (const val of letras_usadas) {
        palabra_introducida += val;
    }
    console.log("PALABRA: "+ palabra_introducida.length);
    if (palabra_introducida.length !== COLUMNAS) {
        popup_incompleto();
        return ;
    }


    let color_letra=[];
    for (let i = 0; i < COLUMNAS; i++) {
        color_letra.push("gray");
    }

    for (let i = 0; i < COLUMNAS; i++) {
        color_letra.push("gray");
    }

    //Comprueba las verdes
    for (let i = 0; i < COLUMNAS; i++) {
        if (palabra_correcta[i] == letras_usadas[i]) {
            color_letra[i] = "green";
            palabra_correcta[i] = "&";
        }
    }
    
    //Comprueba el resto
    for (let i = 0; i < COLUMNAS; i++) {
        if (color_letra[i] == "green") continue;

        //Comprueba la letra es correcta
        for (let j = 0; j < COLUMNAS; j++) {
            if (palabra_correcta[j] == letras_usadas[i]) {
                color_letra[i] = "yellow";
                palabra_correcta[j] = "&";
            }
        }
    }

    for (let i = 0; i < COLUMNAS; i++) {
        let caja = fila_actual.children[i];
        caja.style.backgroundColor = color_letra[i];
        colorFondo(palabra_introducida.charAt(i) + "",color_letra[i]);
    }
    console.log("palabra_introducida: "+palabra_introducida);
    console.log("palabra_correct: "+palabra_correcta)

    GANAR=partida_ganada(palabra_correcta);

    if(GANAR==true){
        final=Date.now();
        let tiempo_tardado=final-inicio;
        puntuacion_calculo(tiempo_tardado);
        popup_ganador(tiempo_tardado/1000);

    }

    if (intentos_restantes === 0 ) {
        popup_perdedor();
        return;
    }

}

function añade_letra(tecla){
    tecla = tecla.toLowerCase();
    let fila = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let caja = fila.children[letra_actual];
    caja.textContent=tecla;
    caja.classList.add("filled-box");
    letras_usadas.push(tecla);
    letra_actual += 1;
    if (letra_actual===COLUMNAS) comprueba()
}

document.addEventListener("keyup", (e) => {
    let pressedKey = String(e.key);
    if (pressedKey === "Backspace" && letra_actual !== 0) {
        borrar();
        return;
    }
    if (pressedKey === "Enter") {
        comprueba();
        return;
    }
    let found = pressedKey.match(/[a-zñ]/gi);
    if (!found || found.length > 1) {
        return;
    } else {
        añade_letra(pressedKey);
    }
});

document.getElementById("keyboard-cont").addEventListener("click", (e) => {
    const keyboardContainer = document.getElementById("keyboard-cont");
    const target = e.target;
    const handleKeyboardClick = (event) => {
        const { key } = event.target.dataset; // Obtener la tecla directamente del dataset
        if (key) {
            document.dispatchEvent(new KeyboardEvent("keyup", { key }));
        }
    };
    keyboardContainer.addEventListener("click", handleKeyboardClick);
    if (!target.classList.contains("keyboard-button")) {
        return;
    }
    let key = target.textContent;

    if (key === "Del") {
        key = "Backspace";
    }
    document.dispatchEvent(new KeyboardEvent("keyup", { key: key }));
});

function main(){
    console.log("La palabra es: "+ palabra_aleatoria)
    inicio=Date.now();
    inicializar()
}