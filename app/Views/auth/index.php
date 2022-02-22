<div id="tabset" class="tabset">
	<input type="radio" name="tabset" id="tab1" aria-controls="a" checked><label for="tab1">&#128101; Sign In</label>
	<input type="radio" name="tabset" id="tab2" aria-controls="b"><label for="tab2">&#128101; Sign Up</label>
	<div class="tab-panels">
		<section id="a" class="tab-panel"><!-- Login -->
			<form method="post" enctype="application/x-www-form-urlencoded" action="<?php echo(site_url('auth/signin')); ?>">
			<div class="formbg">
				<select name="ltype" required>
					<option value="0">&#9748; Choose Category...</option>
					<option value="1">Super User</option>
					<option value="2">Committee/Jury</option>
					<option value="3">Participant</option>
				</select>
			</div>
			<div class="formbg">
				<input type="email" name="login" autocomplete="off" required placeholder="&#128100; Login Credentials"/>
			</div>	
			<div class="formbg">
				<input type="password" name="passwd" autocomplete="off" required placeholder="&#128274; Login Secret"/>
			</div>	
				<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>	 					
			<div class="endTitle"><input type="submit" name="signin" value="LOGIN"/> &nbsp;<input type="reset" name="reset" value="RESET"/></div>
		</form>
		</section>
		<section id="b" class="tab-panel"><!-- Register -->
			<form name="signup" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo(site_url('auth/signup')); ?>" onsubmit="processSubmit();">
			<div class="formbg">
				<input type="email" name="umail" autocomplete="off" required placeholder="&#127759; Your Email"/>
			</div>	
			<div class="formbg">
				<input type="text" name="uname" autocomplete="off" required placeholder="&#128100; Login Name"/>
			</div>				
			<div class="formbg">
				<input type="password" name="password" autocomplete="off" required placeholder="&#128274; Login Password"/>
			</div>	
				<?php echo(form_hidden(csrf_token(), csrf_hash())); ?>	 					
			<div class="endTitle"><input type="submit" id="save" name="save" value="SAVE"/> &nbsp;<input type="reset" id="reset" name="reset" value="RESET"/></div>
			</form> 
		</section>
	</div>
</div><div id="loader"><br/>Please Wait! Processing Data...<br/></div>
<script>function processSubmit(){ document.getElementById('tabset').style.display = "none"; document.getElementById('loader').style.display = "block"; }</script>
