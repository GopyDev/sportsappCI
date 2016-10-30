<div class="main">	
	<div class="main-inner">
	    <div class="container">
			
		<?php if (isset($message) && $message!='') { ?>
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php echo $message; ?>
		</div>
		<?php } ?>
		
	      <div class="row">
	      	<div class="span12">      		
	      		<div class="widget ">
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Create user <small>Please enter the user's information below.</small></h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">
<?php echo form_open("auth/create_user", array("class"=>"form-horizontal"));?>
      <fieldset>										
            <div class="control-group">											
                <label class="control-label" for="identity">Username</label>
                <div class="controls">
                    <input type="text" name="identity" class="span6" id="identity" value="<?php echo $identity["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->			
            <div class="control-group">											
                <label class="control-label" for="first_name">First name</label>
                <div class="controls">
                    <input type="text" name="first_name" class="span6" id="first_name" value="<?php echo $first_name["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="last_name">Last name</label>
                <div class="controls">
                    <input type="text" name="last_name" class="span6" id="last_name" value="<?php echo $last_name["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="company">Company</label>
                <div class="controls">
                    <input type="text" name="company" class="span6" id="company" value="<?php echo $company["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="email">E-mail</label>
                <div class="controls">
                    <input type="email" name="email" class="span6" id="email" value="<?php echo $email["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="phone">Phone</label>
                <div class="controls">
                    <input type="text" name="phone" class="span6" id="phone" value="<?php echo $phone["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="password" name="password" class="span6" id="password" value="<?php echo $password["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="password_confirm">Password confirm</label>
                <div class="controls">
                    <input type="password" name="password_confirm" class="span6" id="password_confirm" value="<?php echo $password_confirm["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label"></label>
                <div class="controls">
                 <button type="submit" class="btn btn-success">Create user</button>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
                        
      </fieldset>


<?php echo form_close();?>	
						
					</div> <!-- /widget-content -->
				</div> <!-- /widget -->
		    </div> <!-- /span8 -->
	      </div> <!-- /row -->
	    </div> <!-- /container -->
	</div> <!-- /main-inner -->
</div> <!-- /main -->
