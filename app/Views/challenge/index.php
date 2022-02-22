<p class="uText">HACKATHON</p>	
<p class="vText">HACKATHON</p>
<br/>


<?php foreach($info->getResult() as $row) { ?>
<p>
<?php echo($row->title.'<a href="challenge/basicForm/'.$row->bid.'"> EDIT</a> | <a href="challenge/eraseBasic/?bid='.$row->bid.'"> DELETE</a>'); ?>
</p>
<?php #echo('<img style="width:100px;height:80px" alt="'.$row->title.' image" src="/images/basicinfo/'.$row->tagline.'" />'); ?>
<?php } ?>

