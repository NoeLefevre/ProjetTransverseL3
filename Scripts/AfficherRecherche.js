let bouton = document.querySelector('#Hamburger');
let bouton2 = document.querySelector('#Hamburger2');
let menu = document.querySelector("#menu_dynamique");
let profil =  document.querySelector('#profil');
let profil2 =  document.querySelector('#profil2');
let profil_menu = document.querySelector("#profil_dynamique");
let bouton_notif = document.querySelector('#notification');
let bouton_notif2 = document.querySelector('#notification2');
let notif =document.querySelector("#notification_dynamique");
let amis = document.querySelector(".tous_les_amis");
let boutonfiltre = document.querySelector('.bouton_filtre');
let boutonfiltre2 = document.querySelector('.bouton_filtre2');
let filtre = document.querySelector('.filtre');
const contenu1 = document.querySelectorAll(".contenu1");
const contenu2 = document.querySelectorAll(".contenu2");


bouton.addEventListener('click',affiche_menu);
bouton2.addEventListener('click',rentre_menu);
profil.addEventListener('click',afficher_profil);
profil2.addEventListener('click',rentrer_profil);
bouton_notif.addEventListener('click',afficher_notif);
bouton_notif2.addEventListener('click',rentrer_notif);
boutonfiltre.addEventListener('click',afficher_filtre);
boutonfiltre2.addEventListener('click',rentrer_filtre);
window.onresize = resize;


function filtredynamique()
{
    str =window.location.href;
    let newstr="";
    let i=0;
    while (str.charAt(i)!="&" && i<str.length)
    {
        newstr = newstr + str.charAt(i);
        i++;
    }
    console.log(newstr);
    if (document.getElementById("Sport").checked == true)
    {
        newstr = newstr+"&Sport=True";
    }
    if (document.getElementById("Musique").checked == true)
    {
        newstr = newstr+"&Musique=True";
    }
    if (document.getElementById("TV").checked == true)
    {
        newstr = newstr+"&TV=True";
    }
    if (document.getElementById("Soiree").checked == true)
    {
        newstr = newstr+"&Soiree=True";
    }
    if (document.getElementById("Conference").checked == true)
    {
        newstr = newstr+"&Conference=True";
    }
    document.location.href=newstr;
}

function resize()
{
 if(contenu1[0].style.display = "none"){
 	var i = 0
 }
 else{
 	var i = 1
 }

 if (window.innerWidth<600){
 	 afficher_simple();
 }
}

function resize1()
{
	console.log(window.innerWidth);
 if (window.innerWidth<600){
 	 afficher_simple();
 }
}
function afficher_notif()
{
	bouton_notif.style.display = "none";
    notif.style.display = "block";
    bouton_notif2.style.display = "block";
}
function rentrer_notif()
{
	bouton_notif.style.display = "block";
    notif.style.display = "none";
    bouton_notif2.style.display = "none";
}
function afficher_profil()
{
	profil.style.display = "none";
    profil_menu.style.display = "block";
    profil2.style.display = "block";
}
function rentrer_profil()
{
	profil.style.display = "block";
    profil_menu.style.display = "none";
    profil2.style.display = "none";
}
function affiche_menu()
{
    bouton.style.display = "none";
    menu.style.display = "inline-flex";
    bouton2.style.display = "block";

}

function rentre_menu()
{
    bouton.style.display = "block";
    menu.style.display = "none";
    bouton2.style.display = "none";

}
function afficher_filtre()
{
    filtre.style.display = "block";
    boutonfiltre.style.display = "none";
    boutonfiltre2.style.display = "block";
}

function rentrer_filtre()
{
    filtre.style.display = "none";
    boutonfiltre.style.display = "block";
    boutonfiltre2.style.display = "none";
}
function afficher_simple()
{
	amis.style.flexDirection = "row";
    for (var i = 0 ; i < contenu1.length ; i++){
    	contenu1[i].style.display ="none";
    }
	for (var i = 0 ; i < contenu2.length ; i++){
	    	contenu2[i].style.display ="inline-flex";
	    }
	return(1)
}

function afficher_complet()
{
	amis.style.flexDirection = "column";
	 for (var i = 0 ; i < contenu1.length ; i++){
    	contenu1[i].style.display ="inline-flex";
    }
	for (var i = 0 ; i < contenu2.length ; i++){
	    	contenu2[i].style.display ="none";
	    }
}
