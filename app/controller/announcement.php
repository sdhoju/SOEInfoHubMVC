<?php
	require_once(APP."libs/session.php");

class Announcement extends Controller
{

   
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/announcements/index
     */
    
    public function index()
    {
        $link='	<br>
        <center>
            <h3>
            <span><a href="'.URL.'announcement/submitAnnouncement">Fill Form</a></span>
            <span><a href="dashboard.php">List Announcemnts</a></span></h3>
        </center>';

        $announcements = $this->model->getAllAnnouncements();
        // $total_announcements = $this->model->getAmountOfAnnouncements();
       // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        echo $link;

        require APP . 'view/announcements/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function submitAnnouncement()
    {
        
        $majors = $this->model->getAllMajor();
        $classifications = $this->model->getAllClassification();
        require APP . 'view/_templates/header.php';
        require APP . 'view/announcements/fill_Form.php';
        require APP . 'view/_templates/footer.php';
    }


    public function addAnnouncement()
    {
        if (isset($_POST["submit_announcement"])) {
            // $errors = checkFile($_POST['attachments']);
            $result= $this->model->addAnnouncement($_POST["contact_Name"], $_POST["email"],  $_POST["phone"],
                $_POST["S_Organization"],
                $_POST["announcement_Title"], $_POST["announcement_Text"], 
                    $_POST["announcement_Location"],$_POST["start_day"],
                    $_POST["end_day"],  $_POST["announcement_time"]);
                    
        }
        if ($result==(1+sizeof($_POST["contact_Name"])) ){
            $_SESSION["message"] = "Thank you!  ".$_POST['contact_Name'][0]." for telling us about ".$_POST['announcement_Title']."
                                    School of Engineering with review the announcement. TODO: mail here";        }
        else{
            $_SESSION["message"] = "Sorry, your submission wasn't submitted. ";
        }
        header('location: ' . URL.'announcement/submitAnnouncement' );
    }

    public function checkFile(){
            $errors= array();
             

            $file_name = $_FILES['attachment']['name'];
            $file_size =$_FILES['attachment']['size'];
            $file_tmp =$_FILES['attachment']['tmp_name'];
            $file_type=$_FILES['attachment']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['attachment']['name'])));
            $expensions= array("jpeg","jpg","png","pdf");
            
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            
            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
            if(empty($errors)==true){
                $query ="insert into announcementFile (announcement_ID,file_name) values('$name','$img');";
                $result = $mysqli->query($query); 
                    if($result) {
                        move_uploaded_file($_FILES['image']['tmp_name'],"upload/$img");
            
                    }else{
                        print_r($query);
                    }
            }else{
                print_r($errors);
            }
            
            return $errors;
    }

    public function getAnnouncementByID($announcement_ID)
    {   
        $link='	<br>
            <center>
                <h3>
                <span><a href="'.URL.'">Feed </a></span>
                <span><a href="'.URL.'announcement/submitAnnouncement">Fill Form</a></span>
                <span><a href="dashboard.php">List Announcemnts</a></span></h3>
            </center>';

        $announcement = $this->model->getAnnouncementByID($announcement_ID);
        require APP . 'view/_templates/header.php';
        echo $link;
        require APP . 'view/announcements/announcement1.php';
        require APP . 'view/_templates/footer.php';
    }
        public function shareInFacebook($announcement_ID)
        {
        // if we have an id of a song that should be deleted
        if (isset($announcement_ID)) {
            // do deleteSong() in model/model.php
            $this->model->deleteSong($song_id);
        }
    }
}