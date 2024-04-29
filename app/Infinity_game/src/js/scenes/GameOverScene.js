/**
 * Escena de Título.
 * @extends Phaser.Scene
 */


//import NivelVertical from "./verticalLevels/NivelVertical.js";
//import NivelVertical from "./verticalLevels/NivelVertical";
import Utils from "../Utils.js";

export default class GameOverScene extends Phaser.Scene{

	/**
	 * Escena principal.
	 * @extends Phaser.Scene
	 */
	constructor() {
		super({ key: 'gameOverScene' });   
        
	}

    init(settings){
        this.escena=settings.clave;
        this.finalTime = settings.finalTime;
    }


    preload(){
        
        this.load.image('gameover', 'assets/img/GAME-OVER.png');
        this.load.audio('goverSound', 'assets/music/bgm/goverSound.mp3');
        
    }

    create(){
        this.game.sound.stopAll();




        this.click=false;

        this.spacebar = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.SPACE);
        


        this.gameOver=this.add.image(SCREEN_MAX_WIDTH/2+80,SCREEN_MAX_HEIGHT/2+80,'gameover');

        this.gameOver.setScale(0.8);

        this.textSTART=this.add.text(SCREEN_MAX_WIDTH/6,SCREEN_MAX_HEIGHT, "TOUCH SCREEN OR SPACEBAR TO RETRY ",{ fontStyle: 'strong',font: '30px Arial', fill: '#ffffff' });
        this.textSTART.setDepth(999);




        //Se manda con AJAX un mensaje para indicar que hay que cambiar la bd
        // Crear un objeto FormData para contener los datos
        var formData = new FormData();

        // Agregar los datos que deseas enviar al servidor
        formData.append('extraScore', this.finalTime);

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
        xhr.open('POST', 'addExtraScore.php', true);

        // Enviar la solicitud con los datos
        xhr.send(formData);



        //this.add.text(SCREEN_MAX_WIDTH/2, 10, `Tiempo Final: ${this.finalTime}`, { font: '24px Arial', fill: '#ffffff' });
        this.timerText = this.add.text(this.cameras.main.centerX, 10, `¡Enhorabuena! has conseguido: ${this.finalTime} puntos`, {
            font: '28px "Press Start 2P"', // Cambiar la fuente y el tamaño
            fill: '#ffffff', // Cambiar el color del texto
            stroke: '#000000', // Color del contorno
            strokeThickness: 4, // Grosor del contorno
            shadow: {
                offsetX: 2, // Desplazamiento horizontal de la sombra
                offsetY: 2, // Desplazamiento vertical de la sombra
                color: '#000', // Color de la sombra
                blur: 2, // Desenfoque de la sombra
                stroke: true, // Sombra para el contorno
                fill: true // Sombra para el relleno del texto
            }
        }).setOrigin(0.5, 0);
        this.input.on('pointerdown',()=>
            this.reload()

        );

        this.input.keyboard.on('keydown-SPACE', () =>
            this.reload())
        ;
    
    }

    reload(){
        this.scene.start(this.escena);
        this.scene.stop();
    }

    update(){
        super.update();
        //console.log('EL CLICK ESTA EN: '+this.click);

      /* if (Phaser.Input.Keyboard.JustDown(this.spacebar)|| this.click)
        {
            this.scene.start(this.escena);
            this.scene.stop();

        }*/

    }


}