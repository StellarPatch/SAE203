/////////////////////////////////// INITIALISATION DES VARIABLES ////////////////////////////////////////

// const intro = document.querySelector(".relative"); //layer intro
const btnMenu = document.querySelector("#btnMenu");
const Menu = document.getElementById("menu");
const out = document.querySelector(".out");
const main = document.querySelector("main");

/////////////////////////////////// ZONE EVENTS ////////////////////////////////////////

btnMenu.addEventListener("click", menu);

///////////////////// SCRIPT LECTEUR MUSIQUE ///////////////////
var NomMusics = ["Ripples of Past Reverie", "Perfect Idol", "String Theory"]
// Liste de nom de musique + auteur dans le dossier Music à modifier manuellement pour nveau

let Liste_Audio = '<option value="false">None Music</option>'
// Variable pour liste sélecteur de musique

let Liste_Audio_Asset = ""
// Variable pour ajouter physiquement sur la page HTML les audios pour les jouer (invisbile)

NomMusics.forEach(function (Nom, i) {
    Liste_Audio += '<option value="audio' + (i) + '">' + NomMusics[i] + "</option>";
});
document.querySelector("#Audio").innerHTML = Liste_Audio;
// Ajout dynamique depuis NomMusics (Json pas encore) dans le selecteur de musique à jouer

NomMusics.forEach(function (Nom, i) {
    Liste_Audio_Asset += '<audio id="audio' + i + '" src="sfx/music/' + NomMusics[i] + '.mp3"></audio>'
});
document.querySelector("#ListeAudio").innerHTML = Liste_Audio_Asset;
// Ajout dynamique des balises audio avec NomMusics

var currentAudio = document.querySelector("#Audio").value;
var SaveCurrent = null;
// Variable pour acquérir musique pour audio()


/////////////////////////////////// ZONE FONCTIONS ////////////////////////////////////////

function audio() {
    currentAudio = document.querySelector("#Audio").value;

    if (SaveCurrent && SaveCurrent !== currentAudio) {
        let prev = document.getElementById(SaveCurrent);
        prev.pause();
        prev.currentTime = 0;
        prev.loop = false;
    }

    // Jouer la nouvelle musique
    if (currentAudio !== "false") {
        let a = document.getElementById(currentAudio);
        a.volume = 1;
        a.loop = true;
        a.play();
        SaveCurrent = currentAudio; // sauvegarder la musique actuelle
    }

}

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