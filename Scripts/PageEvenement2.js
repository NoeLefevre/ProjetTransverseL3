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
let box1 = document.querySelector(".box_etoiles1");
let box2 = document.querySelector(".box_etoiles2");
let box3 = document.querySelector(".box_etoiles3");
let box4 = document.querySelector(".box_etoiles4");
let box5 = document.querySelector(".box_etoiles5");
let box = document.querySelector(".box_etoile");
let etoile1 = document.querySelector(".etoile1");
let etoile2 = document.querySelector(".etoile2");
let etoile3 = document.querySelector(".etoile3");
let etoile4 = document.querySelector(".etoile4");
let etoile5 = document.querySelector(".etoile5");
let etoile1j = document.querySelector(".etoile1j");
let etoile2j = document.querySelector(".etoile2j");
let etoile3j = document.querySelector(".etoile3j");
let etoile4j = document.querySelector(".etoile4j");
let etoile5j = document.querySelector(".etoile5j");
let modifnote = document.querySelector(".btnmodif");
let boutonnoter = document.querySelector(".btnnoter");
let boutonnoter2 = document.querySelector(".btnnoter2");
let formnoter = document.querySelector(".interets-popup");
let btncommentaire = document.querySelector(".btncom");
const contenu1 = document.querySelectorAll(".contenu1");
const contenu2 = document.querySelectorAll(".contenu2");

// Global Query Selectors
const noteContainer = document.querySelector('.note-container');
const form = document.querySelector('.form');
const titleInput = document.querySelector('#title');


boutonnoter.addEventListener("click",afficher_menu_noter)
boutonnoter2.addEventListener("click",rentrer_menu_noter)
modifnote.addEventListener("click",modif_note)
etoile1.addEventListener("mouseover",note1)
etoile1.addEventListener("mouseout",note1_out)
etoile2.addEventListener("mouseover",note2)
etoile2.addEventListener("mouseout",note2_out)
etoile3.addEventListener("mouseover",note3)
etoile3.addEventListener("mouseout",note3_out)
etoile4.addEventListener("mouseover",note4)
etoile4.addEventListener("mouseout",note4_out)
etoile5.addEventListener("mouseover",note5)
etoile5.addEventListener("mouseout",note5_out)
etoile1j.addEventListener("click",block_note1)
etoile2j.addEventListener("click",block_note2)
etoile3j.addEventListener("click",block_note3)
etoile4j.addEventListener("click",block_note4)
etoile5j.addEventListener("click",block_note5)
bouton.addEventListener('click',affiche_menu);
bouton2.addEventListener('click',rentre_menu);
profil.addEventListener('click',afficher_profil);
profil2.addEventListener('click',rentrer_profil);
bouton_notif.addEventListener('click',afficher_notif);
bouton_notif2.addEventListener('click',rentrer_notif);

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
function afficher_menu_noter(){
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
function rentrer_menu_noter(){
    boutonnoter.style.display = "block";
    boutonnoter2.style.display = "none";
    formnoter.style.display = "none";
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
function getCookie(name){
    if(document.cookie.length == 0)
      return null;

    var regSepCookie = new RegExp('(; )', 'g');
    var cookies = document.cookie.split(regSepCookie);

    for(var i = 0; i < cookies.length; i++){
      var regInfo = new RegExp('=', 'g');
      var infos = cookies[i].split(regInfo);
      if(infos[0] == name){
        return unescape(infos[1]);
      }
    }
    return null;
  }
function note1()
{
    box.style.display = "none";
    box1.style.display = "block";
}
function note1_out()
{
    box.style.display = "block";
    box1.style.display = "none";
}
function note2()
{
    box.style.display = "none";
    box2.style.display = "block";
}
function note2_out()
{
    box.style.display = "block";
    box2.style.display = "none";
}
function note3()
{
    box.style.display = "none";
    box3.style.display = "block";
}
function note3_out()
{
    box.style.display = "block";
    box3.style.display = "none";
}
function note4()
{
    box.style.display = "none";
    box4.style.display = "block";
}
function note4_out()
{
    box.style.display = "block";
    box4.style.display = "none";
}
function note5()
{
    box.style.display = "none";
    box5.style.display = "block";
}
function note5_out()
{
    box.style.display = "block";
    box5.style.display = "none";
}
function block_note1()
{
    box1.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+1;
    window.location.reload();
}
function block_note1_fixe()
{
    box1.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+1;
}
function block_note2()
{
    box2.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+2;
    window.location.reload();
}
function block_note2_fixe()
{
    box2.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+2;
}
function block_note3()
{
    box3.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+3;
    window.location.reload();
}
function block_note3_fixe()
{
    box3.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+3;
}
function block_note4()
{
    box4.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+4;
    window.location.reload();
}
function block_note4_fixe()
{
    box4.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+4;
}
function block_note5()
{
    box5.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+5;
    window.location.reload();
}
function block_note5_fixe()
{
    box5.style.display = "block";
    box.style.display = "none";
    document.cookie = "note="+5;
}
function modif_note()
{
    box.style.display = "block";
    box1.style.display = "none";
    box2.style.display = "none";
    box3.style.display = "none";
    box4.style.display = "none";
    box5.style.display = "none";
    document.cookie = "note="+0;
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
    var mod = url.searchParams.get("modify");
    let str=""
    if (mod===null)
        str = window.location.href + "&modify=1";
    else
        str = window.location.href;
    document.location.href = str;
}
function reseturl(url){
    let tempstr="";
    let stopcopier=0;
    let i=0;
    while(i<str.length && stopcopier==0)
    {
        if (url.charAt(i)=="&" && url.charAt(i+1)=="r")
            stopcopier = 1;
        else
            tempstr = tempstr + url.charAt(i);
        i++;
    }
    stopcopier=0;
    i=0;
    return tempstr;
}
var str = window.location.href
var url = new URL(str);
var reset = url.searchParams.get("reset");
if (reset==1){
    str = window.location.href
    document.cookie = "note="+0;
    let newurl = reseturl(str)
    document.location.href=newurl;
}
if (getCookie("note")==1 && reset!=1){
    block_note1_fixe()
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
else if (getCookie("note")==2 && reset!=1){
    block_note2_fixe()
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
else if (getCookie("note")==3 && reset!=1){
    block_note3_fixe()
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
else if (getCookie("note")==4 && reset!=1){
    block_note4_fixe()
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
else if (getCookie("note")==5 && reset!=1){
    block_note5_fixe()
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
var er = url.searchParams.get("false");
if (er==1){
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
}
var mod = url.searchParams.get("modify");
if (mod==1){
    boutonnoter.style.display = "none";
    boutonnoter2.style.display = "block";
    formnoter.style.display = "block";
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


///////////////////////////// commentaire
function render(data){
    var html =  "<div class='commentBox'><div class='leftPanelImg'><img src='avatar.jpg'></div><div class ='rightPanel'><span>"+data.name+"</span><div class='date'>"+data.date+"</div><p>"+data.body+"</p></div><div class='clear'></div></div>"
    $('#container').append(html); 
}

$(document).ready(function(){
    var coment = [];

        for(var i = 0; i<coment.length; i++){
            render(coment[i]);
        }

    $('#addComent').click(function(){
        var addObj = {
            "name" : $('#name').val(),
            "date" : $('#date').val(), 
            "body" : $("#bodyText").val()
        };
        console.log(addObj); 
        coment.push(addObj); 
        render(addObj);
    });
});