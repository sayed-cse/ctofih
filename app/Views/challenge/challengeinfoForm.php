<?php
$form = ['class' => 'challengeInfoForm', 'id' => 'challengeInfoForm']; 
$data = array('name' => 'description','rows' => '3','cols' => '110','style' => 'border-radius:10px;background-color:#ddd;border:none');
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$bid = $row->bid;
	$challengeid = $row->challengeid;
	$provider = array('name' => 'provider','value' => $row->provider);
	$contact = array('name' => 'contact','value' => $row->contact);
	$edate = array('name' => 'edate','type' => 'date','value' => $row->edate);
	$txtarea = $row->description;
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$bid = '';
	$challengeid = '';
	$provider = array('name' => 'provider','placeholder' => '', 'autocomplete' => 'off');
	$contact = array('name' => 'contact','value' => '', 'type' => 'date','autocomplete' => 'off');
	$contact = array('name' => 'edate','type' => 'date','value' => '', 'type' => 'date','autocomplete' => 'off');
	$txtarea = '';
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<?php echo(form_hidden($challengeid)); ?><br/>
	<?php echo('Description'.form_input($data, $txtarea)); ?><br/>
	<?php echo('Provider'.form_textarea($provider)); ?><br/>
	<?php echo('Contact'.form_input($contact)); ?><br/>
	<?php echo('Entry date'.form_input($edate)); ?><br/>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>
