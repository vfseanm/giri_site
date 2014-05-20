$(function(){    
    getMonthName = function (v) {
        var n = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return n[v]
    }
    var sdate = $('startdate');
    var edate = $('enddate');
    rearrangeDate(sdate);
    rearrangeDate(edate);
    function rearrangeDate(date) {
        var old = date.text().replace(/ /g,'').split('-');
        var monthName = getMonthName(parseInt(old[1]))
        var newDate = monthName+' '+old[2]+', '+old[0];
        date.eq(0).html("<strong>" + newDate + "</strong>");
    }
    $('#dp').datepicker({ dateFormat: "yyyy-mm-dd" });
    var dp2 = $('#dp2');
    dp2.datepicker({ dateFormat: "yyyy-mm-dd" });
    if (dp2.val() == "0000-00-00") { 
        var sdate = $('#dp').val();
        $('enddate').text("");
        dp2.eq(0).val(sdate); dp2.datepicker("setValue", sdate); dp2.datepicker('update');
    }
    $('#delete').click(function() {
        var x = confirm("Are you sure you want to delete this event?");
        if (x==true) { // do nothing  
        }
        else
        { 
            return false; //stop the delete
        }
    });
});