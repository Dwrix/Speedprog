$(document).ready(function(){


    $(".tarjeta").hover(function(){
         if($(this).attr("id")=="zzz"){

        $(this).removeAttr("id");
       }else{
        $(this).attr("id","zzz");
       }
        
		});

      
});