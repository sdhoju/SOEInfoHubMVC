<?php
	require_once("functions.php");
	require_once("session.php");
	require_once("Mailer.php");

	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
  	if(isset($_GET['id'])&&$_GET['id']!==""){
			
			$ID = $_GET["id"];
			$query ="SELECT * FROM announcement where  published = 1 AND announcement_ID =".$ID;
			$result = $mysqli->query($query);
		}
		
		$url='https://turing.cs.olemiss.edu/~sdhoju/SeniorProject/announcement1.php?id='.$ID;
	
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();

			$to=array(
					
					array(
						'name'=>'Sameer Dhoju',
						'email'=>'sdhoju@go.olemiss.edu'
					)
						
					// array(		
					//	'name'=>'Marni Kendricks',
					//	'email'=>'mckendri@olemiss.edu'
					//), 
				);
				$subject=$row['announcement_Title'];
				$html='<h3>'.$row['announcement_Title'].'</h3>
					 <a href='.$url.'>View Event here</a>
					<img id="myImg"  class="announcement-post-image-header" src="'.$row['announcement_media'].'"alt='.$row['announcement_Title'].'>		
					<p>'. $row['announcement_Text'].'</p>
					';
				$from=array('name'=>'Sameer Dhoju','email'=>'samee.dhoju@gmail.com');
				$replyto=array('name'=>'Sameer Dhoju','email'=>'samee.dhoju@gmail.com');

				$newMailer = new Mailer(true);
				$newMailer->mail($to,$subject,$html,$from,$replyto);
				redirect_to("dashboard.php");
				exit;

		}
		else {
		$_SESSION["message"] = "Email not Sent!";
		redirect_to("dashboard.php");
		exit;
		}
	


?>