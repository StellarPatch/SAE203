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

// change l'image de mise en avant si plusieurS 5*
select.addEventListener("change", e => {
    var perso = e.target.value;
    // console.log(perso)
    const formatage = perso.replaceAll(" ", "_");
    // changer l'image
    mainCharacter.style.backgroundImage = "url('img/splash/Character_" + formatage + "_Splash_Art.webp')";
    // envoyer la nouvelle info via l'URL pour connecter en PHP peut être
});

document.querySelector(".resultat").addEventListener("click", resultat)

btnX1.addEventListener("click", tirage);
btnX10.addEventListener("click", tirage);

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

function resultat() {
    this.classList.toggle("click");
}

function tirage() {
    //console.log(name)

    main.classList.toggle("animation");

    setTimeout(() => {
        document.querySelector(".screenPull").classList.toggle("hidden")
        document.querySelector(".gate1").classList.toggle("test")
    }, 1000)

}