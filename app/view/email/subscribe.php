
<div  id="secmid">
	<div  id="innercontent">
           
        <center> <a href="<?php echo URL;?>" style="  font-size:2em; ">Back to feed page</a>            </center>


            <div class="card">
                <div class="container-card subscribe">
                <p style="color:white; ">
                        We send out the announcement of events on the campus. 
                        You can get involded by subscribing.

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