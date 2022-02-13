Registration info here<br/>

<?php
$form = ['class' => 'basicform', 'id' => 'basicform']; 
$title = array('name' => 'title');
$upload = array('name' => 'basicfile'); 
$txtarea = array('name' => 'description'); 
$chkbox = array('name' => 'sex', 'id' => 'gender', 'checked' => true, 'value' => '', 'class' => ''); 
$radio = array('name' => 'radio'); 
$passwd = array('name' => 'save', 'id' => 'save', 'placeholder' => 'Your Password'); 
$dropdown = array('1' => 'Admin', '2' => 'Perticipant');

if($insert_mode){ echo('<p class="successmsg">Entry Mode Activated</p>'); }elseif($update_mode){ echo('<p class="successmsg">Update Mode Activated</p>'); } 

if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 

		$title['value'] = $row->title;
		$txtarea['value'] = $row->description;
		// $upload = array('name' => 'filename');  
		// $chkbox = array('value' => $row->sex); 
		// $radio = array('name' => 'radio'); 
		// $passwd = array('name' => 'save', 'id' => 'save', 'placeholder' => 'Your Password'); 
		// $dropdown = array('1' => 'Admin', '2' => 'Perticipant');

	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$title = array('value' => '');
	$upload = array('name' => 'basicfile','value' => ''); 
	$txtarea = array('value' => ''); 
	$chkbox = array('name' => 'sex', 'id' => 'gender', 'checked' => true, 'value' => '', 'class' => ''); 
	$radio = array('name' => 'radio'); 
	$passwd = array('name' => 'save', 'id' => 'save', 'placeholder' => 'Your Password'); 
	$dropdown = array('1' => 'Admin', '2' => 'Perticipant');
}

?>

<?php echo(img(img_data('images/picture.jpg'))); ?>

<?php echo(form_open_multipart($action, $form)); ?>
 
<?php echo(form_input($title)); ?><br/>
<?php echo(form_upload($upload)); ?><br/>
<?php echo(form_textarea($txtarea)); ?><br/>
<?php echo(form_checkbox($chkbox)); ?><br/>
<?php echo(form_radio()); ?><br/>
<?php echo(form_password($passwd)); ?><br/>
<?php echo(form_dropdown('login', $dropdown)); ?><br/>

<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
<?php #echo(csrf_field()); ?>

<?php $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT'); echo(form_submit($save)); ?>
<?php $reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET'); echo(form_reset($reset)); ?>
<?php $btn = array('name' => 'button', 'id' => 'button', 'value' => 'BUTTON'); echo(form_button($btn)); ?>

<?php echo(form_close()); ?>













