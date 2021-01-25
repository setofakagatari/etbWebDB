function cerrar(){
    document.getElementById("header").style.display="none";
   document.getElementById("menu").style.display="none";
   
   document.getElementById("header2").style.display="flex";
   }
   function abrir(){
    document.getElementById("header").style.display="flex";
   document.getElementById("menu").style.display="flex";
   
   document.getElementById("header2").style.display="none";
   }
   $(document).ready(function(){
$(':checkbox[readonly=readonly]').click(function(){
   return false;         
}); 
}); 