<?php
require_once("inc/connect.php");
include("inc/header.php");

$view = "not-rated";

if (isset($_GET["view"])) {
    $view = $_GET["view"];
    
    if ($view === "rated") {

    } else if ($view === "not-rated") {

    } else {

    }
}

$rated_by_user = user_rated_submissions($db, 1);
$submission_list = generate_submission_list($db, $rated_by_user, $view);

function generate_submission_list($db, $rated_by_user, $view) {
    $sql = "SELECT * 
            FROM submission_info
            JOIN user_info
            ON submission_info.user_id = user_info.user_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = [];

    if ($view === "not_rated") {
        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rated_already = already_rated($rated_by_user, $record["submission_id"]);

            if (!$rated_already) {
                $result[] = $record;
            }
        }
    } else {//if ($view === "all") {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $result;
}

function already_rated($rated_by_user, $submission_id) {
    foreach ($rated_by_user as $rated) {

        if ($rated === $submission_id) {
            return true;
        } 
    }
    return false;
}

function user_rated_submissions($db, $reader_id) {
    $sql = "SELECT submission_id
            FROM rating 
            WHERE rating.reader_id = :reader_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":reader_id", $reader_id, PDO::PARAM_STR, 29);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
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
        <p>Date</p>
    </div>

    <div class="col-xs-12 col-md-2">
        <p>Name</p>
    </div>
    <div class="col-xs-12 col-md-2">
        <p>Title</p>
    </div>

    <div class="col-xs-12 col-md-2">
        <p>Genre</p>
    </div>

    <div class="col-xs-12 col-md-2">
        <p>File</p>
    </div>

    <div class="col-xs-6 col-md-1">
        <p>Rating</p>
    </div>
    
    <?php 
        if($submission_list["submission_id" === 1]) { ?>
            <div class="col-xs-6 col-md-1">
                <p>Delete</p>
            </div>
    <?php
        }
    ?>

</div>

<?php
$values = ["submission_date"=>"Date", "name"=>"Name", "title"=>"Title", "genre"=>"Genre", "file_path"=>"File"];

foreach($submission_list as $submission) { ?>
    <div class="row table-row" id="<?php echo $submission["submission_id"]?>">

        <?php foreach ($values as $field=>$heading) { ?>
            <div class="col-xs-12 col-md-2">
                <p><span class="visible-xs visible-sm"><?php echo $heading ?>: </span><?php echo $submission[$field]?></p>
            </div>
        <?php
        }
        ?>
        <div class="col-xs-6 col-md-1">
                <select name="rating" class="rating">
                    <option selected disable>-- Rate --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </form>
        </div>
        <div class="col-xs-6 col-md-1">
            <form method="post">
                <button>Delete</button>
            </form>
        </div>
    </div>
<?php
}
?>

<?php
include("inc/footer.php");
?>