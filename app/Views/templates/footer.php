
<script type="text/javascript"></script>
<script src="<?php echo(base_url('js/jscript.js')); ?>"></script>
<dl id="developer">
	<dt><?php 
	$img = array('src' => 'images/cublogo.jpg', 'alt' => 'Developer Logo', 'width' => '80px', 'height' => '80px'); 
	echo(img($img)); ?></dt>
	<dd>
		C.T.O Forum Innovation Hackathon<br/>
		Copyright &copy; <?php echo(date('Y'))?><br/>
		<?php echo('Codeigniter '.CodeIgniter\CodeIgniter::CI_VERSION); ?><br/>
		Page rendered in {elapsed_time} seconds<br/>Developed By: Canadian University of Bangladesh<br/>
		Environment: <?php echo(ENVIRONMENT); ?>		
	</dd>
</dl>
</body>
</html>