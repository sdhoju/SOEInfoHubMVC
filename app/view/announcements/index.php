<div  id="secmid">
	<div  id="innercontent">
		

		<div class='announcement-items'>
			<?php
				if (empty($announcements)){
					echo '<div class="announcement-post" style="font-size:3em!important; margin-left:100px;">';

					echo 'No events at the moment.
					</div>';

				}	
		
				foreach ($announcements as $row)  {
					echo '<div class="announcement-post">';
						echo'<div id="attachment_377" class="wp-caption alignleft">';
							
								$images = $row->attachments;
								if (empty($images)){
									$images='placeholder.jpg';
								}else{
									$file_ext= explode('.',$images);
									$file_ext=strtolower(end($file_ext));
									$extensions= array("jpeg","jpg","png");
									
									if(in_array($file_ext,$extensions) === false){
										$images='placeholder.jpg';
									}
								}
							
							echo'<img class="announcement-post-image-header" src="'.URL."uploads/".$images.'" alt="'.$row->announcement_Title.'">';
						
						echo'</div>';//end of attachment_377
						echo'<div id="myModal" class="modal">
							<span class="close">&times;</span>
							<img class="modal-content" id="img01">
							<div id="caption">
							</div>
						</div>';//end of modal
						echo'<script src="'.URL.'public/_js/imagemodal.js"></script>';

						echo'<div class="announcement-text alignright">';
							echo "<a href = ".URL . 'announcement/getAnnouncementByID/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').">";
								echo "<h3 class='announcement-post-title'>".$row->announcement_Title."</h3>";
							echo'</a>';
							echo'<b>Location:</b>'.$row->announcement_Location.'<br>';
							// echo 'asd';
							$row->start_day = date("F d, Y", strtotime("$row->start_day"));
							$row->end_day = date("F d, Y", strtotime("$row->end_day"));
							$row->start_time = date("g:i a", strtotime($row->start_time));							
							$row->end_time = date("g:i a", strtotime($row->end_time));
							if($row->start_day == $row->end_day)
								echo '<b>Date and time:</b> '.$row->start_day." ".$row->start_time." to ".$row->end_time.' </br></br>';
							else							
								echo '<b>Date and time:</b> '.$row->start_day." ".$row->start_time." to ".$row->end_day." ".$row->end_time.' </br></br>';

							echo '<div class="wrapper-con-rec">';
							echo '<div class="contact" style=" padding-bottom:20px;">';
							echo'<b>CONTACT:</b><br>';

								$contact_Names = explode(',,,', $row->contact_Names);
								$emails = explode(',,,', $row->emails);
								$phones = explode(',,,', $row->phones);
								// echo ($row->contact_Names);
								for ($x = 0; $x <sizeof($contact_Names); $x++) {
									echo '<div class="contact-display" style="padding-bottom:10px;">';
										echo $contact_Names[$x].'<br>';
										echo'<a href="mailto:'.$emails[$x].'?Subject='. htmlspecialchars($row->announcement_Title, ENT_QUOTES, 'UTF-8').'" target="_blank">'.$emails[$x].'</a><br>';
										if ($phones[$x]) echo'<a href="tel:'.$phones[$x].'" >'.$phones[$x].'</a><br>';
									echo' </div>';//end of contact-display

								} 
							echo' </div>';//end of contact
							echo '<div class="recommended" style=" padding-bottom:20px; margin-left:5px">';
							echo'<b>Recommended for:</b><br>';

								$majors = explode(',', $row->major_IDs);
								// print_r($majors);

								foreach($majors as $major){
									foreach($all_majors as $major_detail){
										if($major == $major_detail->major_ID){
													echo $major_detail->major_Name.", ";
												}
									}
								// 	

								}
							
							echo' </div>';
							echo' </div>';


							echo '<div class="announcement-description">';
								echo'<b>Details:</b></br>';
								if (isset($row->announcement_Text)) $text =  htmlspecialchars($row->announcement_Text, ENT_QUOTES, 'UTF-8');

								echo (strlen($text) >= 500) ? 
										substr($text, 0, 500)."<a href =".URL . 'announcement/getAnnouncementByID/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').
										"'>... Read more</a>":$row->announcement_Text;
								echo $row->external_link;
							echo"</div>";//end of announcement-description
						echo' </div>';//end of announcement-text alignright

					echo"</div><!-- end of announcement-post -->"; //
				}
		
			?>
		</div> <!-- end of  announcement-items-->

		<div class="rightsidebar">
			<nav id="nav_menu-4" class="sidebar otherlinks widget_nav_menu">
					<h2>Sidebar Secondary Links</h2>
					<div id="menu-location-" class="menu-sidebar-secondary-links-container">
						<ol style="list-style-type: none;">
							<li style=" padding:1.25em; font-size:1.25em;">
								<a href="<?php echo URL;?>announcement/Form">Submit form</a><br>
							</li>
							<li style=" padding:1.25em; font-size:1.25em;">
								<a href="<?php echo URL;?>SOEInfoHubadmin">Login</a>
							</li>

						</ol>
					</div>
			</nav>
		</div>



	</div><!-- end of  innercontent-->
</div> <!-- end of  secmid-->




