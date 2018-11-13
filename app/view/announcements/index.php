<div  id="secmid">
	<div  id="innercontent">
		<div class='announcement-items'>
		<?php
			foreach ($announcements as $row)  {
				echo '<div class="announcement-items announcement-post" id="'.$row->announcement_ID.'">';
					echo'<div id="attachment_377" class="wp-caption alignleft">';
						if (!$row->attachments){
							$row->attachments='placeholder.jpg';
						}
							$images = explode(',', $row->attachments);
						echo'<img class="announcement-post-image-header" src="'.URL."uploads/".$images[0].'" alt="'.$row->announcement_Title.'">';

						echo'<div id="myModal" class="modal">
								<span class="close">&times;</span>
								<img class="modal-content" id="img01">
								<div id="caption">
								</div>
								<script src="'.URL.'public/_js/imagemodal.js"></script>
							</div>';
					echo'</div>';

					echo'<div class="announcement-text alignright">';
						echo "<a href = ".URL . 'announcement/getAnnouncementByID/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').">";
							echo "<h3 class='announcement-post-title'>".$row->announcement_Title."</h3>";
						echo'</a>';

						echo'<b>Location:</b>'.$row->announcement_Location.'<br>';
						echo '<b>Date and time:</b>'.$row->start_day." at ".$row->announcement_time.' </br></br>';

						echo'<b>CONTACT:</b><br>';
						echo '<div class="contact" style="display:flex; padding-bottom:20px;">';

							$contact_Names = explode(',', $row->contact_Names);
							$emails = explode(',', $row->emails);
							$phones = explode(',', $row->phones);
							for ($x = 0; $x <sizeof($contact_Names); $x++) {
								echo '<div class="contact-display" style="padding-right:20px;">';

								echo $contact_Names[$x].'<br>';
								echo'<a href="mailto:'.$emails[$x].'?Subject='. htmlspecialchars($row->announcement_Title, ENT_QUOTES, 'UTF-8').'" target="_blank">'.$emails[$x].'</a><br>';
								if ($phones[$x]) echo'<a href="tel:'.$phones[$x].'" >'.$phones[$x].'</a><br>';
								echo' </div>';

							} 
						echo' </div>';

						echo '<div class="announcement-description">';
							echo'<b>Details:</b></br>';
							if (isset($row->announcement_Text)) $text =  htmlspecialchars($row->announcement_Text, ENT_QUOTES, 'UTF-8');

							echo (strlen($text) >= 500) ? 
										substr($text, 0, 500)."<a href ='announcement1.php?id=".urldecode($row->announcement_ID)."'>... Read more</a>":$row->announcement_Text;
						echo'</div>';
					echo"</div>";
				echo"</div>";
			}
		?>
		</div>
	</div>
</div>



