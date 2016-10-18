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

// var_dump($submission_list);
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
$values = ["submission_date", "name", "title", "genre", "file_path"];

foreach($submission_list as $submission) { ?>
    <div class="row table-row">

        <?php foreach ($values as $field) { ?>
            <div class="col-xs-12 col-md-2">
                <p><span class="visible-xs visible-sm"><?php echo $field ?>: </span><?php echo $submission[$field]?></p>
            </div>
        <?php
        }
        ?>
        <div class="col-xs-12 col-md-2">
            <form method="post">
                <select name="rating">
                    <option selected disable>-- Rate --</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <button><span class="glyphicon glyphicon-ok"></span>
</button>
            </form>
        </div>
    </div>
<?php
}
?>




<?php
include("inc/footer.php");
?>






