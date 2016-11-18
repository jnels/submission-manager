// Toggles icon in menu
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

// POSTS rating on dropdown change
$(".rating").on("change", function() {
    var $ratingArea = $(this);
    var rating = $ratingArea.val();
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
            ratingData: JSON.stringify(submissionJSON)
        },
        success: function(response) {
            $ratingArea.parent().html("<p>" + response + "</p>")
        }
    });
});

$(".table-row").click(function(){
    $(".table-row").removeClass("active-row");
    $(this).addClass("active-row");
});

// Controls view in manager
$("#view-by-dropdown").on("change", function() {
    $("#view-by-form").submit();
});

//Verifies deletion request, submits form if OK
$(".delete-btn").click(function(e) {
    e.preventDefault();
    var $form = $(this).parent();

    if (confirm("Are you sure you want to delete this record?")) {
        $form.submit();
    } 
});