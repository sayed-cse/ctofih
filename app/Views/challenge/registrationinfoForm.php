<?php
$form = ['class' => 'registrationForm', 'id' => 'registrationForm']; 
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$bid = $row->bid;
	$regid = $row->regid;
	$opendate = array('name' => 'opendate','value' => $row->opendate);
	$closedate = array('name' => 'closedate','value' => $row->closedate);
	$edate = array('name' => 'edate','value' => $row->edate);
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$bid = '';
	$regid = '';
	$opendate = array('name' => 'opendate','value' => '');
	$closedate = array('name' => 'closedate','value' => '');
	$edate = array('name' => 'edate','value' => '');
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<?php echo(form_hidden('regid', $regid)); ?>
	<div class="formbg"><?php echo('Open date'.form_input($opendate)); ?></div>
	<div class="formbg"><?php echo('Close Date'.form_input($closedate)); ?></div>
	<div class="formbg"><?php echo('Entry Date'.form_input($edate)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>
