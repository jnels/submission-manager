<?php
include("inc/functions.php");
include("inc/header.php");
include("inc/form-validation.php");
?>

	<h1 class="text-center">Submit Electronically</h1>

	<form id="submission-form" class="form-horizontal">
		<!--User info-->
		<div class="col-xs-12 col-sm-6 col-lg-5 col-lg-offset-1">
			<!--Name-->
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Name:</label>
				<div class="col-sm-9">
					<input type="text" name="name" class="form-control">
				</div>
			</div>
			<!--Address1-->
			<div class="form-group">
				<label for="address1" class="col-sm-3 control-label">Address 1:</label>
				<div class="col-sm-9">
					<input type="text" name="address1" class="form-control">
				</div>
			</div>
			<!--Address2-->
			<div class="form-group">
				<label for="address2" class="col-sm-3 control-label">Address 2:</label>
				<div class="col-sm-9">
					<input type="text" name="address2" class="form-control">
				</div>
			</div>
			<!--City-->
			<div class="form-group">
				<label for="city" class="col-sm-3 control-label">City:</label>
				<div class="col-sm-9">
					<input type="text" name="city" class="form-control">
				</div>
			</div>
			<!--State-->

			<div class="form-group">
				<label for="state" class="col-sm-3 control-label">State:</label>
				<div class="col-sm-9">
					<input type="text" name="state" class="form-control">
				</div>
			</div>
			<!--Zip-->
			<div class="form-group">
				<label for="zip" class="col-sm-3 control-label">Zip:</label>
				<div class="col-sm-9">
					<input type="text" name="zip" class="form-control">
				</div>
			</div>

			<!--Phone-->
			<div class="form-group">
				<label for="phone" class="col-sm-3 control-label">Phone:</label>
				<div class="col-sm-9">
					<input type="text" name="phone" class="form-control">
				</div>
			</div>
			<!--Email-->
			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email:</label>
				<div class="col-sm-9">
					<input type="text" name="email" class="form-control">
				</div>
			</div>
		</div>
		
		<!--Submission-->
		<div class="col-xs-12 col-sm-6 col-lg-5">
			<!--Title-->
			<div class="form-group">
				<label for="title" class="col-sm-3 control-label">Title:</label>
				<div class="col-sm-9">
					<input type="text" name="title" class="form-control">
				</div>
			</div>
			<!--Genre-->
			<div class="form-group">
				<label for="genre" class="col-sm-3 control-label">Genre:</label>
				<div class="col-sm-9">
					<select name="genre" class="form-control">
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
					<textarea name="cover-letter" class="form-control"></textarea>
				</div>
			</div>
			<!--Files-->
			<div class="form-group">
				<label for="upload-submission" class="col-sm-3 control-label">Upload File:</label>
				<div class="col-sm-9">
					<input type="file" name="upload-submission" id="fileToUpload" class="form-control">
				</div>
			</div>
			<!--Submit-->
			<button type="submit" formmethod="post" class="btn btn-block btn-success">Submit</button>
		</div>
	</form>


<?php
include("inc/footer.php");
?>