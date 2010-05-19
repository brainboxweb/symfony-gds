$(document).ready(function() {
    
    //Date picker globals;
    $.datepicker.setDefaults({showOn: 'both', buttonImageOnly: true, 
        buttonImage: 'images/calendar.png', buttonText: 'Calendar',dateFormat: 'dd-mm-yy', closeAtTop: true});
    
    calendar1 = $("#startDate").datepicker();
    calendar2 = $("#endDate").datepicker();
    
    calendar3 = $("#published").datepicker();
    calendar4 = $("#depublish").datepicker();
    

});