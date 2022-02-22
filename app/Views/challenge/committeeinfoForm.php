<?php
$form = ['class' => 'committeeInfoform', 'id' => 'committeeInfoform']; 
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$cid = $row->cid;
	$coid = $row->coid;
	$bid = $row->bid;
	$cname = array('name' => 'name','value' => $row->name);
	$cdesignation = array('name' => 'designation','value' => $row->designation);
	$cinstitution = array('name' => 'institution','value' => $row->institution);
	$cemail = array('name' => 'email', 'type' => 'email','value' => $row->email);
	$cellno = array('name' => 'cellno','value' => $row->cellno);
	$edate = array('name' => 'edate','type' => 'date','value' => $row->edate);
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$cid = '';
	$coid = '';
	$bid = '';
	$cname = array('name' => 'name','placeholder' => '', 'autocomplete' => 'off');
	$cdesignation = array('name' => 'designation','placeholder' => '', 'autocomplete' => 'off');
	$cinstitution = array('name' => 'institution','placeholder' => '', 'autocomplete' => 'off');
	$cemail = array('name' => 'email','type' => 'email','placeholder' => '', 'autocomplete' => 'off');
	$cellno = array('name' => 'cellno','placeholder' => '', 'autocomplete' => 'off');
	$edate = array('name' => 'edate','value' => '','type' => 'date','autocomplete' => 'off');
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('cid', $cid)); ?>
	<?php echo(form_hidden('coid', $coid)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<div class="formbg"><?php echo('Name'.form_input($cname)); ?></div>
	<div class="formbg"><?php echo('Designation'.form_input($cdesignation)); ?></div>
	<div class="formbg"><?php echo('Institution'.form_input($cinstitution)); ?></div>
	<div class="formbg"><?php echo('Email'.form_input($cemail)); ?></div>
	<div class="formbg"><?php echo('Cell No'.form_input($cellno)); ?></div>
	<div class="formbg"><?php echo('Entry date'.form_input($edate)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>

