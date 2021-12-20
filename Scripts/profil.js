let bouton = document.querySelector('#Hamburger');
let bouton2 = document.querySelector('#Hamburger2');
let menu = document.querySelector("#menu_dynamique");
let affsimple = document.querySelector("#bcourt");
let affcomplet = document.querySelector("#blong");
let profil =  document.querySelector('#profil');
let profil2 =  document.querySelector('#profil2');
let profil_menu = document.querySelector("#profil_dynamique");
let bouton_notif = document.querySelector('#notification');
let bouton_notif2 = document.querySelector('#notification2');
let notif =document.querySelector("#notification_dynamique");
let amis = document.querySelector(".tous_les_amis");
const contenu1 = document.querySelectorAll(".contenu1");
const contenu2 = document.querySelectorAll(".contenu2");

function openForm() {
    document.getElementById("popupForm").style.display="block";
}
  
function closeForm() {
    document.getElementById("popupForm").style.display="none";
}

let evenements = [{
     	title:"live coding",
     	start:"2021-11-23 08:00:00",
     	end:"2021-11-23 10:00:00",
     	color:"#EA1FA6"
     },{
     	title:"live coding",
     	start:"2021-11-23 12:00:00",
     	end:"2021-11-23 14:00:00"
     }]

document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        console.log(calendarEl);
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',
          locale:'fr',
          eventColor:"blue",
          allDaySlot : false,
          firstDay : "1",
          dayHeaderFormat:{
          	weekday: 'short',
          	omitDots: true
          },
          headerToolbar: {
          	left:'',
          	center:'',
          	right:''
          },

          buttonText:{
          	today: 'Aujourd\'hui',
          	month: 'mois',
          	week : 'semaine',
          	list:'liste'
          },

          events: evenements,
          nowIndicator:true
        });
        calendar.render();
      });

      bouton.addEventListener('click',affiche_menu);
bouton2.addEventListener('click',rentre_menu);
profil.addEventListener('click',afficher_profil);
profil2.addEventListener('click',rentrer_profil);
bouton_notif.addEventListener('click',afficher_notif);
bouton_notif2.addEventListener('click',rentrer_notif);
affsimple.addEventListener('click',afficher_simple);
affcomplet.addEventListener('click',afficher_complet);
window.onresize = resize;

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