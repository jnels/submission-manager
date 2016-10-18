var $icon = $("#switch-icon");

if (location.pathname.includes("manager/manager")) {
    $icon.addClass("glyphicon-cloud-upload");
    $icon.attr("href", "submission-form.php");
} else if (location.pathname.includes("manager/submission-form")) {
    $icon.addClass("glyphicon-list");
    $icon.attr("href", "manager.php");
}