<div  id="secmid">
		<div  id="innercontent">
		

		<div class="searchbar">
			<!-- The School of Engineering Information Hub dashboard.  -->

			<?php
				if (($output = message()) !== null) {
					echo $output;
					$output=null;
				}
				$admin = $_SESSION["admin"];
				
				?>
				<div class="logout-button">			
				<a href=<?php echo URL;?> >Feed Page </a>

					Hi <?php echo $admin;?>!&nbsp;
					<a href=<?php echo URL;?>SOEInfoHubadmin/logout >  LOG OUT</a>
				</div>

			</div>

			<div class="admin-main">


			<table class='admin_dashboard'>
		<thead><tr class='admin-dashboard-head'>
						<th width='10%'>Starts at</th>
						<th width='15%'>Title</th>
						<th width='12%'>Contact name</th>
						<th width='48%'>Details</th>
						<th width='5%'>Edit</th>
						<th width='5%'>Publish</th>
						<th width='5%'>Delete</th>
					</tr>
				</thead>
		
				<?php
				// echo "<td>&nbsp;<a href = 'ViewResident.php?id=".urldecode($row["Student_id"])."'>View</a>&nbsp;&nbsp;</td>";

				foreach ($announcements as $row)  {
					echo '<tr ">';
					$row->start_day = date("F d", strtotime("$row->start_day"));
					$row->start_time = date("g:i a", strtotime($row->start_time));							

					echo '<td>'.htmlspecialchars($row->start_day, ENT_QUOTES, 'UTF-8')."\n".htmlspecialchars($row->start_time, ENT_QUOTES, 'UTF-8').'</td>';
					$string=htmlspecialchars($row->announcement_Text, ENT_QUOTES, 'UTF-8');
					echo "<td><a href = ".URL . 'announcement/getAnnouncementByID/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').">".$row->announcement_Title."</a></td>";
					$contact_Names = explode(',', $row->contact_Names);
					echo "<td>";
					foreach($contact_Names as $name){
						echo$name.'</br>';

					}echo"</td>";
						
						echo "<td style='text-align: justify;'>";
							echo $string; 
						echo"</td>";
				

						// echo "<td>&nbsp;<a href = 'mail.php?id=".urldecode($row->announcement_ID)."'>Email</a>|&nbsp;<a href = 'editAnnouncement.php?id=".urldecode($row["announcement_ID"])."'>Edit</a>&nbsp;&nbsp;|<a href = 'delete.php?id=".urldecode($row["announcement_ID"])." ' onclick='return confirm('Are you sure?');'><i class='fa fa-trash'></i>
						// </a>&nbsp;&nbsp;</td>";
						$class='unpublished-button';
						$value = 'Publish';

					if($row->published==1){
							$class='published-button';
							$value = 'Unpublish';
						} 
						echo "<td style='text-align:center;'><a href = ".URL . 'SOEInfoHubadmin/editform/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').">EDIT</a></td>";

						echo '<td style="text-align:center;"><form action='.URL . 'SOEInfoHubadmin/publish/'.htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').' method="post">';
							echo'<input type="submit" id="javascript-ajax-button" value='.$value.' class='.$class.'>';
							echo'<input type="hidden" name="publish_announcement" value="" >';
						echo'</form></td>';
						
						echo '<td style="text-align:center;"><form action='.URL .'SOEInfoHubadmin/delete/ method="post">';
							echo'<input type="submit" value="Delete" name="delete_announcement">';
							echo'<input type="hidden" name="announcement_ID" value='. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8').' />';
						echo'</form></td>';
						// echo "<td style='text-align:center;'><a href =".URL .'SOEInfoHubadmin/delete/'. htmlspecialchars($row->announcement_ID, ENT_QUOTES, 'UTF-8')." onclick='return confirm_delete();'><i class='fa fa-trash'></i> </a></td>";

					echo "</tr>";
				}
			echo "</table>";
			
			?>
			
			</div>
		</div>
	</div>
