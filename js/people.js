$(function(){
    $(".fa.fa-pencil.main").click(function(event) {
        var id = event.target.id;
        //Form id
        var formUrl = "edit_person.php?ID="+id;
        $("#editform").eq(0).attr('action', formUrl);
        var picSelector = "#picture_"+id;
        var selected = $(picSelector);
        var pic = selected.eq(0).attr("src");
        if (pic != "no-picture.png") {
          pic = pic.split('/');
          pic = pic[2];
          $("#cur_picture").eq(0).text(pic);
        }
        else {
          $("#cur_picture").eq(0).text("");
        }
        //Title
        var nameSelector = "#name_"+id;
        var name = $(nameSelector).eq(0).text();
        $("#name").eq(0).val(name);

        //Position
        var posSelector = "#position_"+id;
        var pos = $(posSelector).eq(0).text();
        $("#position").eq(0).val(pos);

        //Role
        //TODO
      
        //Summary
        var descSelector = "#desc_"+id;
        var desc = $(descSelector).eq(0).html();
        $("#description").eq(0).text(desc);
        tinymce.init({
          mode: "textareas",
          paste_remove_spans: true,
          paste_remove_styles : true,
          plugins: [
              "advlist autolink lists link charmap preview paste",
              "searchreplace visualblocks"
          ],
          menubar: false,
          height: 200,
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        });

        //Link 1
        ["#link1", "#link2", "#link3"].forEach(function(link) {
          processLink(link);
        });
        function processLink(link) {
          var l1Selector = link+"_"+id;
          var l1name = $(l1Selector).eq(0).text();
          var l1 = $(l1Selector).eq(0).attr('href');
          $(link+"name").eq(0).val(l1name);
          $(link).eq(0).val(l1);
        }

    });
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