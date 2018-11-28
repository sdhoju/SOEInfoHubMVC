<div  id="secmid">
	<div  id="innercontent">
  <div class="card">
                <div class="container-card subscribe" style="color:white;">
                <?php
                  if (($output = message()) !== null) {
                    echo $output;
                    $output=null;
                  }?>
                Danger Zone:<br>
               
                <p style="color:white; " class='table-header'>


              Upload an Excel file.</p>
              <form  style="display:block;" action='<?php echo URL;?>SOEInfoHubadmin/importSubs' method='post'  enctype="multipart/form-data">
              <table class="subscribe" > 
                    
                        <tbody class="subscribe tbody">
                            <tr>
                            <td><input type="file" name="file" ></td>
                            <td>                <input  type= 'submit' name= 'uploadExcel' value= 'upload' class="button" style="border-radius:10px; font-size: 1em; "/>
                            <?php echo '<a href ="'.URL.'SOEInfoHubadmin/dashboard"/>Cancel</a>';?>

                             </td>
                            </tr>
                        </tbody>
                    </table>
                
              </form>
            </div>
        </div>
</div>

</div>
