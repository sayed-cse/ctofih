<?php
$form = ['class' => 'basicform', 'id' => 'basicform']; 
$data = array('name' => 'description','rows' => '3','cols' => '110');
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
	<div class="formbg"><?php echo('Title'.form_input($title)); ?></div>
	<div class="formbg"><?php echo('TagLine'.form_input($tagline)); ?></div>
	<div class="formbg"><?php echo('Description'.form_textarea($data, $txtarea)); ?></div>
	<div class="formbg"><?php echo('Keywords'.form_input($keyword)); ?></div>
	<div class="formbg"><?php echo('Schedule'.form_input($schedule)); ?></div>
	<div class="formbg"><?php echo('Entry date'.form_input($entrydate)); ?></div>
	<div class="formbg"><?php echo('Update Status'.form_input($updatestatus)); ?></div>
	<div class="formbg"><?php echo('Rules'.form_input($rules)); ?></div>
	<div class="formbg"><?php echo('Year'.form_input($year)); ?></div>
	<div class="formbg"><?php echo('Fees'.form_input($fees)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>

<?php
#form_input($entrydate)
#$upload = array('name' => 'basicfile'); 
#$chkbox = array('name' => 'sex', 'id' => 'gender', 'checked' => true, 'value' => '', 'class' => ''); 
#$radio = array('name' => 'radio'); 
#$passwd = array('name' => 'save', 'id' => 'save', 'placeholder' => 'Your Password'); 
#$dropdown = array('1' => 'Admin', '2' => 'Perticipant');
?>
<?php #echo(img(img_data('images/picture.jpg'))); ?>
<?php #echo(form_upload($upload)); ?><br/>
<?php #echo(form_checkbox($chkbox)); ?><br/>
<?php #echo(form_radio()); ?><br/>
<?php #echo(form_password($passwd)); ?><br/>
<?php #echo(form_dropdown('login', $dropdown)); ?><br/>
<?php #echo(csrf_field()); ?>
