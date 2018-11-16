<div id="secmid">
	<div  id="innercontent">
		<div class="announcement">
				<h3 class='announcement-post-title'>
					<?php if (isset($announcement->announcement_Title)) echo htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8'); ?>
				</h3>
				<div id="attachment" class="wp-caption alignright">
				<!-- <div id="attachment_377" class="wp-caption alignright"> -->

					<img id="myImg"  class="announcement-post-image-header" src="<?php echo URL.'uploads/'.$announcement->file_name ?>" alt=<?php $announcement->announcement_Title ?> >
					<div id="myModal" class="modal">
						<span class="close">&times;</span>
						<img class="modal-content" id="img01">
						<div id="caption">
						</div>
					</div>
					<script src=<?php echo URL."_js/imagemodal.js" ?>></script>
				</div>
			

				<div class="announcement-description">
					<?php if (isset($announcement->announcement_Text)) echo htmlspecialchars($announcement->announcement_Text, ENT_QUOTES, 'UTF-8'); ?>
				</div>
			</div>

			<div class="aside">
				<nav id="nav_menu-4" class="sidebar otherlinks widget_nav_menu">
					<h2>Sidebar Secondary Links</h2>
					<div id="menu-location-" class="menu-sidebar-secondary-links-container">
						<ol style="list-style-type: none;">
						
							<?php //check if admin view 
								if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {										
								}else{
									echo "<li><a href = ".URL . 'SOEInfoHubadmin/editform/'. htmlspecialchars($announcement->announcement_ID, ENT_QUOTES, 'UTF-8')." style='font-size:1.5em'>
									Make changes to this Event</a></li>";
								}
							?>
							
						
							<li style=" padding:1.25em;">
								

								<?php $url = 'https:'.URL;
									$title= $announcement->announcement_Title;
									echo '<a class="facebook-share-button" href="https://www.facebook.com/sharer.php?u='.urlencode($url).'&t='.urlencode($title).'" target="_blank">Share it in facebook</a>';
								?>

						<?php

                ?>
		
							<?php 
							        date_default_timezone_set('America/Chicago');
									$start_day =  str_replace("-", "", $announcement->start_day);
									$end_day =  str_replace("-", "", $announcement->end_day);
									$start_time =  str_replace(":", "", $announcement->start_time);
									$end_time =  str_replace(":", "", $announcement->end_time);
									// echo $announcement->end_day;

									echo "<a href='https://calendar.google.com/calendar/r/eventedit?
											text=".  htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8')."&
											dates=". urlencode($start_day)."/". urlencode($end_day)."&
											details=".  htmlspecialchars($announcement->announcement_Text, ENT_QUOTES, 'UTF-8')."&
											location=". urlencode($announcement->announcement_Location)."' target='_blank'>Add to gCal</a>";?>

								<?php echo "<a href = ".URL . 'announcement/getISC/'. htmlspecialchars($announcement->announcement_ID, ENT_QUOTES, 'UTF-8').">Calendar isc</a>";?>

								<?php echo "<form action=".URL."announcement/EmailtoFriend/$announcement->announcement_ID method='post' >
								<input type='email'  name='email' required /><input type='submit' value='Email to Self/Friend'  name='email_to_friend'/></form>";?>
						
							</li>
						</ol>
					</div>
				</nav> 
			</div>	

		</div>



	</div>
</div>