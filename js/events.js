$(function(){
    getMonthName = function (v) {
        var n = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return n[v]
    }
    rearrangeDate();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
    if(dd<10) { dd='0'+dd }
    if(mm<10) { mm='0'+mm } 
    today = yyyy+'-'+mm+'-'+dd;
    $('#startdate').val(today);
    $('#startdate').datepicker({ dateFormat: "yyyy-mm-dd" });
    function rearrangeDate() {
        var dates = $('.startdate b');
        dates.contents().each(function(i,v) {
            var date = v.textContent.split('-');
            var monthName = getMonthName(parseInt(date[1]))
            var newDate = monthName+' '+date[2]+', '+date[0];
            dates.eq(i).text(newDate);
        });
    }
});