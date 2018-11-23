<?php

class Announcement extends Controller
{

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/announcements/index
     */
    public function index()
    {
        $all_majors=$this->model->getAllMajor();
        $all_cls =$this->model->getAllClassification();
        $announcements = $this->model->getAllAnnouncements();    
        require APP . 'view/_templates/header.php';
        require APP . 'view/announcements/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function getAnnouncementByID($announcement_ID)
    {   
      
        $announcement = $this->model->getAnnouncementByID($announcement_ID);
        if( $announcement->published==0){
            if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"]) ) {
                header('location: ' . URL . 'problem');
            }else{
                if(!empty($announcement)){
                    $text = urldecode($announcement->announcement_Text);
                    $title = urldecode($announcement->announcement_Title);
                    require APP . 'view/_templates/fbheader.php';
                    require APP . 'view/announcements/announcement1.php';
                    require APP . 'view/_templates/footer.php';
                }
            }
        }else{
            if(!empty($announcement)){
                $text = urldecode($announcement->announcement_Text);
                $title = urldecode($announcement->announcement_Title);
                require APP . 'view/_templates/fbheader.php';
                require APP . 'view/announcements/announcement1.php';
                require APP . 'view/_templates/footer.php';
            }
        }
        header('location: ' . URL . 'problem');

      

    }
        public function shareInFacebook($announcement_ID)
        {
        // if we have an id of a song that should be deleted
        if (isset($announcement_ID)) {
            // do deleteSong() in model/model.php
            $this->model->deleteSong($song_id);
        }
    }

    public function Form()
    {
      
        $majors = $this->model->getAllMajor();
        $classifications = $this->model->getAllClassification();
        require APP . 'view/_templates/header.php';
        require APP . 'view/announcements/fill_Form.php';
        require APP . 'view/_templates/footer.php';
    }


    public function submitAnnouncement()
    {
        //Lets check the file 
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

        
        //Submit button was pressed
        if (isset($_POST["submit_announcement"])) {
            
            //File meets the requirement of being image or pdf file smaller than 5MB
            if(checkfile() || empty($_FILES['attachments']['name'][0] )){
                echo !isset($_FILES);

                $file_names = $_FILES['attachments']['name'];
                $file_types  = $_FILES['attachments']['type'];

                $announcement_ID=time();
                date_default_timezone_set('America/Chicago');
                $created_at= new DateTime();
                $created_at= $created_at->format('Y\-m\-d\ h:i:s');

                $result= $this->model->addAnnouncement(
                            $created_at,
                            $announcement_ID,
                            $_POST["contact_Name"], 
                            $_POST["email"], 
                            $_POST["phone"],
                            $_POST["S_Organization"],
                            $_POST["announcement_Title"],
                            $_POST["announcement_Text"], 
                            $_POST["announcement_Location"],
                            $_POST["start_day"],
                            $_POST["start_time"],
                            $_POST["end_day"],
                            $_POST["end_time"],
                            $_['external_link'],
                            $_POST["major"], 
                            $_POST["classification"],
                            $file_names,
                            $file_types );
                if ($result==(1+sizeof($_POST["contact_Name"]) +sizeof($_POST["major"])+sizeof($_POST["classification"]) +sizeof($file_names) ) )
                {
                    //Upload File
                    for($i=0; $i<sizeof($file_names);$i++){
                        $img = $file_names[$i];
                        $time=time();
                        move_uploaded_file($_FILES['attachments']['tmp_name'][$i],ROOT."public/uploads/$img");
                    }
        
        
                    //Generate the Submission message
                    $_SESSION["message"] = "Thank you!  ".$_POST['contact_Name'][0]." for telling us about ".$_POST['announcement_Title']."
                                            The School of Engineering will review and release the announcement soon. ";       
        
                    //Send Email notification to Submitter
                    $this->submitEmail($_POST["contact_Name"], $_POST["email"], $_POST["announcement_Title"]);
                }
                else{
                    $_SESSION["message"] = "Sorry, your submission wasn't submitted. ";
                }
            
            
            
            }

        }
        
        header('location: ' . URL.'announcement/Form' );
    }

     


    public function submitEmail($names,$emails,$announcement_Title){
        //Send Email to creater
        $to=array();
        for($i=0; $i<sizeof($emails); $i++) {
                $to[]=    array('name'=> $names[$i],'email'=> $emails[$i]);
            }
      
        $subject=$announcement_Title;
        $html="Thank you, <br>
                Your submission for $announcement_Title has been received. The School of Engineering will review this event and send it out to students.";
        $from=array('name'=>'School of  Engineering','email'=>'samee.dhoju@gmail.com');
        $replyto=array('name'=>'School of  Engineering','email'=>'samee.dhoju@gmail.com');

        $ContactMailer = new Mailer(true);
        $ContactMailer->mail($to,$subject,$html,$from,$replyto);

        //Send email to Admin
        $toAdmin=array();
        $toAdmin[] = array(
                'name'=>'School of Engineering',
                'email'=>'sdhoju@go.olemiss.edu'
            );
            
        $subject='SOEInfoHub Submission Received';
        $html="$names[0] has submitted an event on $announcement_Title.<br>
                Please review this event. Thank You! ";
        $from=array('name'=>$names[0],'email'=>$emails[0]);
        $replyto=array('name'=>$names[0],'email'=>$emails[0]);
       
        $adminMailer = new Mailer(true);
        $adminMailer->mail($toAdmin,$subject,$html,$from,$replyto);
    }


    public function EmailtoFriend($announcement_ID){
        if (isset($_POST["email_to_friend"])) {
            $email=$_POST['email'];
            // str($email);
            $announcement = $this->model->getAnnouncementByID($announcement_ID);
            $to=array();
            $to[]=array('email'=> "$email");

            $subject=$announcement->announcement_Title;
            $html='<h3>'.$announcement->announcement_Title.'</h3>
                    <img  src="http:'.URL.'public/uploads/'.$announcement->file_name.'" alt="attachment">		
            <p>'. $announcement->announcement_Text.'</p>';
            // echo $html; exit();
            $from=array('name'=>'School of  Engineering','email'=>'samee.dhoju@gmail.com');
    
            $newMailer = new Mailer(true);
            $newMailer->mail($to,$subject,$html,$from);

        
        }
        header('location: ' .URL . 'announcement/getAnnouncementByID/'. htmlspecialchars($announcement_ID, ENT_QUOTES, 'UTF-8') );

    }



   


    public function getISC($announcement_ID){
        $announcement = $this->model->getAnnouncementByID($announcement_ID);

            //This is the most important coding.
            header("Content-Type: text/Calendar");
            header("Content-Disposition: inline; filename=".htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8').".ics");
            echo "BEGIN:VCALENDAR\n";
            echo "PRODID:-//Microsoft Corporation//Outlook 12.0 MIMEDIR//EN\n";
            echo "VERSION:2.0\n";
            echo "METHOD:PUBLISH\n";
            echo "X-MS-OLK-FORCEINSPECTOROPEN:TRUE\n";
            echo "BEGIN:VEVENT\n";
            echo "CLASS:PUBLIC\n";
            echo "CREATED:$announcement->created_at\n";
            echo "DESCRIPTION:".htmlspecialchars($announcement->announcement_Text, ENT_QUOTES, 'UTF-8')."\n.";
            echo "DTEND:$announcement->end_day\n";
            echo "DTSTAMP:20091109T093305Z\n";
            echo "DTSTART:$announcement->start_day\n";
            echo "LAST-MODIFIED:20091109T101015Z\n";
            echo "LOCATION:$announcement->announcement_Location\n";
            echo "PRIORITY:5\n";
            echo "SEQUENCE:0\n";
            echo "SUMMARY;LANGUAGE=en-us:".htmlspecialchars($announcement->announcement_Title, ENT_QUOTES, 'UTF-8')."\n";
            echo "TRANSP:OPAQUE\n";
            echo "UID:040000008200E00074C5B7101A82E008000000008062306C6261CA01000000000000000\n";
            echo "X-MICROSOFT-CDO-BUSYSTATUS:BUSY\n";
            echo "X-MICROSOFT-CDO-IMPORTANCE:1\n";
            echo "X-MICROSOFT-DISALLOW-COUNTER:FALSE\n";
            echo "X-MS-OLK-ALLOWEXTERNCHECK:TRUE\n";
            echo "X-MS-OLK-AUTOFILLLOCATION:FALSE\n";
            echo "X-MS-OLK-CONFTYPE:0\n";
            //Here is to set the reminder for the event.
            echo "BEGIN:VALARM\n";
            echo "TRIGGER:-PT1440M\n";
            echo "ACTION:DISPLAY\n";
            echo "DESCRIPTION:Reminder\n";
            echo "END:VALARM\n";
            echo "END:VEVENT\n";
            echo "END:VCALENDAR\n";
    }



    
      
}