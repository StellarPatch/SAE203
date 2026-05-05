// initialisation des variables

const intro = document.querySelector(".relative"); //layer intro
const btnMenu = document.querySelector("#btnMenu");
const Menu = document.getElementById("menu");
const out = document.querySelector(".out");
const main = document.querySelector("main");
const btnTravel = document.querySelector("main>.btn");

var planet = null;

intro.addEventListener("click", start);
out.addEventListener("click", menu);
btnMenu.addEventListener("click", menu);
btnTravel.addEventListener("click", travel)


document.querySelectorAll('.planet').forEach(e => {
    e.addEventListener("click", planetSelect)
});

function start() {
    // fait disparaitre "l'intro"
    intro.classList.add("inactive");

    const icons = document.querySelectorAll(".iconFlex .icon");

    // animation des icônes qui viennent
    icons.forEach((icon, i) => {
        setTimeout(() => {
            icon.classList.remove("translate");
        }, 50 * (i + 1));
    });
}

function menu() {
    Menu.classList.toggle("active"); // sort le menu
    out.classList.toggle("active"); // affiche la zone noir pour enlever
    main.classList.toggle("menu")
}

function planetSelect() {
    // si rien sélectionner, cibler la div puis changer $planet pour la fonction travel()
    if (planet == null) {
        this.classList.toggle("selected");
        planet = this.dataset.name;
    }
    else {
        if (this.dataset.name == planet){
            this.classList.toggle("selected");
            planet = null;
        }
        else
        {
            // retire tout les cercles d'abord
            document.querySelectorAll('.planet').forEach(e => {
            e.classList.remove("selected")
        });

        // répète étape du if
            this.classList.toggle("selected")
            planet = this.dataset.name;
        }
    }
}

function travel() {
    // si pas de sélection, rien faire, sinon aller sur le wiki
    if (planet != null) {
        this.classList.toggle("selected");
        window.open("https://honkai-star-rail.fandom.com/wiki/" + planet, '_blank')
        // ajouter un son aussi
    }
}