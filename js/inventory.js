// initialisation des variables

// const intro = document.querySelector(".relative"); //layer intro
const btnMenu = document.querySelector("#btnMenu");
const Menu = document.getElementById("menu");
const out = document.querySelector(".out");
const main = document.querySelector("main"); //container 
const btnX1 = document.querySelector(".btnFlex>.btn:first-child");
const btnX10 = document.querySelector(".btnFlex>.btn:last-child");
const BarVersion = document.querySelector("#barVersion"); //scroll vertical des versions
const select = document.querySelector("select[name='altNom']"); //sélecteur en bas de la bannière
const mainCharacter = document.querySelector(".mainPerso"); //perso star en bannière
var perso = "";


// intro.addEventListener("click", start);
out.addEventListener("click", menu);
btnMenu.addEventListener("click", menu);

const inputs = document.querySelectorAll('.classification>input');  // sélectionne chaque input de type et voie

document.querySelectorAll("input").forEach(e=>{
			e.addEventListener("change", filtre);
		})

function filtre(){
    let aucunSelectionne = true; // aucun filtre actifs
    // si 1 input est coché, alors aucunSelectionne devient true
    inputs.forEach(input => {
    if (input.checked) {
        aucunSelectionne = false;
    }
    });
	
    // ajoute une classe pour tout afficher si aucun filtre actifs
    if (aucunSelectionne == false){
        document.querySelector(".filtreGrid").classList.remove("rien");
        document.querySelector(".filtreGrid").classList.toggle(this.name);
    }
    else // retire .rien si un filtre est actif
    {
        document.querySelector(".filtreGrid").classList.toggle("rien");
        document.querySelector(".filtreGrid").classList.toggle(this.name);
    }       
}

function menu() {
    Menu.classList.toggle("active"); // sort le menu
    out.classList.toggle("active"); // affiche la zone noir pour enlever
    main.classList.toggle("menu");
    BarVersion.classList.toggle("inactive");
}