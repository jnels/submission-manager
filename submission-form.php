<?php
include("inc/functions.php");
include("inc/header.php"); 
include("inc/form-handling.php");
?>

<h1 class="text-center">Submit Electronically</h1>

<form method="post" enctype="multipart/form-data" id="submission-form" class="form-horizontal">
	<!--User info-->
	<div class="col-xs-12 col-sm-6 col-lg-5 col-lg-offset-1">
		<!--Name-->
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Name:</label>
			<div class="col-sm-9">
				<input type="text" name="name" class="form-control required" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : "" ?>">
			</div>
		</div>
		<!--Address1-->
		<div class="form-group">
			<label for="address1" class="col-sm-3 control-label">Address 1:</label>
			<div class="col-sm-9">
				<input type="text" name="address1" class="form-control required" value="<?php echo (isset($_POST['address1'])) ? $_POST['address1'] : "" ?>">
			</div>
		</div>
		<!--Address2-->
		<div class="form-group">
			<label for="address2" class="col-sm-3 control-label">Address 2:</label>
			<div class="col-sm-9">
				<input type="text" name="address2" class="form-control" value="<?php echo (isset($_POST['address2'])) ? $_POST['address2'] : "" ?>">
			</div>
		</div>
		<!--City-->
		<div class="form-group">
			<label for="city" class="col-sm-3 control-label">City:</label>
			<div class="col-sm-9">
				<input type="text" name="city" class="form-control required" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : "" ?>">
			</div>
		</div>
		<!--State-->
		<div class="form-group">
			<label for="state" class="col-sm-3 control-label">State:</label>
			<div class="col-sm-9">
				<select name="state" class="form-control required">
					<?php echo state_dropdown() ?>
				</select>
			</div>
		</div>
		<!--Zip-->
		<div class="form-group">
			<label for="zip" class="col-sm-3 control-label">Zip:</label>
			<div class="col-sm-9">
				<input type="text" name="zip" class="form-control required" value="<?php echo (isset($_POST['zip'])) ? $_POST['zip'] : "" ?>">
			</div>
		</div>
		<!--Phone-->
		<div class="form-group">
			<label for="phone" class="col-sm-3 control-label">Phone:</label>
			<div class="col-sm-9">
				<input type="tel" name="phone" class="form-control required" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : "" ?>">
			</div>
		</div>
		<!--Email-->
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label">Email:</label>
			<div class="col-sm-9">
				<input name="email"  class="form-control required" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : "" ?>">
			</div>
		</div>
	</div>
	
	<!--Submission-->
	<div class="col-xs-12 col-sm-6 col-lg-5">
		<!--Title-->
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">Title:</label>
			<div class="col-sm-9">
				<input type="text" name="title" class="form-control required" value="<?php echo (isset($_POST['title'])) ? $_POST['title'] : "" ?>">
			</div>
		</div>
		<!--Genre-->
		<div class="form-group">
			<label for="genre" class="col-sm-3 control-label">Genre:</label>
			<div class="col-sm-9">
				<select name="genre" class="form-control required" value="<?php echo (isset($_POST['genre'])) ? $_POST['genre'] : "" ?>" >
					<?php
						echo genre_dropdown();
					?>
				</select>
			</div>
		</div>
		<!--Cover Letter-->
		<div class="form-group">
			<label for="cover-letter" class="col-sm-3 control-label">Cover Letter:</label>
			<div class="col-sm-9">
				<textarea name="cover_letter" class="form-control"><?php echo (isset($_POST['cover_letter'])) ? $_POST['cover_letter'] : "" ?></textarea>
			</div>
		</div>
		<!--Files-->
		<div class="form-group">
			<label for="upload-submission" class="col-sm-3 control-label">Upload File:</label>
			<div class="col-sm-9">
				<input type="file" name="file-to-upload" id="file-to-upload" class="form-control">
			</div>
		</div>
		<!--Submit-->
		<button type="submit" class="btn btn-block btn-success">Submit</button>
	</div>
</form>


<?php
include("inc/footer.php");
?>