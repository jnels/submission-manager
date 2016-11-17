<?php
require_once("inc/connect.php");
include("inc/header.php");

$view = "not-rated";

if (isset($_POST["submission_id"])) {
    $submission_to_delete = $_POST["submission_id"];
    delete_submission($db, $submission_to_delete);
}

if (isset($_GET["view"])) {
    $view = $_GET["view"];
}

$user_id = 1;
$rated_by_user = user_rated_submissions($db, $user_id);
$submission_list = generate_submission_list($db, $rated_by_user, $view);

function delete_submission($db, $submission_to_delete) {
    $sql = "DELETE submission_info, rating 
            FROM submission_info 
            INNER JOIN rating 
            ON submission_info.submission_id = rating.submission_id
            WHERE submission_info.submission_id = :submission_to_delete";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":submission_to_delete", $submission_to_delete, PDO::PARAM_STR, 29);
    $stmt->execute();

    var_dump($submission_to_delete);
}

function generate_submission_list($db, $rated_by_user, $view) {
    $sql = "SELECT * 
            FROM submission_info
            JOIN user_info
            ON submission_info.user_id = user_info.user_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = [];

    if ($view === "rated") {
        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rated_already = already_rated($rated_by_user, $record["submission_id"]);

            if ($rated_already) {
                $result[] = $record;
            }
        }
    } else if ($view === "all") {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rated_already = already_rated($rated_by_user, $record["submission_id"]);

            if (!$rated_already) {
                $result[] = $record;
            }
        }
    } 

    return $result;
}

//Returns already rated submissions
function already_rated($rated_by_user, $submission_id) {
    foreach($rated_by_user as $rated) {
        if ($rated["submission_id"] === $submission_id) {
            return $rated["rating"];
        } 
    }
    return false;
}

// Returns avg rating for rated submissions
function avg_ratings($db, $submission_id) {
    $sql = "SELECT rating
            FROM rating 
            WHERE submission_id = :sub_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":sub_id", $submission_id , PDO::PARAM_STR, 29);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    $result = array_sum($list)/count($list);

    return $result;
}

function user_rated_submissions($db, $reader_id) {
    $sql = "SELECT submission_id, rating
            FROM rating 
            WHERE rating.reader_id = :reader_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":reader_id", $reader_id, PDO::PARAM_STR, 29);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

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
                <input type="hidden" name="submission_id" class="hidden-id" <?php echo "value=" . $submission["submission_id"]?>> 
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