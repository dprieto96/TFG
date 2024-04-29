/**
 * Escena de Título.
 * @extends Phaser.Scene
 */

import Nivel from "../Nivel.js"
import Utils from "../../Utils.js"
import Spaceship from '../../obj/player/Spaceship.js';
import Asteroid from "../../obj/Asteroid.js";
import Bullet from "../../obj/player/Bullet.js"

export default class NivelVertical extends Nivel {
	/**
	 * Escena principal.
	 * @extends Phaser.Scene
	 */

	constructor(ctrl) {
		super("nivelVertical"+Utils.digitsToStr(ctrl.getCurrentVId(),2),ctrl);

	}


	init(){}



	/**
	 * Cargamos todos los assets que vamos a necesitar
	 */
	preload(){
		super.preload();


		let url = 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/dist/rexvirtualjoystickplugin.min.js';
   	    this.load.plugin('rexvirtualjoystickplugin', url, true);

		this.load.atlas('verticalAtlas', Utils.getImgV("templates"), Utils.getJson("verticalLevelElements"));
		this.destination = this.st["destination"];

		this.load.image('background', 'assets/img/verticalLevels/background.jpg');

		this.player = new Spaceship(this,SPACESHIP_INIT_X, SPACESHIP_INIT_Y);
		
		this.extraBullets=0;
		this.gameState='runnung';


		
	}
	
	/**
	 * Creación de los elementos de la escena principal de juego
	*/
	create() {
		super.create();

		this.scene.bringToTop('PauseScene');
		this.scene.bringToTop('gameOverScene');



		//console.log('ESTADO MOBILE: '+Utils.isMobile());
		this.dispara=false;
		this.rect = this.add.rectangle(
			this.game.config.width-200 ,  // X central
			320,                           // Y superior
			this.game.config.width / 2,  // Ancho mitad derecha
			this.game.config.height,     // Altura pantalla completa
			0xffffff,                    // Color de relleno blanco
  			0
		  );



		this.background = this.add.image(0, 0, 'background').setOrigin(0);

		// Escala la imagen de fondo para que ocupe toda la pantalla
		this.background.setScale(this.game.config.width / this.background.width, this.game.config.height / this.background.height);

		
		//JOYSTICK
	  
		this.joyStick = this.plugins.get('rexvirtualjoystickplugin').add(this, {
			x: 155,
			y: SCREEN_HEIGHT-155,
			radius: 100,
			base: this.add.circle(0, 0, 50, 0x888888),
			thumb: this.add.circle(0, 0, 25, 0xcccccc),
	  });

	  this.joystickCursors = this.joyStick.createCursorKeys();

	  this.jostickmovement='null';




		
		this.scaleProgress=3.5;
		this.clave=this.key;



		this.numLifes=0;



		this.player.create();	

		this.enemiesGroup = this.add.group();
		this.physics.world.gravity.y = 0;
		
        this.density  = this.st["density"];
        this.thrownAsteroids = 0;
		this.distanceReached = 0;
		this.musicStarted = false;

		this.cursors = this.input.keyboard.createCursorKeys();
		this.bulletsGroup = new Bullet(this.physics.world, this);
		Utils.createAnimFromAtlas(this, "boomBeach", "verticalAtlas", "boom", 8, 2, 20, 0);

		this.physics.world.setBounds(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT);

		this.physics.add.collider(this.enemiesGroup,this.enemiesGroup);
		this.physics.add.collider(this.bulletsGroup, this.enemiesGroup, this.hitEnemies, null, this);
		this.physics.add.collider(this.enemiesGroup, this.player, this.hitPlayer, null, this);

		// Crear el texto del contador en el centro superior de la pantalla
		//this.timerText = this.add.text(this.cameras.main.centerX, 10, 'Puntuación: 0', { font: '24px Arial', fill: '#ffffff' }).setOrigin(0.5, 0);
		this.timerText = this.add.text(this.cameras.main.centerX, 10, 'Puntuación: 0', {
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
		// Iniciar el contador de tiempo
		this.startTime = 0;

		// Evento que se ejecuta cada segundo para actualizar el tiempo
		this.time.addEvent({
			delay: 1000, // 1000 milisegundos = 1 segundo
			callback: this.updateTimer,
			callbackScope: this,
			loop: true
		});
	}

	 

	colision(){
		// calcula el ángulo de la colisión
		this.angle = Phaser.Math.Angle.Between(this.player.x, this.player.y, this.enemiesGroup.x, this.enemiesGroup.y);
		
		// ajusta los vectores de velocidad de los objetos
		this.player.speedX = Math.cos(this.angle) * this.player.speed;
		this.player.speedY = Math.sin(this.angle) * this.player.speed;
	  }

	updateTimer() {
		this.startTime++; // Incrementar el contador de tiempo
		this.timerText.setText(`Puntuación: ${this.startTime}`); // Actualizar el texto del contador
	}

	generateEnemy() {
		//generar una nueva roca:
		if(this.enemiesGroup.getLength() < this.density && this.distanceReached + 200 < this.st["levelLength"] ){
			// determina una posición aleatoria para el nuevo enemigo
			let newX = Phaser.Math.Between(0, this.game.config.width);

			// crea un nuevo enemigo en la posición aleatoria y agrégalo al grupo de enemigos
			let id = Math.floor(Phaser.Math.Between(1, 3));
			let signX 		 = Math.floor(Phaser.Math.Between(0,1)) % 2 == 0 ? -1 : 1;
			let signRotation = Math.floor(Phaser.Math.Between(0,1)) % 2 == 0 ? -1 : 1;
			let newVector = [
				Math.floor(Phaser.Math.Between(this.st["rockMinSpeedX"],this.st["rockMaxSpeedX"]))*signX,
				Math.floor(Phaser.Math.Between(this.st["rockMinSpeedY"],this.st["rockMaxSpeedY"])),
				(Math.random()*8+5)*signRotation
			]
			this.newAsteroid = new Asteroid(this, newX, 60, "asteroid0"+id, newVector);
			this.newAsteroid.create();


			this.enemiesGroup.add(this.newAsteroid);
        }

		//comprobar si se sale del mapa para eliminar la roca:
        for (let i = 0; i < this.enemiesGroup.getLength(); i++){
			let child = this.enemiesGroup.getChildren()[i];
            if(child.y >= VERTICAL_LEVELS_HEIGHT || child.x >= VERTICAL_LEVELS_WIDTH || child.x < 0){
				this.enemiesGroup.remove(child);
				this.thrownAsteroids++;
                i--;
            }
        }
	}

	fire(){ this.bulletsGroup.newItem(); }

	hitEnemies(enemy, bullet) {
		bullet.setVisible(false);
        bullet.setActive(false);
        bullet.destroy();

		enemy.setAngularVelocity(0);
		enemy.setVelocity(0,0);
		enemy.angle = 0;
		enemy.body.checkCollision.none = true;
		enemy.play("boomBeach");
		if(!Utils.isMute())this.musicEXPLOSION.play();
    }

	hitPlayer(enemy, player) {
		if(this.numLifes>=0)this.numLifes--;
		enemy.setAngularVelocity(0);
		enemy.setVelocity(0,0);
		enemy.angle = 0;
		enemy.body.checkCollision.none = true;

    }

	handleMovement(){
		let jt = false;
		let txt = "";
		if (this.joystickCursors.up.isDown)   	   { txt = 'UP';    jt = true; }
		else if (this.joystickCursors.down.isDown) { txt = 'DOWN';  jt = true; }

		if (this.joystickCursors.left.isDown) 	   { txt = 'LEFT';  jt = true; }
		else if (this.joystickCursors.right.isDown){ txt = 'RIGHT'; jt = true; }
		this.jostickmovement = txt;
		
		this.player.jostickMovement(this.jostickmovement);
		this.player.handleMovement();
		this.jostickmovement='null';
	}


    update(){
		super.update();

		if(this.numLifes<0){

			this.scene.launch('gameOverScene',{
				clave:this.clave,
				finalTime: this.startTime});

			this.scene.pause(this.key);
			this.gameState = 'paused';
		}
			this.generateEnemy();
			if (!this.checkEndOfGame() || this.enemiesGroup.getLength() > 0) {
				this.handleMovement();
				this.player.handleMovement();
		}
	}


		
	victoryCondition(){ return this.distanceReached >= this.st["levelLength"]; }
}