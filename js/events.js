$(function(){
    rearrangeDate();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
    if(dd<10) { dd='0'+dd }
    if(mm<10) { mm='0'+mm } 
    today = yyyy+'-'+mm+'-'+dd;
    $('#date').val(today);
    $('#date').datepicker({ dateFormat: "yyyy-mm-dd" });

    function rearrangeDate() {
        var dates = $('.eventdate b');
        dates.contents().each(function(i,v) {
            var date = v.textContent.split('-');
            var newDate = date[1]+'-'+date[2]+'-'+date[0];
            dates.eq(i).text(newDate);
        });
    }
});