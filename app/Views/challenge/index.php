hello challenge
<?php 
foreach($info->getResult() as $row) { ?>

    <?php echo($row->title); ?><a href="challenge/basicForm/<?php echo($row->bid); ?>">EDIT</a>

<?php } ?>