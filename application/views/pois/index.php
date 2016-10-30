<div class="main">
  <div class="main-inner">
    <div class="container">
	  
		<?php if (isset($message) && $message!='') { ?>
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php echo $message; ?>
		</div>
		<?php } ?>
		
		<h3>Below is a list of the events.</h3>
		
		<table class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th> Title </th>
				<th> Address </th>
				<th> Start time </th>
				<th> End time </th>
				<th> Author </th>
				<th> Set status </th>
				<th class="td-actions"> </th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($events as $event): ?>
			  <tr>
				<td><?php echo htmlspecialchars($event->title,ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($event->address,ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($event->start_date_time,ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($event->end_date_time,ENT_QUOTES,'UTF-8');?></td>
				<td>
					<?php foreach ($event->users as $user):?>
						<?php echo anchor("user/".$user->id, htmlspecialchars($user->username,ENT_QUOTES,'UTF-8')) ;?><br />
					<?php endforeach?>
				</td>
				<td class="td-actions"><?php echo ($event->status==2) ? '<a href="'.site_url("events/unpublish/".$event->id).'" class="btn btn-info btn-small">Unpublish</a>' : '<a href="'.site_url("events/publish/".$event->id).'" class="btn btn-success btn-small">Publish</a>';?></td>
				<td class="td-actions">
				  <?php echo '<a href="'.site_url("event/".$event->id).'" class="btn btn-warning btn-small">Edit</a>'; ?>
				  <?php echo '<a href="'.site_url("events/delete/".$event->id).'" class="btn btn-danger btn-small">Delete</a>'; ?>
				</td>
			  </tr>			
			</tbody>
			<?php endforeach; ?>
		</table>
		
		<p>
			<a class="btn btn-small btn-success" href="<?php echo site_url('events/create'); ?>">Create a new event</a>
		</p>

	</div>
  </div>
</div>