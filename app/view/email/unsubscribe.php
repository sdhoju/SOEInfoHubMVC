<div  id="secmid">
	<div  id="innercontent">
		

		<div class="card">
                <div class="container-card subscribe">
                <p style="color:white; " class='table-header'>
				Enter your email address. You will be sent an email with the link to unsubscribe.


                </p>
    

				<form action='<?php echo URL;?>announcement/unsubscribe' method="post">
                    
                    <table class="subscribe"> 
                    
                        <tbody class="subscribe tbody">
                           
                            <tr>
                            <td> <input type="email" name="email"  placeholder="Email Address" required></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <input type="submit" name="unsubscribe" value="Unsubscribe" class="button" style="border-radius:10px;"/>
                    <a href="<?php echo URL;?>" style="color:white; font-size:1.5em;">Go back</a>
                </form>

                </div>
            </div>
    </div>
</div>