<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    mode: "exact",
    paste_remove_spans: true,
    paste_remove_styles : true,
    elements:"caption1,caption2,caption3,caption4,caption5,caption6,caption7,caption8,caption9",
    plugins: [
        "advlist autolink lists link charmap preview paste",
        "searchreplace visualblocks"
    ],
    menubar: false,
    height: 50,
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
});

tinymce.init({
    mode: "addsummary",
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

$(document).on('focusin', function(e) {
    if ($(event.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});
</script>