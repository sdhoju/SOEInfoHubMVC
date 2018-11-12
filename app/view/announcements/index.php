

<div  id="secmid">
	<div  id="innercontent">

		<?php
		echo "	<div class='announcement-items'>";
			foreach ($announcements as $row)  {
				echo '<div class="announcement-items announcement-post" id="'.$row->announcement_ID.'">';
					echo'<div id="attachment_377" class="wp-caption alignleft">';
					if (!$row->attachments){
						$row->attachments='placeholder.jpg';
					}
						echo'<img class="announcement-post-image-header" src="'."uploads/".$row->attachments.'" alt="'.$row->announcement_Title.'">';
						echo'<div id="myModal" class="modal">
								<span class="close">&times;</span>
								<img class="modal-content" id="img01">
								<div id="caption">
								</div>
								<script src="_js/imagemodal.js"></script>
							</div>';
					echo'</div>';

					echo'<div class="announcement-text alignright">';
						echo "<a href = ".URL . 'announcement/getAnnouncementByID/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').">";
						// <td><a href="<?php echo URL . 'songs/editsong/' . htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ">edit</a></td>
						// echo URL . 'announcement/getAnnouncementByID/' . htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8');

							echo "<h3 class='announcement-post-title'>".$row->announcement_Title."</h3>";
						echo'</a>';
						// echo '<div class="announcement-items announcement-post-location">Location: '.$row['announcement_Location'].
						// '</br>Date and time: '.$row['announcement_date']." at ".$row['announcement_time']."</div>";
						echo'<b >'.$row->announcement_Location.'<br><br>'.$row->start_day." at ".$row->announcement_time.' </br>';
						echo '<div class="contact">';
						echo'<br> <br><br>CONTACT:<br>';
							$contact_Names = explode(',', $row->contact_Names);
							$emails = explode(',', $row->emails);
							$phones = explode(',', $row->phones);
							
							for ($x = 0; $x <sizeof($contact_Names); $x++) {
								echo $contact_Names[$x].'<br>'.$emails[$x]." </br> ".$phones[$x].' </br>';

							} 

						echo' </div>';
						echo '<div class="announcement-description">';
							echo (strlen($row->announcement_Text) >= 500) ? 
										substr($row->announcement_Text, 0, 500)."<a href ='announcement1.php?id=".urldecode($row->announcement_ID)."'>... Read more</a>":$row->announcement_Text;
						echo'</div>';

						// echo '<div class="announcement-items announcement-post" id="'.$row['announcement_ID'].'">';
						// 	echo "<a href = 'announcement1.php?id=".urldecode($row["announcement_ID"])."'>";
						// 		echo "<h3 class='announcement-post-title'>".$row['announcement_Title']."</h3>";
						// 		echo '<div class="announcement-items announcement-box" >';
						// 		echo '<img alt="" style=""class="announcement-post-image-header" src="'.$row['announcement_media'].'">
								
					echo '</div>';
				echo"</div>";
			}
			
		echo "</div>";
		?>

	</div>
</div>



