/////////////////////////////////// INITIALISATION DES VARIABLES ////////////////////////////////////////

// const intro = document.querySelector(".relative"); //layer intro
const btnMenu = document.querySelector("#btnMenu");
const Menu = document.getElementById("menu");
const out = document.querySelector(".out");
const main = document.querySelector("main"); //container 
const select = document.querySelector("select[name='altNom']"); //sélecteur en bas de la bannière

// POUR FILTRES
const inputs = document.querySelectorAll('.classification input');
const grille = document.querySelector(".filtreGrid");

/////////////////////////////////// ZONE EVENT ////////////////////////////////////////

// POUR MENU
out.addEventListener("click", menu);
btnMenu.addEventListener("click", menu);

// EVENT POUR FILTRE
inputs.forEach(input => {
    input.addEventListener("change", filtre);
});

/////////////////////////////////// ZONE FONCTIONS ////////////////////////////////////////

function filtre() {

    let aucunSelectionne = true;

    // pour chaque checkbox, ajouter classe en display block sur le parent si cocher
    inputs.forEach(input => {
        if (input.checked) {
            aucunSelectionne = false;
            grille.classList.add(input.name);
        } else {
            grille.classList.remove(input.name);
        }
    });

    // si aucun filtre aactifs, afficher tout
    if (aucunSelectionne) {
        grille.classList.add("rien");
    } else {
        grille.classList.remove("rien");
    }
}

function menu() {
    Menu.classList.toggle("active"); // sort le menu
    out.classList.toggle("active"); // affiche la zone noir pour enlever
    main.classList.toggle("menu");
}