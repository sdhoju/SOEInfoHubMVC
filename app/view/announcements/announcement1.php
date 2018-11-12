<div id="secmid">
	<div  id="innercontent">
	<div class="announcement">
			<h3 class='announcement-post-title'>
				<?php if (isset($announcement->announcement_Title)) echo htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8'); ?>
			</h3>
			<div id="attachment" style="max-width: 480px; max-height:480px" class="wp-caption alignright">
			<!-- <div id="attachment_377" class="wp-caption alignleft"> -->
				<img id="myImg"  class="announcement-post-image-header" src=<?php echo $announcement->announcement_media ?> alt=<?php $announcement->announcement_Title ?> >
				<div id="myModal" class="modal">
					<span class="close">&times;</span>
					<img class="modal-content" id="img01">
					<div id="caption">
					</div>
				</div>
				<script src=<?php echo URL."_js/imagemodal.js" ?>></script>
			</div>
			<p><?php if (isset($announcement->announcement_Text)) echo htmlspecialchars($announcement->announcement_Text, ENT_QUOTES, 'UTF-8'); ?></p>
		</div>

		<div class="aside">
			<nav id="nav_menu-4" class="sidebar otherlinks widget_nav_menu">
				<h2>Sidebar Secondary Links</h2>
				<div id="menu-location-" class="menu-sidebar-secondary-links-container">
					<ul id="menu-sidebar-secondary-links" class="menu">
						<li>
						<form action="" method="post"> <input type="submit" value="Email to self"  name="email_to_self"/></form>
						</li>
						<li >
						
						<?php $url = 'https:'.URL.trim($_SERVER['REQUEST_URI'], '/~sdhoju/SOEInfoHub/public/');
							
							echo '<a class="facebook-share-button" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($url).'" target="_blank">Share it in facebook</a>';
							// <a href="http://asb.olemiss.edu/resources/calendar-of-events/">Calendar of Events</a>
						?>
							</li>
						
					</ul>
				</div>
			</nav> 
		</div>	

		<div class="infoside">
		<div class="announcement-features">
			
			</div>



	</div>
</div>
<!-- 

	echo '';

	echo '';
	echo'<a class="facebook-share-button" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($url).'" target="_blank">Share it in facebook</a>';
	echo'<br><a class="twitter-share-button" href="http://twitter.com/share?url='.urlencode($url).'" target="_blank">Share it in Twitter</a>'; -->

<!-- if(isset($_POST['button_pressed'])){
	$to=array(
		
		array(
			'name'=>'Sameer Dhoju',
			'email'=>'sdhoju@go.olemiss.edu'
		),
			
		array(		
			'name'=>'MunMun Shrestha',
			'email'=>'mshresth@go.olemiss.edu'
		),
	);
	$subject=$row['announcement_Title'];
	$html='<h3>"'.$row['announcement_Title'].'"</h3>
		<img id="myImg"  class="announcement-post-image-header" src="'.$row['announcement_media'].'"alt='.$row['announcement_Title'].'>		
		<p>'. $row['announcement_Text'].'</p>';
	$from=array('name'=>'Sameer Dhoju','email'=>'samee.dhoju@gmail.com');
	$replyto=array('name'=>'Sameer Dhoju','email'=>'samee.dhoju@gmail.com');

	$newMailer = new Mailer(true);
	$newMailer->mail($to,$subject,$html,$from,$replyto); -->