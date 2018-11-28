<div  id="secmid">
	<div  id="innercontent">
		

		<div class='announcement-items'>
			<?php
			
                  if (($output = message()) !== null) {
                    echo $output;
                    $output=null;
                  }
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
						echo'<script src="'.URL.'_js/imagemodal.js"></script>';
						echo'<script src="'.URL.'_js/utilities.js"></script>';


						echo'<div class="announcement-text alignright">';
							echo "<a href = ".URL . 'announcement/a/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').">";
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
							
							



							echo '<div class="announcement-description"  style="padding-bottom:10px;">';
								echo'<b>Details:</b></br>';
								if (isset($row->announcement_Text)) $text =  htmlspecialchars($row->announcement_Text, ENT_QUOTES, 'UTF-8');
								
								echo (strlen($text) >= 500) ? 
										substr($text, 0, 500)."<a href =".URL . 'announcement/a/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').
										"'>... Read more</a>":$row->announcement_Text;
								if(!empty($row->external_link)){
								echo '<br><a class="preview" href='.$row->external_link.'>'.$row->external_link.'</a>';
								// echo'<div class="mypreview"><iframe src="http://en.wikipedia.org/" width = "500px" height = "500px"></iframe></div> ';
								}
							echo"</div>";//end of announcement-description

						
							echo'<b>Recommended for:</b><br>';
							echo '<div class="wrapper-con-rec">';

								echo '<div class="recommended" style=" padding-bottom:10px; ">';
									echo'<b>Majors: </b><br>';
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

								echo '<div class="recommended" style="margin-left:10px;">';
								echo'<b>Classifications: </b><br>';

								$classifications = explode(',', $row->cls_IDs);
								// print_r($majors);

								foreach($classifications as $c){
									foreach($all_cls as $cls_detail){
										if($c == $cls_detail->cls_ID){
													echo $cls_detail->cls_Name.", ";
												}
									}
								// 	

								}
							
								echo' </div>';
							
							echo' </div>';

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
						echo' </div>';//end of announcement-text alignright

					echo"</div><!-- end of announcement-post -->"; //
				}

			?>
		</div> <!-- end of  announcement-items-->
		 <!-- <span id="loadmore" num_loaded="10">Load More</span> -->
		 <div id="myNav" class="overlay">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<div class="overlay-content">
				<div class="card">
					<div class="container-card subscribe">
					<p style="color:white; ">
							We send out announcements of events to students. 
							You can get involved by subscribing.

						</p>
					<?php 
						if (($output = message()) !== null) {
							echo $output;
							$output=null;
						}

					?>
					<form action='<?php echo URL;?>announcement/subscribe' method="post">
						<table class="subscribe"> 
							<tbody class="subscribe tbody">
								<tr>
								<td><input type="text" name="first_name"  placeholder="First Name" required></td> 
								</tr>
								<tr>
								<td><input type="text" name="middle_name" placeholder="Middle Name" ></td> 
								</tr>
								<tr>
								<td> <input type="text" name="last_name" placeholder="Last Name" required></td> 
								</tr>
								<tr>
								<td> <input type="email" name="email"  placeholder="Email Address" required></td>
								</tr>
							</tbody>
						</table>
						
						<input type="submit" name="subscribe" value="Subscribe" class="button" style="border-radius:10px;"/>
						<a href="<?php echo URL;?>" style="color:white; font-size:1.5em;">Go back</a>
					</form>

					</div>
				</div>
			</div>
			</div>
					<script>
						function openNav() {
						document.getElementById("myNav").style.display = "block";
						}

						function closeNav() {
						document.getElementById("myNav").style.display = "none";
						}
					</script>
		<div class="rightsidebar">
			<nav id="nav_menu-1" class="sidebar otherlinks widget_nav_menu">
					<h2>Sidebar Secondary Links</h2>
					<div id="menu-location-" class="menu-sidebar-primary-links-container">
						<ol style="list-style-type: none;">
							<li style="  font-size:1.25em;">
								<a href="<?php echo URL;?>announcement/Form">Submit an announcement</a><br>
								<a  onclick="openNav()"> Join our email list</a>

								<!-- <a href="<?php echo URL;?>announcement/subscribe">Join our email list</a><br> -->
							</li>
							<li style=" font-size:1.25em;">
								<a href="<?php echo URL;?>SOEInfoHubadmin">Login</a>
							</li>

						</ol>
					</div>
			</nav>
		</div>



	</div><!-- end of  innercontent-->
</div> <!-- end of  secmid-->




