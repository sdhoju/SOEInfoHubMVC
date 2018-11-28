<?php
class SOEInfoHubAdmin extends Controller
{
    //View Function
    public function index()
    {
        
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/login.php';
            require APP . 'view/_templates/footer.php';
        }else{
            $announcements = $this->admin->getAllAnnouncements();
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/dashboard.php';
            require APP . 'view/_templates/footer.php';
        }
    }


    public function login()
    {
        if (isset($_POST["login"])) {

            $username = $_POST["username"];
            $password = $_POST["password"];
            $login = $this->admin->getUserByUsername($username);

            if(password_check($password,$login->password))
            {
				$_SESSION["username"]=$login->username;
				if($login->admin==1){
					$_SESSION["admin"]=$login->username;
                    header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                	}
				else{
                    $_SESSION["message"] = "Not an admin";
                    header('location: ' . URL.'SOEInfoHubadmin/index' );
				}
			}
			
			else {
			  $_SESSION["message"] = "Username/Password don't match";
              header('location: ' . URL.'SOEInfoHubadmin/index' );

            }
            
        }
    }
    
    //View Function
    public function dashboard()
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Invalid user ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            $announcements = $this->admin->getAllAnnouncements();
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/dashboard.php';
            require APP . 'view/_templates/footer.php';
        }
   
    }

    public function editform($announcement_ID)
    {

        function checkFile(){
            $valid = false;
            $errors=array();
            for ($i=0; $i<sizeof($_FILES['attachments']['name']);$i++)
            {
                $file_name = $_FILES['attachments']['name'][$i];
                $file_size =$_FILES['attachments']['size'][$i];
                $file_type=$_FILES['attachments']['type'][$i];
                
                $file_ext=strtolower(end(explode('.',  $_FILES['attachments']['name'][$i])));
                $extensions= array("jpeg","jpg","png","pdf");
                if(in_array($file_ext,$extensions) === false){
                    $errors[]="extension not allowed, please choose a JPEG,JPG,PNG or PDF file.";
                    $_SESSION["message"] = "This Type of file is not allowed, please choose a JPEG,JPG,PNG or PDF file.\n";
                }
                if($file_size > 5242880){
                    $errors[]='File size must be smaller than 5 MB';
                    $_SESSION["message"] = "File size must be smaller than 5 MB \n";
                }
            }

            if(empty($errors)==true){
                $valid = true;
            }
            return $valid;
        }

        $announcement = $this->admin->getAnnouncement($announcement_ID);
        $submitters = $this->admin->getsubmitter($announcement_ID);
        $announcement_majors = $this->admin->getMajors($announcement_ID);
        $announcement_classifications = $this->admin->getClassifications($announcement_ID);
        $attachments = $this->admin->getAttachments($announcement_ID);
        $all_majors = $this->model->getAllMajor();
        $all_classifications = $this->model->getAllClassification();

        //Not logged in as admin
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Not Valid User ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            if(isset($_POST["edit_announcement"])) {
                // if(checkfile() ){
 
                    $file_names = $_FILES['attachments']['name'];
                    $file_types  = $_FILES['attachments']['type'];

                    //Call the editAnnouncemen
                    $result= $this->admin->updateAnnouncement(
                                    $_POST["contact_Name"], 
                                    $_POST["email"], 
                                    $_POST["phone"],
                                    $_POST["S_Organization"],
                                    $announcement_ID,
                                    $_POST["announcement_Title"],
                                    $_POST["announcement_Text"], 
                                    $_POST["announcement_Location"],
                                    $_POST["start_day"],
                                    $_POST["start_time"],
                                    $_POST["end_day"],
                                    $_POST["end_time"],
                                    $_POST['external_link'],
                                    $_POST["major"], 
                                    $_POST["classification"],
                                    $file_names,
                                    $file_types);
                    
                    if($result==1)
                        $_SESSION["message"] = "Changes saved";
                    else
                        $_SESSION["message"] = "No changes saved";
                    //Upload the files   
                    for($i=0; $i<sizeof($file_names);$i++){
                        $img = $file_names[$i];
                        $time=time();
                        move_uploaded_file($_FILES['attachments']['tmp_name'][$i],ROOT."public/uploads/$img");
                    }
                // }
                header('location: ' . URL.'SOEInfoHubadmin/dashboard' );

            }
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/editAnnouncement.php';
            require APP . 'view/_templates/footer.php';
        }


        

    }
  
    public function deletefile($announcement_ID,$file_ID){
        // echo "From Ajax";

        $this->admin->deleteFile($file_ID);
        header('location: ' . URL.'SOEInfoHubadmin/editform/'.$announcement_ID );

    }
    
    public function publish($announcement_ID){

        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Not an admin";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else
        {

            if(isset($_POST["publish_announcement"])) {
                $result = $this->admin->togglePublish($announcement_ID);
                if($result==1){
                    $_SESSION["message"] = "Publish Status has been changed";
                    $published_status =(int) $this->admin->getPublishStatus($announcement_ID)->Published;

                    $p= $published_status+1;
                    if( $p==2) {
                        //have been published 
                        $this->EmailtoAll($announcement_ID);
                    }
                    
                    header('location: ' . URL.'SOEInfoHubadmin/dashboard' );          
                }
                else{
                    $_SESSION["message"] = "Announcement wasn't Published";
                    header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                }

            }
        }
    }
    

    public function delete()
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Not Valid User ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
                $_SESSION["message"] = "Admin ";
                header('location: ' . URL.'SOEInfoHubadmin/index' );
            }else{
                if(isset($_POST["delete_announcement"])){
                    $result= $this->admin->deleteAnnouncement($_POST['announcement_ID']);
                    if($result!=0){
                        $_SESSION["message"] = "Announcement successfully deleted! ";
                        header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                    }
                    else{
                        $_SESSION["message"] = "Announcement couldn't be deleted! ";
                        header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                    }
                }
        }
        }
    }



    public function logout(){
        if(!isset($_SESSION["username"])) {
            $_SESSION["message"] = "You must login in first!";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }
         $_SESSION["username"] = NULL;
         header('location: ' . URL.'SOEInfoHubadmin/index' );
        }

    
     public function EmailtoAll($announcement_ID){

            $announcement = $this->model->getAnnouncementByID($announcement_ID);
            $contacts = $this->model->getContactsByID($announcement_ID);
            $majors = $this->admin->getMajors($announcement_ID)->major_ID;
            $classifications = $this->admin->getClassifications($announcement_ID)->cls_ID;
            $image = $this->admin->getAttachmentsByID($announcement_ID);
            if(empty($image))
                $image='placeholder.jpg';
            else
                $image=$image->file_name;
            $majors = explode(',',$majors);
            $classifications = explode(',',$classifications);

            date_default_timezone_set('America/Chicago');
            $announcement->start_day = date("F d, Y", strtotime("$announcement->start_day"));
            $announcement->end_day = date("F d, Y", strtotime("$announcement->end_day"));
            $announcement->start_time = date("g:i a", strtotime($announcement->start_time));							
            $announcement->end_time = date("g:i a", strtotime($announcement->end_time));

           

            $students=array();
            foreach($majors as $major){
                $students[] = $this->admin->getTargetedSubscribersEmail($major,$classifications);
            }


            $to=array();
                foreach($students as $student){
                    if(sizeof($student)>0){
                        foreach($student as $s)
                        $to[] = array( 
                        'name' =>"$s->first_name ".    "$s->middle_name "."$s->last_name",
                        'email'=> "$s->email");
                    }  
                } ;

            $replyto=array('name'=>$contacts[0]->contact_Name,'email'=>$contacts[0]->email);
            $subject=$announcement->announcement_Title;
            $html='
                <a href="http:'.URL.'announcement/getAnnouncementByID/'.$announcement->announcement_ID.'">View in browser.</a>
                <div class="main-container" style="width:720px; font-size:1.1em;">
                <h1>'.$announcement->announcement_Title.'</h1>
                <img  style="max-width:720px; max-height:720px" src="http:'.URL.'public/uploads/'.$image.'" alt="attachment" >		
                <p><b>Details:</b><br>'. $announcement->announcement_Text.'</p>
                <p><b>Location:</b>'.$announcement->announcement_Location.' </p>';
            if($announcement->start_day == $announcement->end_day)
                $html.= '<b>Date and time:</b> '.$announcement->start_day." ".$announcement->start_time." to ".$announcement->end_time.'<br>';
            else							
                $html.= '<b>Date and time:</b> '.$announcement->start_day." ".$announcement->start_time." to ".$announcement->end_day." ".$announcement->end_time.' <br>';

            $html.='<p>If you have any questions regarding this event please contact the following people.<br><ol>';
                foreach($contacts as $contact){
                    $html.='<li>'. $contact->contact_Name.' '.$contact->email.' '.$contact->phone.'</li>' ;
                }
            $html.='</ol></p></div>';
            $html.='
             <a href="http:'.URL.'announcement/unsubscribe">Unsubscribe</a>';
            $from=array('name'=>'School of  Engineering','email'=>'no-reply-please@gmail.com');
    
            $newMailer = new Mailer(true);
            $newMailer->mail($to,$subject,$html,$from,$replyto);        
        }

}