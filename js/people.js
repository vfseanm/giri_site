$(function(){
    $('.delete').click(function(event) {
        var x = confirm("Are you sure you want to delete this person?");
        if (x==true) { // do nothing  
        }
        else
        { 
            return false; //stop the delete
        }
    });
});