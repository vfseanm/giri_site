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
    $('#dp').datepicker({ dateFormat: "yyyy-mm-dd" });
    $('#dp2').datepicker({ dateFormat: "yyyy-mm-dd" });

    function rearrangeDate() {
        var dates = $('date');
        dates.contents().each(function(i,v) {
            var date = v.textContent.split('-');
            var newDate = date[1]+'-'+date[2]+'-'+date[0];
            dates.eq(i).text(newDate);
        });
    }
    $(".fa.fa-pencil.main").click(function(event) {
        var id = event.target.id;
        //Form id
        var formUrl = "edit_research.php?ID="+id;
        $("#editform").eq(0).attr('action', formUrl);
        //PDF document
        var docSelector = "#document_"+id;
        var selected = $(docSelector);
        if (selected.length != 0) {
          var doc = selected.eq(0).attr("href");
          doc = doc.split('/'); doc = doc[2];
          $("#curfile").eq(0).text(doc);
        }
        else {
          $("#curfile").eq(0).text("");
        }
        //Title
        var titleSelector = "#title_"+id;
        var title = $(titleSelector).eq(0).text();
        $("#title").eq(0).val(title);
        //Date
        var dateSelector = "#date_"+id;
        var date = $(dateSelector).eq(0).text();
        date = date.split('-');
        date = date[2]+'-'+date[0]+'-'+date[1];
        $("#dp").eq(0).val(date);
        //Location
        var locationSelector = "#location_"+id;
        var location = $(locationSelector).eq(0).text();
        $("#location").eq(0).val(location);
        //Authors
        var authorSelector = "#authors_"+id;
        var authors = $(authorSelector).eq(0).text();
        $("#authors").eq(0).val(authors);
        //Summary
        var summarySelector = "#summary_"+id;
        var summary = $(summarySelector).eq(0).html();
        $("#editsummary").eq(0).text(summary);
        tinymce.init({
          mode: "textareas",
          plugins: [
              "advlist autolink lists link charmap preview",
              "searchreplace visualblocks"
          ],
          menubar: false,
          height: 200,
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        });

    });
    var docInput = $("#document");
    $("#closeEditModal").click(function(event) {
      docInput.replaceWith( docInput = docInput.clone( true ) );
    });

    $('.delete').click(function(event) {
        var x = confirm("Are you sure you want to delete this article?");
        if (x==true) { // do nothing  
        }
        else
        { 
            return false; //stop the delete
        }
    });

  });