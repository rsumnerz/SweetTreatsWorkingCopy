$("#pickUpDate").timepicker();


// Getting the current day
var dateToday = new Date(); 


// Adding 5 days to the current day
dateToday.setDate(dateToday.getDate() + 5);


$(function() {
    $( "#pickUpTime" ).datepicker({
        numberOfMonths: 1,
        showButtonPanel: true,
        minDate: dateToday
    });
});