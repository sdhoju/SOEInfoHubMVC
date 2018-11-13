
<div  id="secmid">
	<div  id="innercontent">
	<script src="<?php echo URL; ?>public/_js/utilities.js" type="text/javascript"></script>
	<?php 
		if (($output = message()) !== null) {
			echo $output;
			$output=null;
		}
	?>
		<div class='create-announcement-form'>
			<form action='<?php echo URL; ?>announcement/submitAnnouncement' method='post'  enctype="multipart/form-data">
			<center> <h3 style="font-size: 2em;text-align:center">Please fill this form to submit your event</h3>
					 
				<table id='t01'>
					<tr><td>Tell us about yourself. </td></tr>
					<tbody class="contact-info">
						<tr><td>Contact's Name <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='contact_Name[]' value= '' required/></td></tr>
						<tr><td>Contact Email <span class="asterisk">*</span></td><tr></tr><td><input type="email" name ='email[]' value= '' required/></td></tr>
						<tr><td>ContactPhone  </td><tr></tr><td><input type = text name ='phone[]' value= ''  /></td></tr>
						<tr>
							<td>Organization  </td><tr></tr><td><input type = text name ='S_Organization[]' value= '' /></td>
							<td ><button class="add-new-contact" onClick="addAnother('contact-info','add-new-contact');">Add Another</button></td>
						</tr>
						<tr><td colspan="2"><hr/></td></tr>

					</tbody>


					<tbody class="announce-info">
						<tr><td>Lets talk about the Event</td></tr>
						<tr><td>Event's Title <span class="asterisk">*</span> </td><tr></tr><td colspan="2"><input type = text name ='announcement_Title' value='' required /> </td></tr>
						<tr><td >Event's Description <span class="asterisk">*</span> </td><tr></tr><td ><textarea   name ='announcement_Text' value=''required> </textarea></td></tr>
						<tr><td>Location <span class="asterisk">*</span> </td><tr></tr><td colspan="2"><input type = text name ='announcement_Location' value='' required/></td></tr>

						<tr><td>Start Date (mm-dd-yy) <span class="asterisk">*</span> </td><td><input type = text name ='start_day' id="dateStart" required/></td></tr>
						<tr><td>Start Time <span class="asterisk">*</span></td>
						<td>
							<select name="start_time" style="color: black;">
								<?php 
									$s=0;
									for($hours=0; $hours<24; $hours++) 
									for($mins=0; $mins<60; $mins+=15) 
										if ($hours==0){
											echo "<option value=$hours:$mins:$s>".str_pad(12,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." AM</option>";
										}elseif ($hours>12){
											if ($hours==17)
												echo "<option value=$hours:$mins:$s selected='selected'>".str_pad($hours-12,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." PM</option>";
											else echo "<option value=$hours:$mins:$s >".str_pad($hours-12,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." PM</option>";

										}else{
											echo "<option value=$hours:$mins:$s >".str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." AM</option>";
										}
								?>
							</select>

						</td></tr>
						<tr><td>End Date (mm-dd-yy) <span class="asterisk">*</span></td> <td><input type = text name ='end_day' id="dateEnd" /></td></tr>
						<tr>
						<td>End Time <span class="asterisk">*</span></td>
						<td>
							<select name="end_time" style="color: black;">
							<?php 
								for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
									for($mins=0; $mins<60; $mins+=15) // the interval for mins is '15'
										if ($hours==0){
											echo "<option value=$hours:$mins:$s>".str_pad(12,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." AM</option>";
										}elseif ($hours>12 ){
											if ($hours==18 )
												echo "<option value=$hours:$mins:$s selected='selected'>".str_pad($hours-12,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." PM</option>";
											else echo "<option value=$hours:$mins:$s >".str_pad($hours-12,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." PM</option>";
										}else{
											echo "<option value=$hours:$mins:$s >".str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT)." AM</option>";

										}
							?>
							</select>
						</td></tr>
						<!-- <tr><td>Time <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='announcement_time' value='' required/></td></tr> -->
						<tr><td colspan="2"><hr/></td></tr>
					</tbody>
					<tbody class="announce-info">
					<?php
						echo "<tr><td><b>Major: </b></td><tr><td>";
						foreach($majors as $major){
							echo "<input type='checkbox' name='major[]' value='".$major->major_ID."' checked='checked'> &nbsp;&nbsp;".$major->major_Name."</br>";
						}
						echo"</td></tr>";
						echo'<tr><td colspan="2"><hr/></td></tr>';

						echo "<tr><td><b>Classifications: </b></td><tr><td >";
						foreach($classifications as $classification){
							echo "<input type='checkbox' class='checkbox-input' name='classification[]' value='".$classification->cls_ID."' checked='checked'> &nbsp;&nbsp;".$classification->cls_Name."</br>";
						}
						echo '</td>';
					echo "</tr>";  
					?>
						<tr><td colspan="2"><hr/></td></tr>

					</tbody>

					<tbody class="announcement-attachment">
						<tr><td>
							Attachment: <input type="file"  name="attachments[]" accept="image/png,,image/jpeg,image/jpg,.pdf" multiple>
						</td>
						<td><button class="add-new-attachment" onClick="addAnother('announcement-attachment','add-new-attachment');">Add Another</button></td>
						</tr>
					</tbody>
					<tr></tr>
					<tr><td colspan="2"><hr/></td></tr>

					<td  class="form-submission" colspan="2"><input class="form_submit_button" type= 'submit' name= 'submit_announcement' value= 'Submit'/> <td>
					
				</table>	
				</center>	
            </form> 
		</div>
	</div>
</div>
