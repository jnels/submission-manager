<?php
require_once("inc/connect.php");
include("inc/header.php");

$submission_list = generate_submission_list($db);

function generate_submission_list($db) {
    $sql = "SELECT * 
            FROM submission_info
            JOIN user_info
            ON submission_info.user_id = user_info.user_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

var_dump($submission_list);
?>

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

    <div class="col-xs-12 col-md-2">
        <p>Rating</p>
    </div>
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
        <div class="row">
        <div class="col-xs-12 col-md-1">
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
        </div>
    </div>
<?php
}
?>




<?php
include("inc/footer.php");
?>