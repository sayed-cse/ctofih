<?php
$form = ['class' => 'departmentmasterForm', 'id' => 'departmentmasterForm']; 
$data = array('name' => 'description','rows' => '3','cols' => '110','style' => 'border-radius:10px;background-color:#ddd;border:none');
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$deptid = $row->deptid;
	$txtarea = $row->description; 
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$deptid = '';
	$txtarea = '';
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('deptid', $deptid)); ?>
	<div class="formbg"><?php echo('Description'.form_textarea($data, $txtarea)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>
