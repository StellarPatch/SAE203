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

document.querySelectorAll("input").forEach(e=>{
			e.addEventListener("change", filtre);
		})

function filtre(){
			document.querySelector(".filtreGrid").classList.toggle(this.name);
            
}


// function start() {
//     // fait disparaitre "l'intro"
//     intro.classList.add("inactive");

//     const icons = document.querySelectorAll(".iconFlex .icon");

//     // animation des icônes qui viennent
//     icons.forEach((icon, i) => {
//         setTimeout(() => {
//             icon.classList.remove("translate");
//         }, 50 * (i + 1));
//     });
// }

function menu() {
    Menu.classList.toggle("active"); // sort le menu
    out.classList.toggle("active"); // affiche la zone noir pour enlever
    main.classList.toggle("menu");
    BarVersion.classList.toggle("inactive");
}