<?php
	
	function redirect_to($new_location) {
		header("Location: ".$new_location);
		exit;
	}

/*
	function creat_event($summary,$location,$description){
		$event = new Google_Service_Calendar_Event(array(
			'summary' => 'Google I/O 2015',
			'location' => '800 Howard St., San Francisco, CA 94103',
			'description' => 'A chance to hear more about Google\'s developer products.',
			'start' => array(
				'dateTime' => '2015-05-28T09:00:00-07:00',
				'timeZone' => 'America/Los_Angeles',
			),
			'end' => array(
				'dateTime' => '2015-05-28T17:00:00-07:00',
				'timeZone' => 'America/Los_Angeles',
			),
		));
		
		$calendarId = 'primary';
		$event = $service->events->insert($calendarId, $event);
		printf('Event created: %s\n', $event->htmlLink);
	}
*/
	
	function db_connection() {

		require_once('/home/sdhoju/DBDhojuSameer.php');		
		//mysqli connect expects host, username, password, database name
		$mysqli = new mysqli(DBHOST, USERNAME, PASSWORD, DBNAME);
		/*
		if($mysqli->connect_errno) {
			die("Could not connect to server!<br />");
		}
		else {
			echo "Successful connection";
		}
		*/
		return $mysqli;
	}

	function new_header($name = "Engineering Header") {
		readfile('header.html');
	}
	
	
	function new_footer($name='Engineering Footer ', $mysqli){
		readfile('footer.html');
		echo'</div>';

		//Close database connection
		$mysqli->close();
	}
	
	function password_encrypt($password) {
	  $hash_format = "$2y$10$";   // Use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
	  return $hash;
	}
	
	function generate_salt($length) {
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
	  // Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
	  // Replace '+' with '.' from the base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
	  // Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
	  // existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } 
	  else {
	    return false;
	  }
	}
	
?>
