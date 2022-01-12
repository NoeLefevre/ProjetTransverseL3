let choix2 = document.querySelector('#textchoixgrp');
$(document).ready(function(){
    $("select.choix").change(function(){
      var temp = $(this).children("option:selected").val();
      console.log(temp);
      if (temp=="Personne")
{
    choix2.style.display = "none";

}
else
{
    choix2.style.display = "block";
}
    });
    
  });

