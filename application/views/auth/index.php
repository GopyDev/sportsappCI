<div class="main">
  <div class="main-inner">
    <div class="container">
	  
		<?php if (isset($message) && $message!='') { ?>
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php echo $message; ?>
		</div>
		<?php } ?>
		
		<h3>Below is a list of the users.</h3>
		
		<table class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th> Username </th>
				<th> First name </th>
				<th> Last name </th>
				<th> E-mail </th>
				<th> Groups </th>
				<th> Status </th>
				<th class="td-actions"> </th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user): ?>
			  <tr>
				<td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
				<td>
					<?php foreach ($user->groups as $group):?>
						<?php echo anchor("groups/edit/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
					<?php endforeach?>
				</td>
				<td class="td-actions"><?php echo ($user->active) ? '<a href="'.site_url("users/deactivate/".$user->id).'" class="btn btn-success btn-small"><i class="btn-icon-only icon-ok"> </i></a>' : '<a href="'.site_url("users/activate/".$user->id).'" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>';?></td>
				<td class="td-actions"><?php echo '<a href="'.site_url("user/".$user->id).'" class="btn btn-warning btn-small">Edit</a>'; ?></td>
			  </tr>			
			</tbody>
			<?php endforeach; ?>
		</table>

		<p>
			<a class="btn btn-small btn-success" href="<?php echo site_url('users/create'); ?>">Create a new user</a>
			<a class="btn btn-small btn-info" href="<?php echo site_url('groups/create'); ?>">Create a new group</a>
		</p>

	</div>
  </div>
</div>