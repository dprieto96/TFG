import { PALABRAS as palabras } from './lista_palabras.js';

let inicio=undefined;
let final=undefined;
let tiempoObjetivo_minutos=3; //minutos
let tiempoObjetivo= tiempoObjetivo_minutos*60;
let puntuacion=0;
var DateTime = luxon.DateTime;
let temporizador;


const indiceAleatorio = Math.floor(Math.random() * palabras.length);
const palabra_aleatoria=palabras[indiceAleatorio];
const modal = true;
//---------GENERAL CONTROL PANEL---------

const FILAS=6;//Corresponde también al número de intentos
const COLUMNAS=palabra_aleatoria.length;

//---------------------------------------
let intentos_restantes=FILAS;
//let letras_usadas=[]//Lista que contendrá las letras ya usadas
let letra_actual=0;
let GANAR=false;

//Palabra que hay que adivinar
let palabra_correcta=Array.from(palabra_aleatoria);

//Letras acertadas al comprobar los intentos
let letras_acertadas = new Array(palabra_aleatoria.length);

//Letras desbloqueadas con el botón
let letras_desbloqueadas = new Array(palabra_aleatoria.length);

//Letras usadas en el intento actual
let letras_usadas = new Array(palabra_aleatoria.length);


const feedbackImages = [
    "/TFG/public/img/"+palabra_aleatoria+"/1.webp",
    "/TFG/public/img/"+palabra_aleatoria+"/2.webp",
    "/TFG/public/img/"+palabra_aleatoria+"/3.webp",
    "/TFG/public/img/"+palabra_aleatoria+"/4.webp",
    "/TFG/public/img/"+palabra_aleatoria+"/5.webp",
    "/TFG/public/img/"+palabra_aleatoria+"/6.webp",
];
let currentFeedbackImageIndex = 0;


main();

function iniciarTemporizador() {
    inicio = DateTime.local();
    actualizarTemporizador();
    temporizador = setInterval(() => {
        const tiempoTranscurrido = DateTime.local().diff(inicio, 'seconds').seconds;
        if (tiempoTranscurrido >= tiempoObjetivo) {
            detenerTemporizador();
            final = DateTime.local();
            const tiempoTardado = final.diff(inicio, 'milliseconds').milliseconds;
            puntuacion_calculo(tiempoTardado);
            popup_perdedor(tiempoTardado / 1000);
        } else {
            actualizarTemporizador();
        }
    }, 1000);
}

function detenerTemporizador() {
    clearInterval(temporizador);
}

function actualizarTemporizador() {
    const tiempoTranscurrido = Math.floor(DateTime.local().diff(inicio, 'seconds').seconds); // Ignora los milisegundos
    const segundosRestantes = tiempoObjetivo - tiempoTranscurrido;
    const minutos = Math.floor(segundosRestantes / 60);
    const segundos = segundosRestantes % 60;
    const temporizadorElement = document.getElementById('temporizador');
    temporizadorElement.textContent = `${minutos}:${segundos.toString().padStart(2, '0')}`; // Formatea los segundos con dos dígitos
}

function updateFeedbackImage() {
    const feedbackImage = document.getElementById("feedback-image");
    feedbackImage.src = feedbackImages[currentFeedbackImageIndex];
    currentFeedbackImageIndex = (currentFeedbackImageIndex + 1) % feedbackImages.length;
}

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

    //Inicializamos el array a 0 para después ir poniendo cada letra desbloqueada a 1
    for (let i = 0; i < letras_desbloqueadas.length; ++i){
        letras_desbloqueadas[i] = 0;
    }

    for (let i = 0; i < letras_acertadas.length; ++i){
        letras_acertadas[i] = 0;
    }

    for (let i = 0; i < letras_usadas.length; ++i){
        letras_usadas[i] = 0;
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
    //letras_usadas.pop();
    letras_usadas[letra_actual-1] = 0;
    letra_actual -= 1;
}


function partida_ganada(palabra_correcta){
    for(let i=0;i<COLUMNAS;i++){
        if(palabra_correcta[i]!="&"){
            letra_actual = 0;
            intentos_restantes -= 1;
            for (let i = 0; i < letras_usadas.length; ++i){
                letras_usadas[i] = 0;
            }
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
    //Calculo numero de letras son colocar
    let sinColocar = 0;
    for (let i = 0; i < letras_usadas.length; ++i){
        if (letras_usadas[i] == 0){
            sinColocar++;
        }
    }

    const popup_incompleto = new Popup({
        id: "incompleto",
        title: "Aviso",
        content: `Aún no has terminado,te faltan ${sinColocar} letras a colocar.`,
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
    //let palabra_correcta=Array.from(palabra_aleatoria);


    for (const val of letras_usadas) {
        palabra_introducida += val;
    }
    console.log("PALABRA: "+ palabra_introducida.length);

    let completa = 1;
    for (let i = 0; i < letras_usadas.length; ++i){
        if (letras_usadas[i] == 0){
            completa = 0;
        }
    }

    if (completa == 0){
        popup_incompleto();
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
    for (let i = 0; i < COLUMNAS; i++) {
        if (palabra_correcta[i] == letras_usadas[i]) {
            color_letra[i] = "green";
            palabra_correcta[i] = "&";
            letras_acertadas[i] = 1;
        }
    }
    
    //Comprueba el resto
    for (let i = 0; i < COLUMNAS; i++) {
        if (color_letra[i] == "green") continue;

        //Comprueba la letra es correcta
        for (let j = 0; j < COLUMNAS; j++) {
            if (palabra_correcta[j] == letras_usadas[i]) {
                color_letra[i] = "yellow";
                //palabra_correcta[j] = "&";
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
        detenerTemporizador();
        final=DateTime.local();
        let tiempo_tardado=final-inicio;
        puntuacion_calculo(tiempo_tardado);
        popup_ganador(tiempo_tardado/1000);

        //Para que al acertar se pueda ver la imagen sin pixelar
        currentFeedbackImageIndex = feedbackImages.length-1;

    }

    if (intentos_restantes === 0 ) {
        popup_perdedor();
        return;
    }
    else{
        //Actualizar imagen pixelada
        updateFeedbackImage();
    }

    palabra_correcta=Array.from(palabra_aleatoria);

    for (let i = 0; i < letras_desbloqueadas.length; ++i){
        letras_desbloqueadas[i] = 0;
    }

}

function añade_letra(tecla){
    tecla = tecla.toLowerCase();
    let fila = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let caja = fila.children[letra_actual];
    caja.textContent=tecla;
    caja.classList.add("filled-box");
    //letras_usadas.push(tecla);
    letras_usadas[letra_actual] = tecla;
    letra_actual += 1;
    
    let completa = 1;
    for (let i = 0; i < letras_usadas.length; ++i){
        if (letras_usadas[i] == 0){
            completa = 0;
        }
    }

    if (completa == 1){
        comprueba();
    }
}

function añade_letra_desbloqueada(tecla, posicion){
    tecla = tecla.toLowerCase();
    let fila = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let caja = fila.children[posicion];
    caja.textContent=tecla;
    caja.classList.add("filled-box");
    //letras_usadas.push(tecla);
    letras_usadas[posicion] = tecla;
    //letra_actual += 1;
    
    let completa = 1;
    for (let i = 0; i < letras_usadas.length; ++i){
        if (letras_usadas[i] == 0){
            completa = 0;
        }
    }

    if (completa == 1){
        comprueba();
    }
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
        if (letras_desbloqueadas[letra_actual] == 1){
            while (letras_desbloqueadas[letra_actual] == 1){
                letra_actual++;
            }
            añade_letra(pressedKey);
        }
        else{
            añade_letra(pressedKey);
        }
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


function desbloquearLetraAleatoria() {
    //let palabra_correcta = Array.from(palabra_aleatoria);

    // Obtener las posiciones de las letras que aún no han sido adivinadas
    let posicionesNoAdivinadas = [];
    for (let i = 0; i < letras_acertadas.length; i++) {
        if (letras_acertadas[i] == 0 && letras_desbloqueadas[i] == 0 && letra_actual <= i) {
            posicionesNoAdivinadas.push(i);
        }
    }

    // Verificar si hay letras que desbloquear
    if (posicionesNoAdivinadas.length === 0) {
        // No hay letras para desbloquear
        return;
    }

    // Seleccionar aleatoriamente una posición no adivinada
    let posicionAleatoria = posicionesNoAdivinadas[Math.floor(Math.random() * posicionesNoAdivinadas.length)];

    //Añadir la letra
    añade_letra_desbloqueada(palabra_correcta[posicionAleatoria], posicionAleatoria);

    //Poner el fondo de la caja verde
    let fila_actual = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let caja = fila_actual.children[posicionAleatoria];
    caja.style.backgroundColor = 'green';

    // Marcar la letra como adivinada
    letras_desbloqueadas[posicionAleatoria] = 1;

    // Restar 10 segundos del temporizador
    const tiempoRestante = DateTime.local().diff(inicio, 'seconds').seconds;
    if (tiempoRestante > 10) {
        inicio = inicio.plus({ seconds: -10 });
    } else {
        inicio = inicio.set({ seconds: 0 });
    }
    actualizarTemporizador();
}


document.getElementById("desbloquear-letra-btn").addEventListener("click", () => {
    desbloquearLetraAleatoria();
});




function main(){
    console.log("La palabra es: "+ palabra_aleatoria)
    //inicio=Date.now();
    iniciarTemporizador();
    inicializar()
    updateFeedbackImage();
}