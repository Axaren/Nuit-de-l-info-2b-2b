int labyrinthe [][] ={{1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1},
                       {1,1,1,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1},
                       {1,1,1,0,0,0,1,1,1,0,1,1,1,0,0,0,0,1,1},
                       {1,0,0,0,1,1,1,0,1,0,1,1,1,0,1,1,0,1,1},
                       {1,0,1,0,1,0,1,0,0,0,0,0,0,0,0,1,0,1,1},
                       {1,0,1,0,0,2,0,1,1,1,1,1,0,1,0,1,0,1,1},
                       {1,0,1,0,1,1,0,1,1,1,1,1,0,1,0,1,0,1,1},
                       {1,0,1,0,1,1,0,0,0,1,0,0,0,1,0,1,0,1,1},
                       {1,0,1,0,0,1,0,1,0,0,0,1,1,1,0,1,0,1,1},
                       {1,0,1,1,4,1,0,1,1,1,0,5,0,0,0,1,0,1,1},
                       {1,0,2,0,0,1,0,1,1,1,0,1,1,1,1,1,0,1,1},
                       {1,1,1,1,1,1,0,1,1,1,0,1,0,0,0,0,0,1,1},
                       {1,1,0,0,0,1,0,1,0,0,0,1,1,1,1,1,1,1,1},
                       {1,1,0,1,0,0,0,1,0,1,1,1,1,1,0,0,0,0,1},
                       {1,1,0,1,1,1,1,1,3,1,0,1,0,0,0,1,1,0,1},
                       {1,1,0,0,0,0,0,0,0,0,0,1,0,1,0,0,2,0,1},
                       {1,1,1,0,1,1,1,1,1,1,1,0,4,0,1,4,0,1,1},
                       {1,1,1,0,0,0,0,0,0,0,0,0,1,0,0,0,1,1,1},
                       {1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1}};
                      
int tailleCase;
int caseX, caseY;
int finX, finY;
int taillePerso;
boolean jeuEnCours;
int deplacementEnCours;
int posX, posY;
int deplacement;
int konamiCode;
boolean codeValide;
PImage obscurite;
int tailleCahceObscurite;
int nbColonnes, nbLignes;
PImage fondCarte;

void setup(){
  fondCarte = loadImage ("img/Carte.png");
  nbColonnes = 19; nbLignes = 19;
  tailleCase = 35;
  taillePerso = 30;
  size (665,665);
  //background (255);
  image(fondCarte,0,0); 
  caseX = 3;  caseY = 2;
  posX = caseX*tailleCase + tailleCase/2;  
  posY = caseY*tailleCase + tailleCase/2;
  finX = 17;  finY = 15;
  jeuEnCours = true;
  deplacement = 5;
  konamiCode = 0;
  codeValide = false;
  obscurite = loadImage ("img/obscurite.png");
  tailleCahceObscurite = 800;
}

void draw(){
  if(jeuEnCours) {
    if(deplacementEnCours != 0){
      deplacer_personnage();
    }
    image(fondCarte,0,0); 
    dessiner_arrivee();
    dessiner_personnage();
    jeuFini();
    if(!codeValide)
     image(obscurite,posX - tailleCahceObscurite,posY - tailleCahceObscurite);
  }
}


void dessiner_personnage(){
  fill(0,255,0);
  ellipse(posX, posY, taillePerso, taillePerso);
}

void dessiner_arrivee(){
  fill(200,255,0);
  rect(finX*tailleCase, finY*tailleCase, tailleCase, tailleCase);
}

void keyPressed(){
  switch (key) {
      case 'z' : 
      //while(labyrinthe[caseY-1][caseX] == 0)
      if(labyrinthe[caseY-1][caseX] == 0 || labyrinthe[caseY-1][caseX] == 2 || labyrinthe[caseY-1][caseX] == 4 || labyrinthe[caseY-1][caseX] == 5)
        debuterDeplacement(0,-1);
      break; 
      case 's' : 
      //while(labyrinthe[caseY+1][caseX] == 0)
      if(labyrinthe[caseY+1][caseX] == 0 || labyrinthe[caseY+1][caseX] == 2 || labyrinthe[caseY+1][caseX] == 3 || labyrinthe[caseY+1][caseX] == 5)
        debuterDeplacement(0,1);
        break; 
      case 'd' : 
      //while(labyrinthe[caseY][caseX+1] == 0)
      if(labyrinthe[caseY][caseX+1] == 0 || labyrinthe[caseY][caseX+1] == 3 || labyrinthe[caseY][caseX+1] == 4 || labyrinthe[caseY][caseX+1] == 5)
        debuterDeplacement(1,0);
        break; 
      case 'q' : 
      //while(labyrinthe[caseY][caseX-1] == 0)
      if(labyrinthe[caseY][caseX-1] == 0 || labyrinthe[caseY][caseX-1] == 2 || labyrinthe[caseY][caseX-1] == 3 || labyrinthe[caseY][caseX-1] == 4)
        debuterDeplacement(-1,0);
        break;
      case 'a' : 
      if(konamiCode == 9)
          codeValide = true;
      else
          konamiCode = 0;    
        break;
      case 'b' : 
      if(konamiCode == 8)
          konamiCode++;
      else
          konamiCode = 0;
        break;
      default   :
        break;
  }
        
  if (key == CODED) {      
    switch (keyCode) {
      case  UP : 
      if(konamiCode == 0 || konamiCode == 1)
          konamiCode++;
      else
          konamiCode = 0;
        break;
      case  DOWN :
      if(konamiCode == 2 || konamiCode == 3)
          konamiCode++;
      else
          konamiCode = 0;
        break;
      case  LEFT :
      if(konamiCode == 4 || konamiCode == 6)
          konamiCode++;
      else
          konamiCode = 0;
        break;
      case  RIGHT :
      if(konamiCode == 5 || konamiCode == 7)
          konamiCode++;
      else
          konamiCode = 0;
        break;
      default   :
        break;
    }
  }
}

void deplacer_personnage(){
    if(posX != caseX*tailleCase + tailleCase/2){
      if(deplacementEnCours == 1) {posX += deplacement;}
      else if(deplacementEnCours == 2) {posX -= deplacement;}
    }
    else if(posY != caseY*tailleCase + tailleCase/2){
      if(deplacementEnCours == 3) {posY += deplacement;}
      else if(deplacementEnCours == 4) {posY -= deplacement;}
    }
    else { deplacementEnCours = 0; }
}

void debuterDeplacement(int x, int y){
    posX = caseX*tailleCase + tailleCase/2;
    posY = caseY*tailleCase + tailleCase/2;
    if(x == 1) {caseX++; deplacementEnCours = 1;}
    else if(x == -1) {caseX--; deplacementEnCours = 2;}
    if(y == 1) {caseY++; deplacementEnCours = 3;}
    else if(y == -1) {caseY--; deplacementEnCours = 4;}
    if(konamiCode != 0){konamiCode = 0;}
}

void jeuFini(){
  if((deplacementEnCours==0) && (caseX == finX) && (caseY == finY)){
    jeuEnCours = false;
  }
}