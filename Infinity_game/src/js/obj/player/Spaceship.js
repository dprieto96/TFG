//export default class Spaceship extends Phaser.GameObjects.Sprite{
import Player from "./Player.js";
import Utils from "../../Utils.js"
export default class Spaceship extends Player{
    createAnimations(){
        this.create_Anim("NE",        1,  1, SPACESHIP_MOVI_FR);
        this.create_Anim("leftNE",    41 ,  0, SPACESHIP_MOVI_FR);
        this.create_Anim("rightNE",   56,  0, SPACESHIP_IDLE_FR);
        this.create_Anim("UP",        100,  0, SPACESHIP_MOVI_FR);
        this.create_Anim("DOWN",      87,  0, SPACESHIP_MOVI_FR);
        this.create_Anim("leftUP",    43,  5, SPACESHIP_MOVI_FR);
        this.create_Anim("rightUP",  58, 0, SPACESHIP_MOVI_FR);
        this.create_Anim("leftDOWN", 42, 0, SPACESHIP_MOVI_FR);
        this.create_Anim("rightDOWN",57, 0, SPACESHIP_MOVI_FR);

    }

    constructor(scene, x, y){
        super(scene, x, y,"spaceship", SPACESHIP_MOVI_FR);
        
        //load of graphics:
        this.scene.load.spritesheet(this.graphicName,Utils.getImgV(this.graphicName), {
            frameWidth: SPACESHIP_WIDTH,
            frameHeight: SPACESHIP_HEIGHT
        });
    }
    create(){
        //this.setTexture(this.graphicName);

       // this.setFrame(this.initFrame);
        this.createAnimations();

        this.scene.physics.add.existing(this);
        this.scene.physics.world.enable(this);   
        this.setDepth(989); //prioridad de capa
        this.body.setCircle(20,5,5);


        this.setCollideWorldBounds(true);


      }

/*
//var bg_1 = this.add.tileSprite(0,0,this.sys.game.canvas,width,this.sys.game.height,"spriteFileName"); //para crear un fondo "tileado"
var map = this.make.tilemap({key: "map"});
var tiles = map.addTilesetImage("plataformas","tiles");
var fondo = map.createLayer("fondo",tiles,0,0);
var layer = map.createLayer("layer",tiles,0,0); //suelo
layer.setCollisionByExclusion(-1,true);
this.player = new(Player(this,50, 100);
this.physics.collide(this.player,layer);
this.physics.add.collider(this.player,layer);
*/



    handleMovement(t, dt,jostick){
        super.handleMovement();
        this.vDirection = "NE";



        let centerX = this.displayWidth  / 2;
        let centerY = this.displayHeight / 2;

        //console.log(this.y)
        //velocidad vertical:
        if(this.y<500 || this.y<this.displayHeight){
            this.speedY= 0;
            this.speedX=0;
            this.speedY += SPACESHIP_SPEED;
        }

        else if(this.scene.w.isDown  ){
            this.vDirection = "UP";
            if(this.speedY>MAX_SPEED_NEGATIVE)
                this.speedY -= SPACESHIP_SPEED;
        }
        else if(this.scene.s.isDown){
            this.vDirection = "DOWN";
            if(this.speedY<MAX_SPEED_POSITIVE)
            this.speedY += SPACESHIP_SPEED;
        }
        /*else{
            this.speedY=0;
        }*/


        //velocidad horizontal:
        if(this.scene.a.isDown){
            this.hDirection = "left";
            if(this.speedX>MAX_SPEED_NEGATIVE)
            this.speedX -= SPACESHIP_SPEED;
        }
        else if(this.scene.d.isDown){
            this.hDirection = "right";
            if(this.speedX<MAX_SPEED_POSITIVE)
            this.speedX += SPACESHIP_SPEED;
        }
       // else{ this.speedX = 0;}

        this.setVelocity(this.speedX,this.speedY);
        this.play(this.hDirection+this.vDirection,true);
    }

    jostickMovement(jostick){
        super.handleMovement();
        this.jostick=jostick;
        this.vDirection = "NE";

        let centerX = this.displayWidth  / 2;
        let centerY = this.displayHeight / 2;

        //velocidad vertical:
        if(this.jostick==='UP'){
            this.vDirection = "UP";
            if(this.speedY>MAX_SPEED_NEGATIVE)
            this.speedY -= SPACESHIP_SPEED;
        }
        else if(this.jostick==='DOWN'){
            this.vDirection = "DOWN";
            if(this.speedY<MAX_SPEED_POSITIVE)
            this.speedY += SPACESHIP_SPEED;

            let btmLimit = VERTICAL_LEVELS_HEIGHT - centerY;
            //if(this.y + centerY + this.speedY >= btmLimit) { this.speedY = 0; }
        }

        //velocidad horizontal:
        if(this.jostick==='LEFT'){
            this.hDirection = "left";
            if(this.speedX>MAX_SPEED_NEGATIVE)
            this.speedX -= SPACESHIP_SPEED;

            //if(this.x - centerX <= Math.abs(this.speedX)) { this.speedX = 0; }
        }
        else if(this.jostick==='RIGHT'){
            this.hDirection = "right";
            if(this.speedX<MAX_SPEED_POSITIVE)
            this.speedX += SPACESHIP_SPEED;
            let rightLimit = VERTICAL_LEVELS_WIDTH - centerX;
            //if(this.x + centerX + this.speedX >= rightLimit) { this.speedX = 0; }
        }
        else{ this.hDirection = ""; }

        this.setVelocity(this.speedX,this.speedY);
        this.play(this.hDirection+this.vDirection,true);
    }
}