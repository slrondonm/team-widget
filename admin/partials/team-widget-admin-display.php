<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://gitlab.com/slrondonm
 * @since      1.0.0
 *
 * @package    Team_Widget
 * @subpackage Team_Widget/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
	<div class="container">
		<form class="well form" action=" " method="post" id="contact_form">
			<fieldset>
				<!-- row -->
				<div class="form-row">
					<!-- Text input-->
					<div class="form-group col-md-6">
						<label class="control-label">Employment</label>
						<div class="inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input name="employment" placeholder="Employment" class="form-control" type="text">
							</div>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group col-md-6">
						<label class="control-label">Department</label>
						<div class="inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input name="department" placeholder="Department" class="form-control" type="text">
							</div>
						</div>
					</div>
				</div>

				<div class="form-row">
					<!-- Text area -->
					<div class="form-group col">
						<label class="control-label">Description</label>
						<div class="inputGroupContainer">
							<div class="input-group">
								<textarea class="form-control" name="description" id="description" rows="3"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="form-row">
					<!-- Text input-->
					<div class="form-group col-md-6">
						<label class="control-label">E-Mail</label>
						<div class="inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input name="email" placeholder="E-Mail Address" class="form-control" type="text">
							</div>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group col-md-6">
						<label class="control-label">Contact No.</label>
						<div class="inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
								<input name="contact_no" placeholder="(57) 000 000 0000" class="form-control" type="phone">
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
</div>
