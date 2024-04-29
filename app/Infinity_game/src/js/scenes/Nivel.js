/**
 * Escena de Título.
 * @extends Phaser.Scene
 */

import Utils from "../Utils.js"
export default class Nivel extends Phaser.Scene {
	/**
	 * Escena principal.
	 * @extends Phaser.Scene
	 */

	constructor(key, ctrl) {
		super({ key: key });
		this.bg 	= null;
		this.player = null;
		this.ctrl	= ctrl;
		this.key = key;
		
	}
	
	/**
	 * Cargamos todos los assets que vamos a necesitar
	*/
	preload(){
		//this.load.image('background', getImg("universeBg"));
		this.load.spritesheet("spaceship",Utils.getImgV("spaceship"), {frameWidth: SPACESHIP_WIDTH, frameHeight: SPACESHIP_HEIGHT});
		this.st	= this.ctrl.levelSettings[this.key];
		this.planet = this.st["planet"];
	}
	
	/**
	 * Creación de los elementos de la escena principal de juego
	*/
	create() {
		Utils.createKeyBindings(this);
		this.planetSettings = this.ctrl.planetSettings[this.planet]
		this.introDone   	= true;
		this.playerWon		= false;
		this.levelCleared   = false;
		this.bullets=0;


	}
	
	finishLevel(){
		console.log("Level '" + this.scene.key + "' cleared.");
		this.sp.reset();
		this.scene.stop(this.key);
		this.scene.resume("levelSelector");	
	}
	/**
	* Loop del juego
	*/
    update(){ 
		super.update();
		if(this.enter.isDown){ this.finishLevel(); }
	}

	playerIsDead() {return false; } //to be overriden by the subclasses
	victoryCondition(){ return false; } //to be overriden by the subclasses

	checkEndOfGame(){
		this.playerWon = this.victoryCondition();
		return this.playerIsDead() || this.playerWon;
	}
}