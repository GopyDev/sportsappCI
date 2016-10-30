<div class="account-container">
	<div class="content clearfix">
		<?php echo form_open("auth/forgot_password");?>
			<h1>Forgot Password</h1>		
			<div class="login-fields">
				<p>Please enter your Identity so we can send you an email to reset your password.</p>
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="identity" name="identity" value="" placeholder="Username" class="login username-field" />
				</div> <!-- /field -->
			</div> <!-- /login-fields -->
			<div class="login-actions">		
				<button class="button btn btn-success btn-large">Submit</button>
			</div> <!-- .actions -->
		<?php echo form_close();?>
	</div> <!-- /content -->
    <div id="infoMessage"><?php echo $message;?></div>
</div> <!-- /account-container -->
<div class="login-extra">
	<a href="<?php echo site_url("auth/login"); ?>">Back to login</a>
</div> <!-- /login-extra -->
