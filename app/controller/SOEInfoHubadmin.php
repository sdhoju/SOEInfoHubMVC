<?php
class SOEInfoHubAdmin extends Controller
{
    //View Function
    public function index()
    {
        // load views
 

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
            // print_r($login);

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
            //   echo 'to login';
            header('location: ' . URL.'SOEInfoHubadmin/index' );

            }
            
        }
    }
    
    //View Function
    public function dashboard()
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Admin ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            $announcements = $this->admin->getAllAnnouncements();
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/dashboard.php';
            require APP . 'view/_templates/footer.php';
        }
   
    }

        //View Function
    public function editform($announcement_ID)
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Admin ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            $announcement = $this->admin->getAnnouncement($announcement_ID);
            $submitters = $this->admin->getsubmitter($announcement_ID);
            $announcement_majors = $this->admin->getMajors($announcement_ID);
            $announcement_classifications = $this->admin->getClassifications($announcement_ID);
            $attachments = $this->admin->getAttachments($announcement_ID);
            $majors = $this->model->getAllMajor();
            $classifications = $this->model->getAllClassification();
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/editAnnouncement.php';
            require APP . 'view/_templates/footer.php';
        }
    }
    public function edit(){
        if(isset($_POST["edit_announcement"])) {
            header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
        }
    }
    
    public function publish($announcement_ID){

        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Admin ";
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
                        
                        // $this->EmailtoAll($announcement_ID);
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



    public function logout(){
        if(!isset($_SESSION["username"])) {
            $_SESSION["message"] = "You must login in first!";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }
         $_SESSION["username"] = NULL;
         header('location: ' . URL.'SOEInfoHubadmin/index' );
        }
    
     public function EmailtoAll($announcement_ID){
            // str($email);

            $announcement = $this->model->getAnnouncementByID($announcement_ID);
            $majors = $this->admin->getMajors($announcement_ID)->major_ID;
            $classifications = $this->admin->getClassifications($announcement_ID)->cls_ID;
            // print_r($classifications); exit();

            $majors = explode(',',$majors);
            $classifications = explode(',',$classifications);


            $students=array();
            foreach($majors as $major){
                $students[] = $this->admin->getTargetedStudentsEmail($major,$classifications);
            }

            // print_r($students );exit();

            $to=array();
                foreach($students as $student){
                    if(sizeof($student)>0){
                        foreach($student as $s)
                        $to[] = array( 
                        'name' =>"$s->first_name ".    "$s->middle_name "."$s->last_name",
                        'email'=> "$s->email");
                    }  
                } ;
            // print_r($to );exit();


            $subject=$announcement->announcement_Title;
            $html='<h3>'.$announcement->announcement_Title.'</h3>
                    <img  src="http:'.URL.'public/uploads/'.$announcement->file_name.'" alt="attachment" >		
            <p>'. $announcement->announcement_Text.'</p>';
            // echo $html; exit();
            $from=array('name'=>'School of  Engineering','email'=>'samee.dhoju@gmail.com');
    
            $newMailer = new Mailer(true);
            $newMailer->mail($to,$subject,$html,$from);        
        }

}