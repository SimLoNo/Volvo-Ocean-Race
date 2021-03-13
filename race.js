
// indlæs billeder:

// bør udfases var fra før der var farvede både
var boat = new Image;
boat.src = './boat.png';

black = new Image;
white = new Image;
green = new Image;
red = new Image;
yellow = new Image;
white.src = './boat_white.png';
green.src = './boat_green.png';
black.src = './boat_black.png';
red.src = './boat_red.png';
yellow.src = './boat_yellow.png';

const boats = [black, white, green, red, yellow];

wave1 = new Image;
wave2 = new Image;
wave3 = new Image;
wave4 = new Image;
wave5 = new Image;
wave1.src = './waves_1.png';
wave2.src = './waves_2.png';
wave3.src = './waves_3.png';
wave4.src = './waves_4.png';
wave5.src = './waves_5.png';

const waves = [wave1,wave2,wave3,wave4,wave5];

class Team{
	constructor(name, ranking, score,color){
	this.name = name;		// skal hentes fra database
	this.rank = ranking;	// skal hentes fra database, men kunne i princippet beregnes på baggrund af score
	this.score = score;		// skal hentes fra database

	this.boost = score;			// resettes ved ny kørsel (kopi af score)
	this.position_x = 20;		// resettes ved ny kørsel
	this.speed = 20;			// resettes ved ny kørsel
	// bruges ikke da der bruges billeder i forskellige farver
	this.team_color = color;	// kan bare være tilfældig, men der skal helst ikke være to der har samme farve.						
	}
}
class Game{
	constructor(){
		this.canvas = document.getElementById("race_canvas");
		this.context = this.canvas.getContext("2d");
		this.context.fillStyle = "#333377";
		this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);
		this.running = false;
	}
	update(){
		// Der er ikke taget højde for deltatime.

		this.running = false;
		
		for (let i = 0; i < teams_2018.length; i++){		
			var addBoost = Math.random() * teams_2018[i].boost;
			teams_2018[i].boost -= addBoost;
			teams_2018[i].speed += addBoost;
				
			// sålænge et skib stadig flyttes kører løbet!
			if (teams_2018[i].position_x <= this.canvas.width - 60){
				teams_2018[i].position_x += teams_2018[i].speed/100;
				this.running = true;
			}
		}		
	}
	draw(){
		this.context.fillStyle = "#333377";
		this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);		
				
		for (let i = 0; i < teams_2018.length; i++){

			/*
			// tidlig version med skibe som prikker:
			this.context.beginPath();
			this.context.fillStyle = teams_2018[i].team_color;

			this.context.arc(teams_2018[i].position_x, 75*i + 20, 10,0,2*Math.PI,false);
			this.context.fill();
			*/
			
			this.context.fillStyle = 'white';
			this.context.font = '20px sans-serif';
			this.context.fillText(teams_2018[i].name,5, 75*i + 20);
			
			// bølger
			let yOffset = Math.sin(teams_2018[i].position_x/8);

			let yOffsetBoat = Math.cos(teams_2018[i].position_x/8);

			// bare for at huske parametrene
			// context.drawImage(img,sx,sy,swidth,sheight,x,y,width,height);	
			
			// tegn bølger
			this.context.drawImage(boats[i],
				0,
				0,
				boats[i].width,							// giver ikke mening? burde eventuelt bruge billede fra array
				boat[i].height  + yOffsetBoat*50,
				teams_2018[i].position_x,
				75*i + 20 + yOffset,
				50,
				50 + yOffsetBoat*2// 50
			);
			// tegn skibe
			this.context.drawImage(waves[i],
				0,
				90,
				waves[i].width,
				waves[i].height,
				0, // teams_2018[i].position_x,
				75*i + 20 + yOffset,
				waves[i].width*1.5,
				waves[i].height*1
			);

			// målstreg
			this.context.strokeStyle = "white";
			this.context.rect(this.canvas.width - 60, 0, 1, this.canvas.height);
			this.context.stroke();	
		}
	}	
}

// problem dataen hentes asynkront! så det er ikke tilgængeligt udenfor funktionen
// en løsning: skriver til DOM
// TODO: lige nu sorterer den ikke skibene, hvis der ligger flere end 5 i tabellen skal vi sortere

function getData(){
	// hent data fra databasen. AJAX-metode?
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			myObj = JSON.parse(this.responseText);	

			// skriv data til DOM for at gemme til senere indlæsning:
			document.getElementById("shipName0").innerHTML = myObj[0][0];
			document.getElementById("shipName1").innerHTML = myObj[1][0];
			document.getElementById("shipName2").innerHTML = myObj[2][0];
			document.getElementById("shipName3").innerHTML = myObj[3][0];
			document.getElementById("shipName4").innerHTML = myObj[4][0];

			document.getElementById("shipRang0").innerHTML = myObj[0][1];
			document.getElementById("shipRang1").innerHTML = myObj[1][1];
			document.getElementById("shipRang2").innerHTML = myObj[2][1];
			document.getElementById("shipRang3").innerHTML = myObj[3][1];
			document.getElementById("shipRang4").innerHTML = myObj[4][1];

			document.getElementById("shipScore0").innerHTML = myObj[0][2];
			document.getElementById("shipScore1").innerHTML = myObj[1][2];
			document.getElementById("shipScore2").innerHTML = myObj[2][2];
			document.getElementById("shipScore3").innerHTML = myObj[3][2];
			document.getElementById("shipScore4").innerHTML = myObj[4][2];
			
			load();
			
		}
	};
	xmlhttp.open("GET", "getshipinfo.php", true);	
	xmlhttp.send(); 	
}

getData();



let teams_2018 = [];

/*
// manuel testdata
teams_2018.push(new Team("Dongfeng Race Team", 1, 73, "red"));
teams_2018.push(new Team("MAPFRE", 2, 70, "green"));
teams_2018.push(new Team("Team Brunel",3,69, "yellow"));
teams_2018.push(new Team("team AkzoNobel",4,59, "pink"));
teams_2018.push(new Team("Vestas 11th Hour Racing",5,39, "black"));
*/

game = new Game();

let lastTime = 0;

function load(){
// hent data fra DOM
teams_2018.push(new Team(document.getElementById("shipName0").innerHTML, document.getElementById("shipRang0").innerHTML, document.getElementById("shipScore0").innerHTML, "red"));
teams_2018.push(new Team(document.getElementById("shipName1").innerHTML, document.getElementById("shipRang1").innerHTML, document.getElementById("shipScore1").innerHTML, "green"));
teams_2018.push(new Team(document.getElementById("shipName1").innerHTML, document.getElementById("shipRang2").innerHTML, document.getElementById("shipScore2").innerHTML, "yellow"));
teams_2018.push(new Team(document.getElementById("shipName3").innerHTML, document.getElementById("shipRang3").innerHTML, document.getElementById("shipScore3").innerHTML, "pink"));
teams_2018.push(new Team(document.getElementById("shipName4").innerHTML, document.getElementById("shipRang4").innerHTML, document.getElementById("shipScore4").innerHTML, "black"));

game.draw();

}
function start(){
// reset og start gameloop:

restart();

gameLoop();
}

function restart(){
	for (i = 0; i < teams_2018.length;i++){
		teams_2018[i].speed = 20;
		teams_2018[i].position_x = 20;
		teams_2018[i].boost = teams_2018[i].score;
	}
}

function gameLoop(timestamp){
	let deltaTime = timestamp - lastTime;
	lastTime = timestamp;

	game.update(deltaTime);
	game.draw();

	// stop loopet når bådene er i mål
	if (game.running == true){
	requestAnimationFrame(gameLoop);
	} else {
			// kan gøres smartere...
				for (i = 0; i < teams_2018.length;i++){
				if (teams_2018[i].rank == 1){
					// bør gøres mere dynamisk
					//game.context.fillStyle = 'white';
					//game.context.rect(game.canvas.width/5,game.canvas.height/2.5,500,100);
					//game.context.fill();
					game.context.fillStyle = 'white';
					game.context.font = '30px sans-serif';
					game.context.fillText(teams_2018[i].name + " har vundet!",game.canvas.width/4, game.canvas.height/2);
				}
			}			
	}
}