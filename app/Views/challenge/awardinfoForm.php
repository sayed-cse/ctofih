<?php
$form = ['class' => 'awardInfoForm', 'id' => 'awardInfoForm']; 
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$bid = '';
	$awardName = array('name' => 'awardname','value' => $row->awardname);
	$amount = array('name' => 'amount','value' => $row->amount);
	$edate = array('name' => 'edate','type' => 'date','value' => $row->edate);
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$bid = '';
	$awardName = array('name' => 'awardname','placeholder' => '', 'autocomplete' => 'off');
	$amount = array('name' => 'amount','placeholder' => '', 'autocomplete' => 'off');
	$edate = array('name' => 'edate','type' => 'date','placeholder' => '', 'autocomplete' => 'off');
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<div class="formbg"><?php echo('Award Name'.form_input($awardName)); ?></div>
	<div class="formbg"><?php echo('Amount'.form_input($amount)); ?></div>
	<div class="formbg"><?php echo('Entry Date'.form_input($edate)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>

