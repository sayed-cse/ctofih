<?php
$form = ['class' => 'basicform', 'id' => 'basicform']; 
$data = array('name' => 'description','rows' => '3','cols' => '110','style' => 'border-radius:10px;background-color:#ddd;border:none');
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
		$bid = $row->bid;
		$title = array('name' => 'title','value' => $row->title);
		$tagline = array('name' => 'tagline','value' => $row->tagline);
		$keyword = array('name' => 'keyword','value' => $row->keyword);
		$schedule = array('name' => 'schedule','value' => $row->schedule);
		$entrydate = array('name' => 'entrydate','value' => $row->entrydate);
		$year = array('name' => 'year','value' => $row->year);
		$updatestatus = array('name' => 'updatestatus','value' => $row->updatestatus);
		$rules = array('name' => 'rules','value' => $row->rules);
		$fees = array('name' => 'fees','value' => $row->fees);
		$txtarea = $row->description; 
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$bid = '';
	$title = array('name' => 'title','placeholder' => '', 'autocomplete' => 'off');
	$tagline = array('name' => 'tagline','placeholder' => '', 'autocomplete' => 'off');
	$keyword = array('name' => 'keyword','placeholder' => '', 'autocomplete' => 'off');
	$schedule = array('name' => 'schedule','placeholder' => '', 'autocomplete' => 'off');
	$entrydate = array('name' => 'entrydate','value' => '', 'type' => 'date','autocomplete' => 'off');
	$year = array('name' => 'year','placeholder' => '', 'autocomplete' => 'off');
	$updatestatus = array('name' => 'updatestatus','placeholder' => '', 'autocomplete' => 'off');
	$rules = array('name' => 'rules','placeholder' => '', 'autocomplete' => 'off');
	$fees = array('name' => 'fees','placeholder' => '', 'autocomplete' => 'off');
	$txtarea = '';
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<?php echo('Title'.form_input($title)); ?><br/>
	<?php echo('TagLine'.form_input($tagline)); ?><br/>
	<?php echo('Description'.form_textarea($data, $txtarea)); ?><br/>
	<?php echo('Keywords'.form_input($keyword)); ?><br/>
	<?php echo('Schedule'.form_input($schedule)); ?><br/>
	<?php echo('Entry date'.form_input($entrydate)); ?><br/>
	<?php echo('Update Status'.form_input($updatestatus)); ?><br/>
	<?php echo('Rules'.form_input($rules)); ?><br/>
	<?php echo('Year'.form_input($year)); ?><br/>
	<?php echo('Fees'.form_input($fees)); ?><br/>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>

