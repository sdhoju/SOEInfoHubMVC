<div id="secmid">
	<div  id="innercontent">
		<div class="announcement">
				<h3 class='announcement-post-title'>
					<?php if (isset($announcement->announcement_Title)) echo htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8'); ?>
				</h3>
				<div id="attachment" class="wp-caption alignright" style="width:650px">
				<!-- <div id="attachment_377" class="wp-caption alignright"> -->
					<?php 

						$all_images=array();
						$all_pdfs=array();
						foreach($images as $image){
							$all_images[]=$image->file_name;
						}
						if (empty($all_images[0])){
							$all_images[0]='placeholder.jpg';
						}
						foreach($PDFs as $pdf){
							$all_pdfs[]=$pdf->file_name;
						}
					?>
					<img id="myImg"  class="announcement-post-image-header" src="<?php echo URL.'uploads/'.$all_images[0] ?>" alt=<?php $announcement->announcement_Title ?> >
					<?php
						if (!empty($all_pdfs)){
							echo'<br>';
							foreach($all_pdfs as $pdf){
					
								echo'<a href='.$pdf.' target="_blank" >'.$pdf.'</a>';

							}
	

						}
					?>
					
					<div id="myModal" class="modal">
							<span class="close">&times;</span>
							<img class="modal-content" id="img01">
							<div id="caption">
							</div>
						</div>
					<script src=<?php echo URL."_js/imagemodal.js" ?>></script>
					
				</div>
			

				<div class="announcement-description">
					<?php 
					if (isset($announcement->announcement_Text)) echo htmlspecialchars($announcement->announcement_Text, ENT_QUOTES, 'UTF-8'); 
					echo'</br></br><b>CONTACT:</b><br>';
					for ($x = 0; $x <sizeof($contacts); $x++) {
						echo '<div class="contact-display" style="padding-bottom:10px;">';
							echo $contacts[$x]->contact_Name.'<br>';
							echo'<a href="mailto:'.$contacts[$x]->email.'?Subject='. htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8').'" target="_blank">'.$contacts[$x]->email.'</a><br>';
							if ($contacts[$x]->phone) echo'<a href="tel:'.$contacts[$x]->phone.'" >'.$contacts[$x]->phone.'</a><br>';
						echo' </div>';//end of contact-display

					} 
				echo' </div>';//end of contact

				echo'<b>Recommended for:</b><br>';
							echo '<div class="wrapper-con-rec">';
								echo '<div class="recommended" style=" padding-bottom:10px; ">';
									echo'<u>Majors: </u><br>';
									// print_r($majors);
									echo '<ul>';
									
									foreach($majors as $major){
						
											echo '<li>'.$major->major_Name."</li>";	
									}
									echo'</ul>';
								
								echo' </div>';

								echo '<div class="recommended" style="margin-left:10px;">';
									echo'<u>Classifications: </u><br>';

									// print_r($majors);
									echo '<ul>';

									foreach($classifications as $c){
										echo '<li>'.$c->cls_Name."</li>";
									}
									echo'</ul>';

								echo' </div>';
							
							echo' </div>';
					?>
				</div>
			</div>

			<div class="rightsidebar">
				<nav id="nav_menu-4" class="sidebar otherlinks widget_nav_menu">
					<h2>Sidebar Secondary Links</h2>
					<div id="menu-location-" class="menu-sidebar-secondary-links-container">
						<ol style="list-style-type: none;">
						
							<?php //check if admin view 
								if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {										
								}else{
									echo "<li><a href = ".URL."SOEInfoHubadmin/dashboard style='font-size:1.5em'>
									Dashboard</a></li>";
									echo "<li><a href = ".URL . 'SOEInfoHubadmin/editform/'. htmlspecialchars($announcement->announcement_ID, ENT_QUOTES, 'UTF-8')." style='font-size:1.5em'>
									Make changes to this Event</a></li>";
								}
							?>
							
							<li><a href ="<?php echo URL;?>" style='font-size:1.5em'>All events.</a></li>
							<li style=" padding:1.25em;">
								<?php
									$url = 'https:'.URL;
									$title= $announcement->announcement_Title;
									echo '<a class="facebook-share-button" href="https://www.facebook.com/sharer.php?u='.urlencode($url).'&t='.urlencode($title).'" target="_blank">
									Share it in facebook</a>';
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
											dates=". urlencode($start_day)."T".$start_time."/". urlencode($end_day)."T".$end_time."&
											details=".  htmlspecialchars($announcement->announcement_Text, ENT_QUOTES, 'UTF-8')."&
											location=". urlencode($announcement->announcement_Location)."' target='_blank'>Add to Google Calendar</a>";?>

								<?php echo "<a href = ".URL . 'announcement/getISC/'. htmlspecialchars($announcement->announcement_ID, ENT_QUOTES, 'UTF-8').">Add to iCalendar/Outlook</a>";?>

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