<?php
$form = ['class' => 'teamPaymentForm', 'id' => 'teamPaymentForm']; 
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$bid = $row->bid;
	$teamid = $row->teamid;
	$payusing = array('name' => 'payusing','value' => $row->payusing);
	$amount = array('name' => 'amount','value' => $row->amount);
	$paydate = array('name' => 'paydate','value' => $row->paydate);
	$edate = array('name' => 'edate','value' => $row->edate);
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$bid = '';
	$teamid = '';
	$payusing = array('name' => 'payusing','placeholder' => '', 'autocomplete' => 'off');
	$paydate = array('name' => 'paydate','placeholder' => '', 'type' => 'date','autocomplete' => 'off');	
	$edate = array('name' => 'edate','placeholder' => '', 'type' => 'date','autocomplete' => 'off');
	$amount = array('name' => 'amount','placeholder' => '', 'autocomplete' => 'off');
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<?php echo(form_hidden('teamid', $bid)); ?>
	<div class="formbg"><?php echo('Payment Method'.form_input($payusing)); ?></div>
	<div class="formbg"><?php echo('Payment date'.form_input($paydate)); ?></div>
	<div class="formbg"><?php echo('Entry date'.form_input($edate)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>
