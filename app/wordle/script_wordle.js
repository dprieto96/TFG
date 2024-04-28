import { PALABRAS as palabras } from './lista_palabras.js';

let inicio=undefined;
let final=undefined;
let tiempoObjetivo_minutos=3; //minutos
let tiempoObjetivo= tiempoObjetivo_minutos*60;
let puntuacion=0;
var DateTime = luxon.DateTime;
let temporizador;


//const indiceAleatorio = Math.floor(Math.random() * palabras.length);
//const palabra_aleatoria=palabras[indiceAleatorio];



const palabra_aleatoria = palabras[calcular_palabra()];

const modal = true;
//---------GENERAL CONTROL PANEL---------

const FILAS=6;//Corresponde también al número de intentos
const COLUMNAS=palabra_aleatoria.length;

//---------------------------------------
let intentos_restantes=FILAS;
//let letras_usadas=[]//Lista que contendrá las letras ya usadas
let letra_actual=0;
let GANAR=false;

//Segundos que se restan al pulsar los botones de desbloqueo y descarte de letra
const TIEMPO_DESBLOQUEO_LETRA = 10;
const TIEMPO_DESCARTE_LETRA = 5;
//Palabra que hay que adivinar
let palabra_correcta=Array.from(palabra_aleatoria);
//Letras acertadas al comprobar los intentos
let letras_acertadas = new Array(palabra_aleatoria.length);
//Letras desbloqueadas con el botón
let letras_desbloqueadas = new Array(palabra_aleatoria.length);
//Letras usadas en el intento actual
let letras_usadas = new Array(palabra_aleatoria.length);
//Todas las letras que se han usado en todos los intentos
let registro_letras = new Array();


let currentPixelRate = 0;

 //Inicialización foto
 let pixelRate = [0.95, 0.9, 0.85, 0.8, 0.7, 0.5, 0];
 var image = document.getElementById('feedback-image');
 image.src = "/TFG/public/img/fotos_reto/"+palabra_aleatoria+".webp";

 var pixelate = new Pixelate(image, {amount: pixelRate[currentPixelRate]});

main();

function calcular_palabra() {
    var fechaInicio = new Date(palabras[0]);
    var fechaActual = new Date();
    
    //Se calcula el numero de dias desde la fecha de inicio hasta la actual
    var unDiaEnMilisegundos = 1000 * 60 * 60 * 24;
    var diferenciaDias = Math.floor((fechaActual - fechaInicio) / unDiaEnMilisegundos);

    console.log("Han pasado", diferenciaDias, "días desde la fecha de inicio hasta hoy.");

    return diferenciaDias;
}

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
    const temporizadorElement = document.getElementById('timer');
    temporizadorElement.textContent = `${minutos}:${segundos.toString().padStart(2, '0')}`; // Formatea los segundos con dos dígitos

    //Si no queda suficiente tiempo para usar el botón de desbloqueo de palabra, lo bloqueamos
    if (segundosRestantes < TIEMPO_DESBLOQUEO_LETRA) {
        const botonDesbloqueo = document.getElementById('unlock-letter-btn');
        botonDesbloqueo.disabled = true;
        botonDesbloqueo.classList.add('bloqueado');
    }
    
    if (segundosRestantes < TIEMPO_DESCARTE_LETRA) {
        const botonDescarte = document.getElementById('discard-letter-btn');
        botonDescarte.disabled = true;
        botonDescarte.classList.add('bloqueado');
    }
}

function updateFeedbackImage() {

    pixelate.setAmount(pixelRate[currentPixelRate]).render();
    currentPixelRate++;
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


    //Mandamos por AJAX un POST para indicar que el usuario ha entrado al reto y que así si sale ya no pueda volver a entrar

    // Crear un objeto FormData para contener los datos
    var formData = new FormData();

    // Agregar los datos que deseas enviar al servidor
    formData.append('gana', '0');

    // Crear un objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Definir la función de respuesta
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Manejar la respuesta del servidor si es necesario
                console.log(xhr.responseText);
            } else {
                // Manejar errores de la solicitud AJAX
                console.error('Error al realizar la solicitud AJAX: ' + xhr.status);
            }
        }
    };

    // Abrir una solicitud POST al archivo PHP
    xhr.open('POST', 'controlChallenge.php', true);

    // No es necesario establecer el encabezado Content-Type para FormData

    // Enviar la solicitud con los datos
    xhr.send(formData);

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


    // Crear un objeto FormData para contener los datos
    var formData = new FormData();

    // Agregar los datos que deseas enviar al servidor
    formData.append('gana', '1');

    // Crear un objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Definir la función de respuesta
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Manejar la respuesta del servidor si es necesario
                console.log(xhr.responseText);
            } else {
                // Manejar errores de la solicitud AJAX
                console.error('Error al realizar la solicitud AJAX: ' + xhr.status);
            }
        }
    };

    // Abrir una solicitud POST al archivo PHP
    xhr.open('POST', 'controlChallenge.php', true);

    // No es necesario establecer el encabezado Content-Type para FormData

    // Enviar la solicitud con los datos
    xhr.send(formData);






    const popup_incompleto = new Popup({
        id: "ganador",
        title: "ENHORABUENA",
        content: `Lo has resuelto en ${tiempo_tardado.toFixed(1)} segundos, con lo que obtienes una puntuacion de ${puntuacion_calculo(tiempo_tardado)} puntos.
        {btn-popup-ganador}[                   Ver información de la palabra del día                    ]`,
        css: `
        .popup.ganador button {
            background-color: #345a18;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .popup.ganador button:hover{
            background-color: #789461;
        }`,
        loadCallback: () => {
            document.querySelector(".popup.ganador button").addEventListener("click", () => {
                window.location.href = "daily_info.php";
            });
        },
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
        pixelate.setAmount(0).render();

    }

    if (intentos_restantes === 0 ) {
        popup_perdedor();
        pixelate.setAmount(0).render();
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
    //Se mete la letra en el registro de letras usadas
    registro_letras.push(tecla);
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
    //Se mete la letra en el registro de letras usadas
    registro_letras.push(tecla);
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
    const tiempoTranscurrido = DateTime.local().diff(inicio, 'seconds').seconds;
    for (let i = 0; i < letras_acertadas.length; i++) {
        //Se comprueba que haya letras sin adivinar posteriores a la posición actual y que quede el tiempo necesario para restarlo
        if (letras_acertadas[i] == 0 && letras_desbloqueadas[i] == 0 && letra_actual <= i && tiempoTranscurrido < (tiempoObjetivo - TIEMPO_DESBLOQUEO_LETRA)) {
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

    //Poner el fondo de la caja y del teclado verde
    let fila_actual = document.getElementsByClassName("letter-row")[FILAS - intentos_restantes];
    let caja = fila_actual.children[posicionAleatoria];
    caja.style.backgroundColor = 'green';
    colorFondo(palabra_correcta[posicionAleatoria], "green");

    // Marcar la letra como adivinada
    letras_desbloqueadas[posicionAleatoria] = 1;

    // Restar TIEMPO_DESBLOQUEO_LETRA segundos del temporizador
    const tiempoRestante = DateTime.local().diff(inicio, 'seconds').seconds;
    if (tiempoRestante > TIEMPO_DESBLOQUEO_LETRA) {
        inicio = inicio.plus({ seconds: -TIEMPO_DESBLOQUEO_LETRA });
    } else {
        inicio = inicio.set({ seconds: 0 });
    }
    actualizarTemporizador();
}


document.getElementById("unlock-letter-btn").addEventListener("click", () => {
    desbloquearLetraAleatoria();
});


function generarLetraAleatoria(letrasDisponibles) {
    let letraAleatoria;

    //Se itera hasta encontrar una letra que no esté en la palabra a adivinar ni en las letras usadas
    do {
        letraAleatoria = letrasDisponibles[Math.floor(Math.random() * letrasDisponibles.length)];
    } while (palabra_aleatoria.includes(letraAleatoria));

    console.log("Letra aleatoria: " + letraAleatoria);

    return letraAleatoria;
}

function descartarLetraAleatoria() {
    const letrasDisponibles = 'abcdefghijklmnopqrstuvwxyzñ'.split('');

    //Se eliminan las letras que están en la palabra a adivinar
    for (const letra of palabra_correcta) {
        const index = letrasDisponibles.indexOf(letra);
        if (index !== -1) {
            letrasDisponibles.splice(index, 1);
        }
    }

    //Se eliminan las letras que están en el registro de letras usadas
    for (const letra of registro_letras) {
        const index = letrasDisponibles.indexOf(letra);
        if (index !== -1) {
            letrasDisponibles.splice(index, 1);
        }
    }
    console.log("letrasDisponibles: " + letrasDisponibles);

    //Se genera la letra aleatoria de las disponibles que quedan
    let letraDescartada = generarLetraAleatoria(letrasDisponibles);

    if (letraDescartada === undefined){
        const botonDesbloqueo = document.getElementById('discard-letter-btn');
        botonDesbloqueo.disabled = true;
        botonDesbloqueo.classList.add('bloqueado');
    }
    else{
        //Se agrega la letra descartada al teclado con color gris
        colorFondo(letraDescartada, "gray");

        //Se añade la letra al registro de letras usadas
        registro_letras.push(letraDescartada);

        //Se resta TIEMPO_DESCARTE_LETRA segundos del temporizador
        const tiempoRestante = DateTime.local().diff(inicio, 'seconds').seconds;
        if (tiempoRestante > TIEMPO_DESCARTE_LETRA) {
            inicio = inicio.plus({ seconds: -TIEMPO_DESCARTE_LETRA });
        } else {
            inicio = inicio.set({ seconds: 0 });
        }
        actualizarTemporizador();
    }
}

document.getElementById("discard-letter-btn").addEventListener("click", () => {
    descartarLetraAleatoria();
});




function main(){
    console.log("La palabra es: "+ palabra_aleatoria)
    //inicio=Date.now();
    iniciarTemporizador();
    inicializar()
    updateFeedbackImage();
}