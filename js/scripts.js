$(function() {
    var $icon = $("#switch-icon");

    if (location.pathname.includes("manager/manager")) {
        $icon.addClass("glyphicon-cloud-upload");
        $icon.attr("href", "submission-form.php");
    } else if (location.pathname.includes("manager/submission-form")) {
        $icon.addClass("glyphicon-list");
        $icon.attr("href", "manager.php");
    }
});


$(".rating").on("change", function() {
//get value
    var rating = $(this).val();
    var submissionId = $(".active-row").attr("id");

    var submissionJSON = { 
        submissionId: submissionId,
        readerId: 1,
        rating: rating
    }

    $.ajax({
        type: "POST",
        url: "ajax/rating.php",
        data: {
            ratingData: submissionJSON
        },
        success: function(response) {
            console.log(response);
        }
    });
});

$(".table-row").click(function(){
    $(".table-row").removeClass("active-row");
    $(this).addClass("active-row");
})