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
	      				<h3>Create Group <small>Please enter the group information below.</small></h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">

<?php echo form_open("auth/create_group", array("class"=>"form-horizontal"));?>
      <fieldset>										
            <div class="control-group">											
                <label class="control-label" for="group_name">Group name</label>
                <div class="controls">
                    <input type="text" name="group_name" class="span6" id="group_name" value="<?php echo $group_name["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->									
            <div class="control-group">											
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                    <input type="text" name="description" class="span6" id="description" value="<?php echo $description["value"]; ?>">
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            <div class="control-group">											
                <label class="control-label"></label>
                <div class="controls">
                 <button type="submit" class="btn btn-success">Create group</button>
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