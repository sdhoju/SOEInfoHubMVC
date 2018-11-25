<div  id="secmid">
	<div  id="innercontent">
	<center> <a href="<?php echo URL;?>" style="  font-size:2em; ">Back to feed page</a>            </center>
					<div class="card">
					<?php 
								if (($output = message()) !== null) {
									echo $output;
									$output=null;
								}
							?>
						<div class="container-card">
						<form action='<?php echo URL; ?>SOEInfoHubadmin/login' method="post">
							<h3 style="font-size:1.8em; padding-botton:2em;">Login </h3>
									<p>Username:
							<input type="text" name="username"  required/>
							</p>
							<p>Password:
							<input type="password" name="password" value="" required/>
							</p>
							<input type="submit" name="login" value="login" class="login-button" />
						</form>
						</div>
					</div>

	</div>
</div>
