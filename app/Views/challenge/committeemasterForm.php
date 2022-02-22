<?php
$form = ['class' => 'committeeMasterForm', 'id' => 'committeeMasterForm']; 
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$cid = $row->cid;
	$committeeName = array('name' => 'committeename','value' => $row->committeename);
	$committeeRole = array('name' => 'tcommitteerole','value' => $row->committeerole);
	$entrydate = array('name' => 'entrydate','type' => 'date','value' => $row->edate);
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$cid = '';
	$committeeName = array('name' => 'committeename','placeholder' => '', 'autocomplete' => 'off');
	$committeeRole = array('name' => 'committeerole','placeholder' => '', 'autocomplete' => 'off');
	$entrydate = array('name' => 'entrydate','type' => 'date','placeholder' => '', 'autocomplete' => 'off');
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<div class="formbg"><?php echo('Committee Name'.form_input($$committeeName)); ?></div>
	<div class="formbg"><?php echo('Committee Role'.form_input($$committeeRole)); ?></div>
	<div class="formbg"><?php echo('Entry Date'.form_input($entrydate)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>
