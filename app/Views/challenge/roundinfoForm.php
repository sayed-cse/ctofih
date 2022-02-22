<?php
$form = ['class' => 'roundInfoForm', 'id' => 'roundInfoForm']; 
if($update_mode == true && $insert_mode == false)
{
	foreach($query->getResult() as $row): 
	$bid = $row->bid;
	$roundid = $row->roundid;
	$roundName = array('name' => 'title','value' => $row->roundname);
	$edate = array('name' => 'tagline','type' => 'date','value' => $row->edate);
	endforeach; 	 
}
elseif($insert_mode == true && $update_mode == false) 
{
	$bid = '';
	$roundid = '';
	$roundName = array('name' => 'roundname','placeholder' => '', 'autocomplete' => 'off');
	$edate = array('name' => 'edate','type' => 'date','placeholder' => '', 'autocomplete' => 'off');
}
?>
<div id="form">
	<p class="hTitle"><?php echo($update_mode ? '&#9997; Update Mode Activated' : '&#9997; Entry Mode Activated'); ?></p>
	<?php echo(form_open_multipart($action, $form)); ?>
	<?php echo(form_hidden('bid', $bid)); ?>
	<?php echo(form_hidden('roundid', $roundid)); ?>
	<div class="formbg"><?php echo('Round Name'.form_input($roundName)); ?></div>
	<div class="formbg"><?php echo('Entry Date'.form_input($edate)); ?></div>
	<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>
	<?php
		$insert_mode ? $save = array('name' => 'save', 'id' => 'save', 'value' => 'INSERT') : $save = array('name' => 'save', 'id' => 'save', 'value' => 'UPDATE');
		$reset = array('name' => 'reset', 'id' => 'reset', 'value' => 'RESET');
		echo('<p class="formFoot">'.form_submit($save) . form_reset($reset).'</p>');
	?>
	<?php echo(form_close()); ?>	
</div>
