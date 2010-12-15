$(document).ready(function(){
    

   
    $('.portfolio-item > div:first').slideDown('slow');
 
    $('#portfolio-list h2').click(function() {
        
        $(this).next().slideToggle('slow');
        
    });
    
});