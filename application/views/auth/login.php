<div class="account-container">
	<div class="content clearfix">
		<?php echo form_open("auth/login");?>
			<h1>Member Login</h1>		
			<div class="login-fields">
				<p>Please provide your details</p>
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="identity" name="identity" value="" placeholder="Username" class="login username-field" value="<?php echo $identity["value"]; ?>" />
				</div> <!-- /field -->
				<div class="field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field" />
				</div> <!-- /password -->
				<?php if (isset($message)) { ?>
					<div class="alert alert-warning" id="infoMessage">						
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<?php echo $message;?>
					</div>
				<?php } ?>
			</div> <!-- /login-fields -->
			<div class="login-actions">
				<span class="login-checkbox">
					<input id="remember" name="remember" type="checkbox" class="field login-checkbox" value="1" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>			
				<button class="button btn btn-success btn-large">Sign In</button>
			</div> <!-- .actions -->
		<?php echo form_close();?>
	</div> <!-- /content -->
</div> <!-- /account-container -->
<div class="login-extra">
	<a href="<?php echo site_url("auth/forgot_password"); ?>">Reset Password</a>
</div> <!-- /login-extra -->