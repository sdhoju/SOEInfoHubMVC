
<div  id="secmid">
	<div  id="innercontent">
		<div class='create-announcement-form'>
			<form action='<?php echo URL; ?>announcement/addAnnouncement' method='post'>
                     <h3 style="font-size: 2em;">Please fill this form to submit an announcement</h3>
				<table id='t01'>
					<tbody class="contact-info">
						<tr><td>Tell us about yourself. </td></tr>
						<tr><td>Contact's Name <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='contact_Name[]' value= '' required/></td></tr>
						<tr><td>Contact Email <span class="asterisk">*</span></td><tr></tr><td><input type="email" name ='email[]' value= '' required/></td></tr>
						<tr><td>ContactPhone  </td><tr></tr><td><input type = text name ='phone[]' value= '' placeholder="662-915-0000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" /></td></tr>
						<tr><td>Organization  </td><tr></tr><td><input type = text name ='S_Organization[]' value= '' /></td></tr>
					</tbody>

					<tr><td></td><td><button class="add-new-contact">Add Another</button></td></tr>
					<script>
						$(function () {
							$original = $('.contact-info').clone(true);
							
							function DuplicateForm () {
								var newForm;
								newForm = $original.clone(true).insertAfter($('.contact-info:last'));

								$.each($('input', newForm), function(i, item) {            
									$(item).attr('name', $(item).attr('name') );
								});
							}
							
							$('button[class="add-new-contact"]').on('click', function (e) {
								e.preventDefault();
								DuplicateForm();
							});
						});
					</script>

					<tbody class="announce-info">
						<tr><td>Lets talk about the Announcement</td></tr>
						<tr><td>Event's Title <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='announcement_Title' value='' required /> </td></tr>
						<tr><td>Event's Description <span class="asterisk">*</span> </td><tr></tr><td><textarea   name ='announcement_Text' value=''required> </textarea></td></tr>
						<tr><td>Location <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='announcement_Location' value='' required/></td></tr>
						
						<script>
							$( function() {
								$( "#datepicker" ).datepicker( {
											dateFormat: "mm-dd-yy",
											minDate: 0 
											} );
							} );
						</script>

						<tr><td>Start Date (mm-dd-yy) <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='start_day' id="datepicker" required/></td></tr>
						<tr><td>End Date (mm-dd-yy) </td><tr></tr><td><input type = text name ='end_day' id="datepicker" /></td></tr>
						<tr><td>Time <span class="asterisk">*</span> </td><tr></tr><td><input type = text name ='announcement_time' value='' required/></td></tr>
					</tbody>
					<tbody class="announce-info">
					<?php
						echo "<tr><td><b>Major</b>";
						foreach($majors as $major){
							echo "<input type='checkbox' name='major[]' value='".$major->major_Name."' checked='checked'>".$major->major_Name."";
						}
						echo"</td></tr>";
						echo "<tr><td><b>Classifications</b>";
						foreach($classifications as $classification){
							echo "<input type='checkbox' name='major[]' value='".$classification->cls_Name."' checked='checked'>".$classification->cls_Name."";
						}
						echo '</td>';
					echo "</tr>";  
					?>
					</tbody>

					<tbody class="announcement-attachment">
						<tr><td>
							<label>Attachment</label><input type="file" name="attachments[]" accept="image/png,,image/jpeg,image/jpg,.pdf" multiple>
						</td>
						</tr>
					</tbody>
					
					<td><input class="form_submit_button" type= 'submit' name= 'submit_announcement' value= 'Submit'/> <td>
					
				</table>		
            </form> 
		</div>
	</div>
</div>
