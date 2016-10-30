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
	      				<h3>Deactivate User <small><?php echo sprintf(lang('deactivate_subheading'), $user1->username);?>?</small></h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">

<?php echo form_open("auth/deactivate/".$user1->id, array("class"=>"form-horizontal"));?>
      <fieldset>		
            <div class="control-group">											
                <label class="control-label"><?php echo lang('deactivate_confirm_y_label', 'confirm');?></label>
                <div class="controls">
                    <input type="radio" name="confirm" value="yes" checked="checked" />
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->		
            <div class="control-group">											
                <label class="control-label"><?php echo lang('deactivate_confirm_n_label', 'confirm');?></label>
                <div class="controls">
                    <input type="radio" name="confirm" value="no" />
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->	
			<?php echo form_hidden($csrf); ?>
			<?php echo form_hidden(array('id'=>$user1->id)); ?>	
            <div class="control-group">											
                <label class="control-label"></label>
                <div class="controls">
                    <button type="submit" class="btn btn-success">Submit</button>
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
