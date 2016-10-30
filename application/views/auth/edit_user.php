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
	      				<h3>Edit user <small>Please enter the user's information below.</small></h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">

<?php echo form_open(uri_string(), array("class"=>"form-horizontal"));?>
      <fieldset>										
            <div class="control-group">											
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" class="span6 disabled" id="username" value="<?php echo $user->username; ?>" disabled>
                    <p class="help-block">The username is for logging in and cannot be changed.</p>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->			
            <div class="control-group">											
                <label class="control-label" for="first_name">First name</label>
                <div class="controls">
                    <input type="text" class="span6" name="first_name" id="first_name" value="<?php echo $user->first_name; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="last_name">Last name</label>
                <div class="controls">
                    <input type="text" class="span6" name="last_name" id="last_name" value="<?php echo $user->last_name; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="company">Company</label>
                <div class="controls">
                    <input type="text" class="span6" name="company" id="company" value="<?php echo $user->company; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="phone">Phone</label>
                <div class="controls">
                    <input type="text" class="span6" name="phone" id="phone" value="<?php echo $user->phone; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
            <div class="control-group">											
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="password" name="password" class="span6" id="password">
                    <p class="help-block">If changing password.</p>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label" for="password_confirm">Password confirm</label>
                <div class="controls">
                    <input type="password" class="span6" name="password_confirm" id="password_confirm">
                    <p class="help-block">If changing password.</p>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->            

            <?php if ($this->ion_auth->is_admin()): ?>
            
                  <div class="control-group">											
                      <label class="control-label" for="groups">Member of groups</label>
                      <div class="controls">
                          <?php foreach ($groups as $group):?>
                              <label class="checkbox">
                              <?php
                                  $gID=$group['id'];
                                  $checked = null;
                                  $item = null;
                                  foreach($currentGroups as $grp) {
                                      if ($gID == $grp->id) {
                                          $checked= ' checked="checked"';
                                      break;
                                      }
                                  }
                              ?>
                              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                              <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                              </label>
                          <?php endforeach?>
                      </div> <!-- /controls -->				
                  </div> <!-- /control-group -->
                        
            <?php endif ?>
            
            <div class="control-group">											
                <label class="control-label"></label>
                <div class="controls">
                  <?php echo form_hidden('id', $user->id);?>
                  <?php echo form_hidden($csrf); ?>
                 <button type="submit" class="btn btn-success">Save user</button>
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

