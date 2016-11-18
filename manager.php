<?php
require_once("inc/connect.php");
include("inc/header.php");
include("inc/functions.php");

$view = "not-rated";

if (isset($_POST["submission_to_delete"])) {
    $submission_to_delete = $_POST["submission_to_delete"];
    delete_submission($db, $submission_to_delete);
}

if (isset($_GET["view"])) {
    $view = $_GET["view"];
}

$user_id = 1;
$rated_by_user = user_rated_submissions($db, $user_id);
$submission_list = generate_submission_list($db, $rated_by_user, $view);

?>

<div class="text-right" id="view-by-area">
    <form method="GET" id="view-by-form">
        <label name="view">View By:</label>
        <select name="view" id="view-by-dropdown">
            <option <?php echo ($view == "not_rated") ? "selected" : ""; ?> value="not_rated">Not Rated</option>
            <option <?php echo ($view == "rated") ? "selected" : ""; ?> value="rated">Rated</option>
            <option <?php echo ($view == "all") ? "selected" : ""; ?> value="all">View All</option>
        </select>
    </form>
</div>

<!-- Column headings -->
<div class="row hidden-xs hidden-sm table-row">
    <div class="col-xs-12 col-md-2">
        <p class="manager-heading">Date</p>
    </div>

    <div class="col-xs-12 col-md-2">
        <p class="manager-heading">Name</p>
    </div>
    <div class="col-xs-12 col-md-2">
        <p class="manager-heading">Title</p>
    </div>

    <div class="col-xs-12 col-md-2">
        <p class="manager-heading">Genre</p>
    </div>

    <div class="col-xs-6 col-md-2">
        <p class="manager-heading">Rating</p>
    </div>
    
    <?php 
        if($user_id === 1) { ?>
            <div class="col-xs-6 col-md-2">
                <p class="manager-heading">Delete</p>
            </div>
    <?php
        }
    ?>

</div>

<?php

foreach($submission_list as $submission) { ?>
    <div class="row table-row" id="<?php echo $submission["submission_id"]?>">

        <?php  
        $table_fields = [ 
            "Date"=>$submission["submission_date"], 
            "Name"=>$submission["name"],
            "Title"=>"<a href='" . $submission["file_path"] . "'>" . $submission["title"] . "</a>",
            "Genre"=>$submission["genre"],
        ];
        
        foreach ($table_fields as $heading=>$field) { ?>
            <div class="col-xs-12 col-md-2">
                <p><span class="visible-xs visible-sm manager-heading"><?php echo $heading ?>: </span><?php echo $field?></p>
            </div>

        <?php
        }
        ?>

        <div class="col-xs-12 col-md-2">
            <div class="rating-area">
            <?php 
                $rated_already = already_rated($rated_by_user, $submission["submission_id"]);

                if ($rated_already) {
                    $avg_rating = avg_ratings($db, $submission["submission_id"]);

                    echo "<p class='rated'>Your Rating: $rated_already <br>($avg_rating average)</p>"; 
                }
            ?>  
                <span class="visible-xs visible-sm manager-heading">Rating:</span>
                <select name="rating" class="rating">
                    <option selected disable>--<?php echo ($rated_already) ? " Revise " : "- Rate -" ?>--</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-md-1">
            <form method="post">
                <input type="hidden" name="submission_to_delete" class="hidden-id" <?php echo "value=" . $submission["submission_id"]?>> 
                <button class="delete-btn">Delete</button>
            </form>
        </div>
    </div>
<?php
}
?>

<?php
include("inc/footer.php");
?>