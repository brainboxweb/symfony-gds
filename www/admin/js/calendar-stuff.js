$(document).ready(function() {
    
    //Date picker globals;
    $.datepicker.setDefaults({showOn: 'both', buttonImageOnly: true, 
        buttonImage: 'images/calendar.png', buttonText: 'Calendar',dateFormat: 'dd-mm-yy', closeAtTop: true});
    
    
    calendar1 = $("#published").datepicker();
    calendar2 = $("#depublish").datepicker();
    

});